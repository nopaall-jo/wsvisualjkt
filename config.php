<?php
/**
 * WS Visual Photo & Video - Flexible Database Configuration
 * Auto-detects MySQL ports (3306 for XAMPP, 3307 for Laragon)
 * UTF-8 / utf8mb4 enforced at every layer to preserve emoji & Unicode characters.
 */

// ── 1. PHP internal encoding ─────────────────────────────────────────────────
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

// ── 2. HTTP response charset header (for PHP-served pages / APIs) ─────────────
// Only send if headers haven't been sent yet (avoids warning in included files).
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}

// ── 3. Database credentials ───────────────────────────────────────────────────
$db_host = '127.0.0.1';
$db_name = 'wsvisual_db';
$db_user = 'root';
$db_pass = '';

$pdo = null;
$connected_port = null;

// ── 4. PDO connection with full utf8mb4 enforcement ───────────────────────────
// charset=utf8mb4 in DSN sets the CLIENT charset before the handshake.
// The PDO options below additionally run SET NAMES / SET CHARACTER SET after
// connecting, which guarantees emoji (4-byte Unicode) survive the round-trip.
$ports_to_try = [3306, 3307];

foreach ($ports_to_try as $port) {
    try {
        $dsn = "mysql:host=$db_host;port=$port;dbname=;charset=utf8mb4";

        $test_pdo = new PDO($dsn, $db_user, $db_pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT            => 2,
            PDO::ATTR_EMULATE_PREPARES   => false,
            // Run immediately after connect – enforces utf8mb4 on connection layer
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
        ]);

        // Auto-create database with explicit utf8mb4 charset
        $test_pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name`
            CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $test_pdo->exec("USE `$db_name`");

        // Re-assert encoding after USE (some servers reset it)
        $test_pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
        $test_pdo->exec("SET CHARACTER SET utf8mb4");

        // Auto-create bookings table with utf8mb4 on every text column
        $test_pdo->exec("CREATE TABLE IF NOT EXISTS `bookings` (
            `id`          INT AUTO_INCREMENT PRIMARY KEY,
            `name`        VARCHAR(100)  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `phone`       VARCHAR(30)   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `service`     VARCHAR(50)   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `package`     VARCHAR(50)   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `area`        VARCHAR(50)   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `event_date`  VARCHAR(30)   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
            `notes`       TEXT          CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
            `total_price` VARCHAR(50)   CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
            `created_at`  DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $pdo = $test_pdo;
        $connected_port = $port;
        break; // Connected successfully

    } catch (PDOException $e) {
        continue; // Try next port
    }
}
?>
