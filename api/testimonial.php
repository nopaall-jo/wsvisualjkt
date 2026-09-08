<?php
/**
 * WS Visual Photo & Video - Testimonial API Endpoint
 * Handles customer review submissions, stores to JSON file and MySQL,
 * and returns the formatted testimonial object for instant DOM insertion.
 */

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config.php';

$response = [
    'success' => false,
    'message' => 'Terjadi kesalahan sistem.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read input (support JSON payload and FormData)
    $rawInput = file_get_contents('php://input');
    try {
        $input = json_decode($rawInput, true, 512, JSON_THROW_ON_ERROR);
    } catch (\Exception $e) {
        $input = $_POST;
    }

    $clean = function($val) {
        return htmlspecialchars(trim((string)$val), ENT_QUOTES, 'UTF-8');
    };

    $name    = $clean($input['name'] ?? '');
    $role    = $clean($input['role'] ?? '');
    $service = strtolower(trim((string)($input['service'] ?? 'graduation')));
    $rating  = max(1, min(5, (int)($input['rating'] ?? 5)));
    $comment = $clean($input['comment'] ?? '');

    if (empty($name)) {
        $response['message'] = 'Nama lengkap wajib diisi.';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (empty($comment)) {
        $response['message'] = 'Isi ulasan/cerita pengalaman wajib diisi.';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (empty($role)) {
        $role = 'Klien WS Visual';
    }

    // Mapping service info
    $serviceMap = [
        'graduation' => ['label' => '🎓 Wisuda', 'badge' => 'text-primary', 'avatar' => 'bg-primary'],
        'school'     => ['label' => '🏫 School Event', 'badge' => 'text-info', 'avatar' => 'bg-info'],
        'event'      => ['label' => '📹 Event & Sports', 'badge' => 'text-danger', 'avatar' => 'bg-danger'],
        'trip'       => ['label' => '🌄 Overland Trip', 'badge' => 'text-amber', 'avatar' => 'bg-amber'],
    ];

    $sInfo = $serviceMap[$service] ?? ['label' => '📸 Photo & Video', 'badge' => 'text-success', 'avatar' => 'bg-success'];

    // Construct testimonial item
    $newTestimonial = [
        'id'            => time(),
        'name'          => $name,
        'role'          => $role,
        'service'       => $service,
        'service_label' => $sInfo['label'],
        'rating'        => $rating,
        'badge_class'   => $sInfo['badge'],
        'avatar_bg'     => $sInfo['avatar'],
        'comment'       => $comment,
        'created_at'    => date('Y-m-d H:i:s')
    ];

    // 1. Save to data/testimonials.json
    $dataFile = __DIR__ . '/../data/testimonials.json';
    $testimonials = [];
    if (file_exists($dataFile)) {
        $content = file_get_contents($dataFile);
        $testimonials = json_decode($content, true) ?: [];
    }

    // Prepend new review so it appears first
    array_unshift($testimonials, $newTestimonial);

    // Save with lock
    $dir = dirname($dataFile);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    file_put_contents($dataFile, json_encode($testimonials, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), LOCK_EX);

    // 2. Also save to MySQL if available
    if (isset($pdo) && $pdo) {
        try {
            $pdo->exec("CREATE TABLE IF NOT EXISTS `testimonials` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(150) NOT NULL,
                `role` VARCHAR(150) NULL,
                `service` VARCHAR(50) NOT NULL,
                `rating` INT NOT NULL DEFAULT 5,
                `comment` TEXT NOT NULL,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            $stmt = $pdo->prepare("INSERT INTO `testimonials` (`name`, `role`, `service`, `rating`, `comment`) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $role, $service, $rating, $comment]);
        } catch (\Exception $e) {
            // MySQL error handled gracefully without breaking response
        }
    }

    $response = [
        'success'     => true,
        'message'     => 'Ulasan Anda berhasil diterbitkan!',
        'testimonial' => $newTestimonial
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
