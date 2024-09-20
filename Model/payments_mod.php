<?php
use Paymongo\PaymongoClient;
use Paymongo\PaymongoException;

class Payments {
    private $conn;
    private $client;

    public function __construct($conn, $apiKey) {
        $this->conn = $conn;
        $this->client = new PaymongoClient($apiKey);
    }

    public function getFinalAmount($appointment_id) {
        error_log("Received appointment_id: $appointment_id");
    
        $sql = 'SELECT amount FROM payments WHERE appsched_id = ?';
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }
    
        $stmt->bind_param('i', $appointment_id);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows === 0) {
            error_log("No record found for appointment_id: $appointment_id");
            $stmt->close();
            return null;
        }
    
        $stmt->bind_result($amount);
        $stmt->fetch();
    
        if ($amount === null) {
            error_log("Amount is null for appointment_id: $appointment_id");
        }
    
        $stmt->close();
        return $amount;
    }

    public function createPayMongoLink($amount, $appointment_id) {
        global $apiKey;
    
        $url = 'https://api.paymongo.com/v1/links';
        $description = 'Payment for appointment ID: ' . $appointment_id;
        $remarks = 'Online Payment';
    
        $data = [
            'data' => [
                'attributes' => [
                    'amount' => round($amount * 100), // PayMongo expects the amount in cents
                    'description' => $description,
                    'remarks' => $remarks
                ]
            ]
        ];
    
        $headers = [
            'accept: application/json',
            'authorization: Basic ' . base64_encode($apiKey . ':'),
            'content-type: application/json'
        ];
    
        // Initialize cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        // Execute cURL request
        $response = curl_exec($ch);
    
        // Check for errors
        if (curl_errno($ch)) {
            $error = 'cURL Error: ' . curl_error($ch);
            curl_close($ch);
            error_log($error);
            throw new Exception($error);
        }
    
        curl_close($ch);
    
        // Decode the response
        $responseData = json_decode($response, true);
    
        if (isset($responseData['data']['attributes']['checkout_url'])) {
            // Retrieve additional details if needed (e.g., payment_intent_id, payment_method_id)
            $paymentIntentId = $responseData['data']['attributes']['payment_intent_id'] ?? null;
            $paymentMethodId = $responseData['data']['attributes']['payment_method_id'] ?? null;
    
            return [
                'checkout_url' => $responseData['data']['attributes']['checkout_url'],
                'payment_intent_id' => $paymentIntentId,
                'payment_method_id' => $paymentMethodId
            ];
        } else {
            error_log("Response Data: " . print_r($responseData, true));
            throw new Exception('Failed to retrieve payment link.');
        }
    }
    
    public function processPayment($paymentMethod, $appointment_id, $paymentMethodId = null) {
        error_log("Processing payment with method: $paymentMethod");
        
        $finalAmount = $this->getFinalAmount($appointment_id);
        if ($finalAmount === null) {
            throw new Exception('Appointment not found.');
        }
        
        $paymentStatus = 'Unpaid';  // Default status
        $paymentType = 'Over the Counter';  // Default payment type
        $paymentReference = null;
        $checkoutUrl = null;
        
        try {
            if ($paymentMethod === 'credit_card') {
                // Handle online payment via credit card
                $serviceCharge = $finalAmount * 0.025;
                $totalAmount = $finalAmount + $serviceCharge;
        
                $paymentIntent = $this->client->paymentIntents->create([
                    'amount' => $totalAmount * 100, // Amount in cents
                    'currency' => 'PHP',
                    'payment_method' => $paymentMethodId,
                    'confirmation_method' => 'automatic',
                    'confirm' => true,
                ]);
        
                $paymentStatus = $paymentIntent->status === 'succeeded' ? 'Paid' : 'Failed';
                $paymentType = 'Online';
                $paymentReference = $paymentIntent->id;
            } elseif ($paymentMethod === 'link') {
                // Generate payment link for online payments
                $linkDetails = $this->createPayMongoLink($finalAmount, $appointment_id);
                $checkoutUrl = $linkDetails['checkout_url'] ?? null;
                $paymentStatus = 'Pending';
                $paymentType = 'Link';
            } elseif ($paymentMethod === 'over_the_counter') {
                // Handle over the counter payment
                $result = $this->handleOverTheCounterPayment($appointment_id);
                $paymentStatus = $result['status'];
                $checkoutUrl = $result['checkout_url'];
            } else {
                throw new Exception('Invalid payment method.');
            }
        
            // Update the payment record with relevant details
            $this->updatePaymentRecord($appointment_id, $paymentStatus, $paymentType, $paymentReference);
        
            return [
                'status' => $paymentStatus,
                'checkout_url' => $checkoutUrl
            ];
        } catch (PaymongoException $e) {
            error_log("PayMongo API error: " . $e->getMessage());
            throw new Exception('Payment processing failed: ' . $e->getMessage());
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception('Database error: ' . $e->getMessage());
        } catch (Exception $e) {
            error_log("General error: " . $e->getMessage());
            throw new Exception('Error: ' . $e->getMessage());
        }
    }
    
    // Change method to public
    public function handleOverTheCounterPayment($appointment_id) {
        $paymentStatus = 'Unpaid';  // Default status for OTC payments
        $paymentType = 'Over the Counter';  // Payment type
        $paymentReference = null;  // No payment reference for OTC
        $checkoutUrl = null;  // No URL needed for OTC

        // Save OTC payment details to the database
        $this->updatePaymentRecord($appointment_id, $paymentStatus, $paymentType, $paymentReference);

        return [
            'status' => $paymentStatus,
            'checkout_url' => $checkoutUrl  // This will be null
        ];
    }
    
    private function updatePaymentRecord($appointment_id, $paymentStatus, $paymentType, $paymentReference = null) {
        $sql = 'UPDATE payments SET payment_status = ?, payment_type = ?, payment_date = NOW(), updated_at = NOW(), payment_reference = ? WHERE appsched_id = ?';
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Failed to prepare statement: " . $this->conn->error);
        }
    
        $stmt->bind_param('sssi', $paymentStatus, $paymentType, $paymentReference, $appointment_id);
        $stmt->execute();
        $stmt->close();
    }
    
    public function updatePaymentDetails($appointment_id, $payment_status, $payment_type, $payment_intent_id, $payment_method_id) {
        $stmt = $this->conn->prepare('UPDATE payments SET payment_status = ?, payment_type = ?, payment_intent_id = ?, payment_method_id = ? WHERE appsched_id = ?');
        $stmt->bind_param('ssssi', $payment_status, $payment_type, $payment_intent_id, $payment_method_id, $appointment_id);
        $stmt->execute();
        $stmt->close();
    }
}
?>
