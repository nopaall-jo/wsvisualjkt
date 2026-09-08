<?php
/**
 * WS Visual Photo & Video - Booking API Endpoint
 * Stores booking details to MySQL (if active) and responds JSON.
 * Full UTF-8 / utf8mb4 enforced — emoji are preserved end-to-end.
 */

// ── Encoding enforcement before any output ────────────────────────────────────
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

// ── Response headers: JSON + explicit UTF-8 charset ──────────────────────────
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config.php';

$response = [
    'success'    => true,
    'db_saved'   => false,
    'port_used'  => $connected_port ?? null
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read raw body and decode as UTF-8 JSON
    $rawInput = file_get_contents('php://input');

    // JSON_THROW_ON_ERROR ensures we catch malformed JSON cleanly
    try {
        $input = json_decode($rawInput, true, 512, JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
        // Fallback to POST if JSON parsing fails (e.g. form submit)
        $input = $_POST;
    }

    // mb_convert_encoding guard: ensure each string is valid UTF-8
    // (prevents mojibake if client sends non-UTF-8 accidentally)
    $clean = function(string $val): string {
        return mb_convert_encoding(trim($val), 'UTF-8', 'UTF-8');
    };

    $name    = $clean($input['name']    ?? '');
    $phone   = $clean($input['phone']   ?? '');
    $service = $clean($input['service'] ?? '');
    $package = $clean($input['package'] ?? '');
    $area    = $clean($input['area']    ?? '');
    $date    = $clean($input['date']    ?? '');
    $notes   = $clean($input['notes']   ?? '');
    $price   = $clean($input['price']   ?? '');

    if ($name && $phone && $pdo) {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO bookings
                    (name, phone, service, package, area, event_date, notes, total_price)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->execute([$name, $phone, $service, $package, $area, $date, $notes, $price]);
            $response['db_saved']   = true;
            $response['booking_id'] = $pdo->lastInsertId();
        } catch (Exception $e) {
            $response['db_error'] = $e->getMessage();
        }
    }
}

// JSON_UNESCAPED_UNICODE ensures emoji are NOT escaped to \uXXXX in the response
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
