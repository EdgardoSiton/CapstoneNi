<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($email, $password) {
        // Sanitize input
        $email = mysqli_real_escape_string($this->conn, $email);
    
        // Use prepared statements to prevent SQL injection
        $stmt = $this->conn->prepare("SELECT * FROM citizen WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result === false) {
            error_log("Database query error: " . mysqli_error($this->conn));
            return 'An error occurred. Please try again later.';
        }
    
        if (mysqli_num_rows($result) > 0) {
            // User found, verify password
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];
    
            if (password_verify($password, $hashedPassword)) {
                // Check if the password needs to be rehashed
                if (password_needs_rehash($hashedPassword, PASSWORD_DEFAULT)) {
                    // Rehash the password and update it in the database
                    $newHashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $updateStmt = $this->conn->prepare("UPDATE citizen SET password = ? WHERE email = ?");
                    $updateStmt->bind_param("ss", $newHashedPassword, $email);
                    $updateResult = $updateStmt->execute();
    
                    if ($updateResult === false) {
                        error_log("Failed to update password hash: " . mysqli_error($this->conn));
                        return 'An error occurred. Please try again later.';
                    }
                }
    
                // Password is correct, return true
                return true;
            } else {
                // Password is incorrect
                error_log("Incorrect password for email: $email");
                return 'Incorrect credentials. Please try again.';
            }
        } else {
            // Email not found
            error_log("Email not found: $email");
            return 'Incorrect credentials. Please try again.';
        }
    }
    
    public function getUserInfo($email) {
        $email = mysqli_real_escape_string($this->conn, $email);
        $query = "SELECT citizend_id, user_type, r_status, fullname FROM citizen WHERE email = '$email'";
        $result = mysqli_query($this->conn, $query);
        $user = mysqli_fetch_assoc($result);
        return [
            'citizend_id' => $user['citizend_id'],
            'user_type' => $user['user_type'],
            'r_status' => $user['r_status'],
            'fullname' => $user['fullname']
        ];
    }

    public function registerUser($data) {
        // Automatically set user_type to 'Citizen'
        $data['user_type'] = 'Citizen';
    
        // Combine first name, last name, and middle name into a single fullname field
        $data['fullname'] = trim($data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name']);
    
        // Ensure c_date_birth is set correctly before proceeding
        if (isset($data['year']) && isset($data['month']) && isset($data['day'])) {
            // Validate date components
            $year = intval($data['year']);
            $month = intval($data['month']);
            $day = intval($data['day']);
            
            if (checkdate($month, $day, $year)) {
                $data['c_date_birth'] = "$year-$month-$day";
            } else {
                // Handle invalid date
                return "Invalid date of birth";
            }
        } else {
            // Handle missing date parts
            return "Date of birth is incomplete";
        }
    
        // Sanitize input data
        $sanitizedData = $this->sanitizeData($data);
    
        // Calculate age
        $sanitizedData['age'] = $this->calculateAge($sanitizedData['c_date_birth']);
    
        // Hash the password
        $sanitizedData['password'] = password_hash($sanitizedData['password'], PASSWORD_DEFAULT);
    
        // Prepare SQL query with placeholders
        $query = "INSERT INTO citizen (user_type, fullname, address, gender, c_date_birth, age, email, valid_id, phone, password, r_status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
    
        // Use prepared statements to prevent SQL injection
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            'ssssssssss',
            $sanitizedData['user_type'],
            $sanitizedData['fullname'],
            $sanitizedData['address'],
            $sanitizedData['gender'],
            $sanitizedData['c_date_birth'],
            $sanitizedData['age'],
            $sanitizedData['email'],
            $sanitizedData['valid_id'],
            $sanitizedData['phone'],
            $sanitizedData['password']
        );
    
        if ($stmt->execute()) {
            // Insert notification record
            $notificationQuery = "INSERT INTO notifications (type, message) VALUES ('user_registration', ?)";
            $notificationStmt = $this->conn->prepare($notificationQuery);
            $notificationStmt->bind_param('s', $sanitizedData['fullname']);
    
            if ($notificationStmt->execute()) {
                return "Registration successful and notification sent";
            } else {
                return "Registration successful, but failed to send notification";
            }
        } else {
            return "Registration failed";
        }
    }
    
    
    private function calculateAge($birthday) {
        $birthDate = new DateTime($birthday);
        $today = new DateTime('today');
        return $birthDate->diff($today)->y;
    }

    private function sanitizeData($data) {
        foreach ($data as $key => $value) {
            $data[$key] = mysqli_real_escape_string($this->conn, $value);
        }
        return $data;
    }

    private function checkEmailExists($email) {
        $query = "SELECT * FROM citizen WHERE email = '$email'";
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
    }
}
?>
