<?php
require '../vendor/autoload.php'; // Ensure this path is correct
require_once __DIR__ . '/../Model/db_connection.php'; // Include the database connection file

use Paymongo\PaymongoClient;
use Paymongo\PaymongoException;

$apiKey = 'sk_test_UPJT1HR9EGJtj1gZgi5EnR7N'; // Your PayMongo API key
$client = new PaymongoClient($apiKey);

// Get the raw POST data
$rawData = file_get_contents('php://input');
$headers = getallheaders();

// Validate the signature
$signature = $headers['x-paymongo-signature'] ?? '';
$webhookSecret = 'your_webhook_secret'; // Replace with your webhook secret

$expectedSignature = hash_hmac('sha256', $rawData, $webhookSecret);

if (!hash_equals($signature, $expectedSignature)) {
    http_response_code(400);
    exit('Invalid signature');
}

// Decode the payload
$payload = json_decode($rawData, true);

// Process the event
if (isset($payload['data']['type']) && $payload['data']['type'] === 'payment_intent') {
    $paymentIntentId = $payload['data']['id'];
    $status = $payload['data']['attributes']['status'];
    
    // Update payment status in the database
    $sql = 'UPDATE payments SET payment_status = ?, updated_at = NOW() WHERE payment_reference = ?';
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("Failed to prepare statement: " . $conn->error);
        http_response_code(500);
        exit('Database error');
    }

    $stmt->bind_param('ss', $status, $paymentIntentId);
    $stmt->execute();
    $stmt->close();
    
    http_response_code(200); // Successfully processed the webhook
} else {
    http_response_code(400);
    exit('Invalid event type');
}
?>
