<?php
require_once __DIR__ . '/../Model/db_connection.php'; 
require_once __DIR__ . '/../Model/citizen_mod.php';
require_once __DIR__ . '/../Model/staff_mod.php';
session_start();

$loggedInUserEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;
if (!$loggedInUserEmail) {
    header("Location: login.php");
    exit();
}

$citizenModel = new Citizen($conn); 
$staffModel = new Staff($conn); // Instantiate Staff model
$userDetails = $citizenModel->getFetchDetails($loggedInUserEmail);
$citizenId = $userDetails['citizend_id'];
function convertTo24HourFormat($time) {
    return date("H:i", strtotime($time));
}

// Function to calculate age based on date of birth
function calculateAge($dateOfBirth) {
    $birthDate = new DateTime($dateOfBirth);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
    return $age;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $baptism_id = isset($_POST['baptism_id']) ? $_POST['baptism_id'] : null;
    $confirmation_id = isset($_POST['confirmation_id']) ? $_POST['confirmation_id'] : null;
    $funeral_id = isset($_POST['funeral_id']) ? $_POST['funeral_id'] : null;
    $wedding_id = isset($_POST['wedding_id']) ? $_POST['wedding_id'] : null;
    $massconfirmation_id = isset($_POST['confirmationannouncement_id']) ? $_POST['confirmationannouncement_id'] : null;
    $weddingannouncement_id = isset($_POST['weddingannouncement_id']) ? $_POST['weddingannouncement_id'] : null;
    $baptismannouncement_id = isset($_POST['baptismannouncement_id']) ? $_POST['baptismannouncement_id'] : null;
    $walkinbaptism_id = isset($_POST['walkinbaptism_id']) ? $_POST['walkinbaptism_id'] : null;
   $walkinfuneral_id = isset($_POST['walkinfuneral_id']) ? $_POST['walkinfuneral_id'] : null;
   $walkinwedding_id= isset($_POST['walkinwedding_id']) ? $_POST['walkinwedding_id'] : null;
   $requestform_id = isset($_POST['requestform_id']) ? $_POST['requestform_id'] : null;
    if($baptism_id){
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';

    if ($month && $day && $year) {
        $c_date_birth = "$year-$month-$day"; 
        // Calculate age
        $age = calculateAge($c_date_birth);
    } else {
        $c_date_birth = ''; 
        $age = ''; // Handle case where date of birth is not provided
    }

    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
    $fatherFullname = $_POST['father_fullname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
    $gender = $_POST['gender'] ?? '';
    $address = $_POST['address'] ?? ''; 
    $pbirth = $_POST['pbirth'] ?? '';
    $motherFullname = $_POST['mother_fullname'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $parentResident = $_POST['parent_resident'] ?? '';
    $godparent = $_POST['godparent'] ?? '';
    $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);

    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);

    // Insert into the schedule
    $scheduleId = $citizenModel->insertSchedule($userDetails['citizend_id'], $date, $startTime, $endTime);
    if ($scheduleId) {
        // Insert into the baptism fill table, including the calculated age
        $citizenModel->insertIntoBaptismFill(
            $scheduleId,
            $fatherFullname,
            $fullname,  
            $gender,
            $c_date_birth,
            $address,         
            $pbirth,
            $motherFullname,
            $religion,
            $parentResident,
            $godparent,
            $age // Insert the calculated age
        );
        $_SESSION['status'] = "success";
        header('Location: ../View/PageCitizen/CitizenPage.php');
        exit();
    } else {
        echo "Failed to insert schedule.";
    }
}else if($confirmation_id){
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';

    if ($month && $day && $year) {
        $c_date_birth = "$year-$month-$day"; 
        // Calculate age
        $age = calculateAge($c_date_birth);
    } else {
        $c_date_birth = ''; 
        $age = ''; // Handle case where date of birth is not provided
    }
    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    if ($month && $day && $year) {
        $date_of_baptism = "$year-$month-$day"; 
    } else {
        $date_of_baptism = ''; 
    }
    // Retrieve form data with default values
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
 
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
   
    $gender = $_POST['c_gender'] ?? '';
    $address = $_POST['c_address'] ?? ''; 
    $name_of_church = $_POST['name_of_church'] ?? '';
    $father_fullname = $_POST['father_fullname'] ?? '';
    $mother_fullname = $_POST['mother_fullname'] ?? '';
    $permission_to_confirm = $_POST['permission_to_confirm'] ?? '';
    $church_address = $_POST['church_address'] ?? '';
    $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);

    // Insert into schedule and get schedule_id
    $scheduleId = $citizenModel->insertSchedule($userDetails['citizend_id'], $date, $startTime, $endTime);

    if ($scheduleId) {
        // Insert into baptismfill
        $citizenModel->insertIntoConfirmFill(
            $scheduleId,
            $fullname ,
            $gender,        
            $c_date_birth,
            $address,       
             $date_of_baptism,
             $name_of_church,
             $father_fullname,
            $mother_fullname,
            $permission_to_confirm,
            $church_address,
            $age
           
        );
        $_SESSION['status'] = "success";
        
        header('Location: ../View/PageCitizen/CitizenPage.php');
        exit();
    } else {
        // Handle error in schedule insertion
        echo "Failed to insert schedule.";
    }
}else if($funeral_id){

    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';
    if ($month && $day && $year) {
        $date_birth = "$year-$month-$day"; 
        $birthage = calculateAge($date_birth);
    } else {
        $date_birth = ''; 
    }

    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    if ($month && $day && $year) {
        $date_of_death = "$year-$month-$day"; 
    } else {
        $date_of_death = ''; 
    }
    // Retrieve form data with default values
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
 
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
   
    $gender = $_POST['d_gender'] ?? '';
    $d_address = $_POST['d_address'] ?? '';
    $cause_of_death = $_POST['cause_of_death'] ?? ''; 
    $marital_status = $_POST['marital_status'] ?? '';
    $place_of_birth = $_POST['place_of_birth'] ?? '';
   
    $father_fullname = $_POST['father_fullname'] ?? '';
    $mother_fullname = $_POST['mother_fullname'] ?? ''; 
    $parents_residence = $_POST['parents_residence'] ?? '';
    $place_of_death = $_POST['place_of_death'] ?? '';
 
 
    
    $d_fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);

    // Insert into schedule and get schedule_id
    $scheduleId = $citizenModel->insertSchedule($userDetails['citizend_id'], $date, $startTime, $endTime);

    if ($scheduleId) {
        // Insert into defuctomfill
        $result = $citizenModel->insertFuneralFill(
            $scheduleId,
            $d_fullname,
            $d_address,
            $gender,
            $cause_of_death,
            $marital_status,
            $place_of_birth,
            $father_fullname,
            $date_birth,
            $birthage,
            $mother_fullname,
            $parents_residence,
            $date_of_death,
            $place_of_death
        );
    

        if ($result) {
            $_SESSION['status'] = "success";
            header('Location: ../View/PageCitizen/CitizenPage.php');
            exit();
        } else {
            echo "Failed to insert funeral details.";
        }
    } else {
        echo "Failed to insert schedule.";
    }
}else if($wedding_id){
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';

    if ($month && $day && $year) {
        $groom_dob = "$year-$month-$day"; 
        $groomage = calculateAge($groom_dob);
    } else {
        $groom_dob = ''; 
    }

    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    if ($month && $day && $year) {
        $bride_dob = "$year-$month-$day"; 
        $brideage =calculateage($bride_dob);
    } else {
        $bride_dob = ''; 
    }

    // Retrieve form data with default values
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
 
    $firstnames = $_POST['firstnames'] ?? '';  
    $lastnames = $_POST['lastnames'] ?? ''; 
    $middlenames = $_POST['middlenames'] ?? ''; 

    $groom_place_of_birth = $_POST['groom_place_of_birth'] ?? '';
    $groom_citizenship = $_POST['groom_citizenship'] ?? ''; 
    $groom_address = $_POST['groom_address'] ?? ''; 
    $groom_religion = $_POST['groom_religion'] ?? '';
    $groom_previously_married = $_POST['groom_previously_married'] ?? '';

    $bride_place_of_birth = $_POST['bride_place_of_birth'] ?? '';
    $bride_citizenship = $_POST['bride_citizenship'] ?? ''; 
    $bride_address = $_POST['bride_address'] ?? '';
    $bride_religion = $_POST['bride_religion'] ?? '';
    $bride_previously_married = $_POST['bride_previously_married'] ?? '';
 
    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);
    $groom_name= trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $bride_name= trim($firstnames . ' ' . $middlenames . ' ' . $lastnames);

    // Insert into schedule and get schedule_id
    $scheduleId = $citizenModel->insertSchedule($userDetails['citizend_id'], $date, $startTime, $endTime);

    if ($scheduleId) {
        // Insert into marriagefill
        $result = $citizenModel->insertWeddingFill(
            $scheduleId,
            $groom_name,
            $groom_dob,
            $groom_place_of_birth,
            $groom_citizenship,
            $groom_address,
            $groom_religion,
            $groom_previously_married,
            $groomage,
            $bride_name,
            $bride_dob,
            $bride_place_of_birth,
            $bride_citizenship,
            $bride_address,
            $bride_religion,
            $bride_previously_married,
            $brideage
        );
    
        if ($result) {
            $_SESSION['status'] = "success";
            header('Location: ../View/PageCitizen/CitizenPage.php');
            exit();
        } else {
            echo "Failed to insert wedding details.";
        }
    } else {
        echo "Failed to insert schedule.";
    }
}else if($massconfirmation_id){
   // Retrieve form data with default values
   $month = $_POST['months'] ?? '';
   $day = $_POST['days'] ?? '';
   $year = $_POST['years'] ?? '';
      if ($month && $day && $year) {
       $date_of_baptism = "$year-$month-$day"; 
       // Calculate age
      
   } else {
       $date_of_baptism = ''; 
   }
   $months = $_POST['month'] ?? '';
   $days = $_POST['day'] ?? '';
   $years = $_POST['year'] ?? '';
    if ($month && $day && $year) {
       $c_date_birth = "$year-$month-$day"; 
       // Calculate age
       $cage = calculateAge($c_date_birth);
   } else {
       $c_date_birth = ''; 
       $cage = ''; // Handle case where date of birth is not provided
   }
   $firstname = $_POST['firstname'] ?? '';  
   $lastname = $_POST['lastname'] ?? ''; 
   $middlename = $_POST['middlename'] ?? ''; 
   $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
   
   $gender = $_POST['c_gender'] ?? '';
   $address = $_POST['c_address'] ?? ''; 
   $father_fullname = $_POST['father_fullname'] ?? '';
   $mother_fullname = $_POST['mother_fullname'] ?? '';
   $permission_to_confirm= $_POST['permission_to_confirm'] ?? '';
   $church_address = $_POST['church_address'] ?? '';
   $name_of_church = $_POST['name_of_church'] ?? '';

   // Define default values for status, event_name, and role
   $status = 'Pending';
   $eventName = 'MassConfirmation';
   $role = 'Online';
   $announcementId = $_POST['announcement_id'] ?? '';

   // Check if the announcement_id exists using the Staff model
   $announcement = $staffModel->getAnnouncementById($announcementId);

   if ($announcement) {
       // Complete the reservation if the form is filled out
      
           // Insert data into baptismfill
           $citizenModel->insertIntoMassConfirmFill(
               $citizenId,
               $announcementId,
               $fullname,
               $gender,
               $c_date_birth,
               $cage,
               $address, 
               $date_of_baptism,
               $name_of_church,
               $father_fullname,
               $mother_fullname,
               $permission_to_confirm,
               $church_address,
               $status,
               $eventName,
               $role
           );
           
           $_SESSION['status'] = "success";
       
           header('Location: ../View/PageCitizen/CitizenPage.php');
           exit();
      
   } else {
       // Handle the case where the announcement_id does not exist
       echo "Announcement ID $announcementId does not exist.";
   }

}else if($weddingannouncement_id){
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';

    if ($month && $day && $year) {
        $groom_dob = "$year-$month-$day"; 
        $groomage = calculateAge($groom_dob);
    } else {
        $groom_dob = ''; 
    }


   $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    if ($month && $day && $year) {
        $bride_dob = "$year-$month-$day"; 
        $brideage =calculateage($bride_dob);
    } else {
        $bride_dob = ''; 
    }
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
    $firstnames = $_POST['firstnames'] ?? '';  
    $lastnames = $_POST['lastnames'] ?? ''; 
    $middlenames = $_POST['middlenames'] ?? ''; 
    $groom_place_of_birth = $_POST['groom_place_of_birth'] ?? '';
    $groom_citizenship = $_POST['groom_citizenship'] ?? ''; 
    $groom_address = $_POST['groom_address'] ?? ''; 
    $groom_religion = $_POST['groom_religion'] ?? '';
    $groom_previously_married = $_POST['groom_previously_married'] ?? '';

    $bride_place_of_birth = $_POST['bride_place_of_birth'] ?? '';
    $bride_citizenship = $_POST['bride_citizenship'] ?? ''; 
    $bride_address = $_POST['bride_address'] ?? '';
    $bride_religion = $_POST['bride_religion'] ?? '';
    $bride_previously_married = $_POST['bride_previously_married'] ?? '';
    $groom_name= trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $bride_name= trim($firstnames . ' ' . $middlenames . ' ' . $lastnames);
    $announcementId = $_POST['announcement_id'] ?? '';
    $status = 'Pending';
    $eventName = 'MassWedding';
    $role = 'Online';


    $announcement = $staffModel->getAnnouncementById($announcementId);
    if ($announcement) {
     
        $citizenModel->insertMassWeddingFill(
            $citizenId,
            $announcementId,
            $groom_name,
            $groom_dob,
            $groom_place_of_birth,
            $groom_citizenship,
            $groom_address,
            $groom_religion,
            $groom_previously_married,
            $groomage,
            $bride_name,
            $bride_dob,
            $bride_place_of_birth,
            $bride_citizenship,
            $bride_address,
            $bride_religion,
            $bride_previously_married,
            $brideage,
            $status,
            $eventName,
            $role
            
        );
        $_SESSION['status'] = "success";
        
        header('Location: ../View/PageCitizen/CitizenPage.php');
           exit();
           
    
 }
        else {
           echo "Announcement ID $announcementId does not exist.";
       }
}else if($baptismannouncement_id){
  $month = $_POST['month'] ?? '';
  $day = $_POST['day'] ?? '';
  $year = $_POST['year'] ?? '';

  if ($month && $day && $year) {
    $dateOfBirth = "$year-$month-$day"; 
      // Calculate age
      $age = calculateAge($dateOfBirth);
  } else {
    $dateOfBirth = ''; 
      $age = ''; // Handle case where date of birth is not provided
  }


  $firstname = $_POST['firstname'] ?? '';  
  $lastname = $_POST['lastname'] ?? ''; 
  $middlename = $_POST['middlename'] ?? ''; 
  $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
  
  $gender = $_POST['gender'] ?? '';
  $address = $_POST['address'] ?? ''; 
  $fatherFullname = $_POST['father_fullname'] ?? '';
  $motherFullname = $_POST['mother_fullname'] ?? '';
  $religion = $_POST['religion'] ?? '';
  $placeOfBirth = $_POST['pbirth'] ?? '';
  $parentResident = $_POST['parent_resident'] ?? '';
  $godparent = $_POST['godparent'] ?? '';
  
  // Retrieve announcement_id from form data
  $announcementId = $_POST['announcement_id'] ?? '';
  
  // Define default values for status, event_name, and role
  $status = 'Pending';
  $eventName = 'MassBaptism';
  $role = 'Online';

  // Check if the announcement_id exists using the Staff model
  $announcement = $staffModel->getAnnouncementById($announcementId);

  if ($announcement) {
      // Insert data into baptismfill
  
      $citizenModel->insertMassBaptismFill(
          $citizenId,
          $announcementId,
          $fullname,
          $gender,
          $address,
          $dateOfBirth, 
          $fatherFullname,
          $placeOfBirth,
          $motherFullname,
          $religion,
          $parentResident,
          $godparent,
          $age ,
          $status,
          $eventName,
          $role
      );
  
      $_SESSION['status'] = "success";
      
      header('Location: ../View/PageCitizen/CitizenPage.php');
      exit();
  
} else {
      // Handle the case where the announcement_id does not exist
      echo "Announcement ID $announcementId does not exist.";
  }
}

//-----------------------------------------WALK IN AREA FILLUP --------------------------------------------------------
else if($walkinbaptism_id){
// Check if the form data is provided
$month = $_POST['month'] ?? '';
$day = $_POST['day'] ?? '';
$year = $_POST['year'] ?? '';

if ($month && $day && $year) {
    $c_date_birth = "$year-$month-$day"; 
    // Calculate age
    $age = calculateAge($c_date_birth);
} else {
    $c_date_birth = ''; 
    $age = ''; // Handle case where date of birth is not provided
}

$date = $_POST['date'] ?? '';
$startTime = $_POST['start_time'] ?? '';
$endTime = $_POST['end_time'] ?? '';
$fatherFullname = $_POST['father_fullname'] ?? '';
$firstname = $_POST['firstname'] ?? '';  
$lastname = $_POST['lastname'] ?? ''; 
$middlename = $_POST['middlename'] ?? ''; 
$gender = $_POST['gender'] ?? '';
$address = $_POST['address'] ?? ''; 
$pbirth = $_POST['pbirth'] ?? '';
$motherFullname = $_POST['mother_fullname'] ?? '';
$religion = $_POST['religion'] ?? '';
$parentResident = $_POST['parent_resident'] ?? '';
$godparent = $_POST['godparent'] ?? '';
$fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);

// Convert times to 24-hour format
$startTime = convertTo24HourFormat($startTime);
$endTime = convertTo24HourFormat($endTime);

// Insert into the schedule
$scheduleId = $citizenModel->insertSchedule(null, $date, $startTime, $endTime);

if ($scheduleId) {
    // Insert into the baptism fill table, including the calculated age
    $baptismfillId = $citizenModel->insertIntoWalkinBaptismFill(
        $scheduleId,
        $fatherFullname,
        $fullname,  
        $gender,
        $c_date_birth,
        $address,         
        $pbirth,
        $motherFullname,
        $religion,
        $parentResident,
        $godparent,
        $age // Insert the calculated age
    );

    // After the walkinbaptism_id is retrieved from the insertion
    if ($baptismfillId) {
        // Handle the Sundays data
        if (isset($_POST['sundays'])) {
            $selected_sunday = explode('|', $_POST['sundays']);
            if (count($selected_sunday) === 4) {
                $schedule_id = $selected_sunday[0];  // Randomly generated schedule ID
                $sunday = $selected_sunday[1];       // Formatted date (e.g., 'Sun Oct 06 2024')
                $start_time = $selected_sunday[2];   // '9:00 AM'
                $end_time = $selected_sunday[3];     // '11:00 AM'
            } else {
                die("Error: Expected 4 values for sundays.");
            }
        } else {
            die("Error: No sundays data provided.");
        }

        $priestId = $_POST['eventType'] ?? null;
        $payableAmount = $_POST['pay_amount'] ?? null;

        // Validate required form data
        if (!$sunday || !$start_time || !$end_time || !$payableAmount || !$priestId) {
            die('Error: Missing required form data.');
        }

        // Insert into schedule for the seminar
        $appointment = new Staff($conn);
        $seminarScheduleId = $appointment->insertSchedule($sunday, $start_time, $end_time, 'Seminar');

        if ($seminarScheduleId) {
            // Insert into appointment using $walkinbaptism_id instead of $baptismfill_id
            $appointmentResult = $citizenModel->insertAppointment($baptismfillId, $payableAmount, $priestId, $seminarScheduleId);

            if ($appointmentResult) {
                // Approve baptism using $walkinbaptism_id instead of $baptismfill_id
                $approvalResult = $appointment->approveBaptism($baptismfillId);

                if ($approvalResult) {
                    $_SESSION['status'] = "success";
                    header('Location: ../View/PageStaff/StaffDashboard.php');
                    exit();
                } else {
                    echo "Failed to approve baptism.";
                }
            } else {
                echo "Failed to insert appointment.";
            }
        } else {
            echo "Failed to insert seminar schedule.";
        }
    } else {
        echo "Failed to insert into baptism fill.";
    }
} else {
    echo "Failed to insert schedule.";
}

// WALK IN FUNERAL

}else if($walkinfuneral_id){
    $appointment = new Staff($conn);
    $citizenModel = new Citizen($conn); 
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';
    $date_birth = ($month && $day && $year) ? "$year-$month-$day" : '';
    
    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    $date_of_death = ($month && $day && $year) ? "$year-$month-$day" : '';
    
    // Process other form data
    $date = $_POST['date'] ?? '';
    $startTime = convertTo24HourFormat($_POST['start_time'] ?? '');
    $endTime = convertTo24HourFormat($_POST['end_time'] ?? '');
    
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $d_fullname = trim("$firstname $middlename $lastname");
    
    $gender = $_POST['d_gender'] ?? '';
    $d_address = $_POST['d_address'] ?? '';
    $cause_of_death = $_POST['cause_of_death'] ?? '';
    $marital_status = $_POST['marital_status'] ?? '';
    $place_of_birth = $_POST['place_of_birth'] ?? '';
    $father_fullname = $_POST['father_fullname'] ?? '';
    $mother_fullname = $_POST['mother_fullname'] ?? '';
    $parents_residence = $_POST['parents_residence'] ?? '';
    $place_of_death = $_POST['place_of_death'] ?? '';
    
    $birthage = ($date_birth) ? calculateAge($date_birth) : null;
    
    // Insert into schedule and get schedule_id
    $scheduleId = $citizenModel->insertSchedule(NULL, $date, $startTime, $endTime);
    
    if ($scheduleId) {
        // Insert into defuctomfill
        $defuctomfill_id = $citizenModel->insertWalkinFuneralFill(
            $scheduleId, $d_fullname, $d_address, $gender, $cause_of_death,
            $marital_status, $place_of_birth, $father_fullname, $date_birth,
            $birthage, $mother_fullname, $parents_residence, $date_of_death, $place_of_death
        );
    
        if ($defuctomfill_id) {

            $priestId = $_POST['eventType'] ?? null;
            $payableAmount = $_POST['pay_amount'] ?? null;
    
            // Validate required form data
            if ( !$payableAmount || !$priestId) {
                die('Error: Missing required form data.');
            }
    
            $result = $appointment->insertfAppointment($defuctomfill_id, $payableAmount, $priestId);
    
            if ($result) {
                $appointment->approveFuneral($defuctomfill_id);
                $_SESSION['status'] = "success";
                header('Location: ../View/PageStaff/StaffDashboard.php');
                exit();
            } else {
                echo "Failed to insert appointment details.";
            }
        } else {
            echo "Failed to insert funeral details.";
        }
    } else {
        echo "Failed to insert schedule.";
    }
    
}else if($walkinwedding_id){
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';

    if ($month && $day && $year) {
        $groom_dob = "$year-$month-$day"; 
        $groomage = calculateAge($groom_dob);
    } else {
        $groom_dob = ''; 
    }

    $month = $_POST['months'] ?? '';
    $day = $_POST['days'] ?? '';
    $year = $_POST['years'] ?? '';
    if ($month && $day && $year) {
        $bride_dob = "$year-$month-$day"; 
        $brideage =calculateage($bride_dob);
    } else {
        $bride_dob = ''; 
    }

    // Retrieve form data with default values
    $date = $_POST['date'] ?? '';
    $startTime = $_POST['start_time'] ?? '';
    $endTime = $_POST['end_time'] ?? '';
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
 
    $firstnames = $_POST['firstnames'] ?? '';  
    $lastnames = $_POST['lastnames'] ?? ''; 
    $middlenames = $_POST['middlenames'] ?? ''; 

    $groom_place_of_birth = $_POST['groom_place_of_birth'] ?? '';
    $groom_citizenship = $_POST['groom_citizenship'] ?? ''; 
    $groom_address = $_POST['groom_address'] ?? ''; 
    $groom_religion = $_POST['groom_religion'] ?? '';
    $groom_previously_married = $_POST['groom_previously_married'] ?? '';

    $bride_place_of_birth = $_POST['bride_place_of_birth'] ?? '';
    $bride_citizenship = $_POST['bride_citizenship'] ?? ''; 
    $bride_address = $_POST['bride_address'] ?? '';
    $bride_religion = $_POST['bride_religion'] ?? '';
    $bride_previously_married = $_POST['bride_previously_married'] ?? '';
 
    $startTime = convertTo24HourFormat($startTime);
    $endTime = convertTo24HourFormat($endTime);
    $groom_name= trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $bride_name= trim($firstnames . ' ' . $middlenames . ' ' . $lastnames);

    // Insert into schedule and get schedule_id
    $scheduleId = $citizenModel->insertSchedule(NULL, $date, $startTime, $endTime);
    if ($scheduleId) {
        // Insert into marriagefill
        $weddingffill_id = $citizenModel->insertWeddingFill(
            $scheduleId,
            $groom_name,
            $groom_dob,
            $groom_place_of_birth,
            $groom_citizenship,
            $groom_address,
            $groom_religion,
            $groom_previously_married,
            $groomage,
            $bride_name,
            $bride_dob,
            $bride_place_of_birth,
            $bride_citizenship,
            $bride_address,
            $bride_religion,
            $bride_previously_married,
            $brideage
        );
    
        if ($weddingffill_id) {
            // Handle the Sundays data
            if (isset($_POST['saturdays'])) {
                $selected_sunday = explode('|', $_POST['saturdays']);
                if (count($selected_sunday) === 4) {
                    $schedule_id = $selected_sunday[0];  // Randomly generated schedule ID
                    $sunday = $selected_sunday[1];       // Formatted date (e.g., 'Sun Oct 06 2024')
                    $start_time = $selected_sunday[2];   // '8:00 AM'
                    $end_time = $selected_sunday[3];     // '5:00 PM' change this to be military time
                } else {
                    die("Error: Expected 4 values for saturdays.");
                }
            } else {
                die("Error: No saturdays data provided.");
            }
    
            $priestId = $_POST['eventType'] ?? null;
            $payableAmount = $_POST['pay_amount'] ?? null;
    
            // Validate required form data
            if (!$sunday || !$start_time || !$end_time || !$payableAmount || !$priestId) {
                die('Error: Missing required form data.');
            }
    
            // Insert into schedule for the seminar
            $appointment = new Staff($conn);
            $seminarScheduleId = $appointment->insertSchedule($sunday, $start_time, $end_time, 'Seminar');
    
            if ($seminarScheduleId) {
                // Insert into appointment using $walkinbaptism_id instead of $baptismfill_id
                $appointmentResult = $citizenModel->insertwAppointment($weddingffill_id, $payableAmount, $priestId, $seminarScheduleId);
    
                if ($appointmentResult) {
                    // Approve baptism using $walkinbaptism_id instead of $baptismfill_id
                    $approvalResult = $appointment->approveWedding($weddingffill_id);
    
                    if ($approvalResult) {
                        $_SESSION['status'] = "success";
                        header('Location: ../View/PageStaff/StaffDashboard.php');
                        exit();
                    } else {
                        echo "Failed to approve Wedding.";
                    }
                } else {
                    echo "Failed to insert appointment.";
                }
            } else {
                echo "Failed to insert seminar schedule.";
            }
        } else {
            echo "Failed to insert into  Wedding fill.";
        }
    } else {
        echo "Failed to insert schedule.";
    }
}else if ($requestform_id) {
    $datetofollowup = $_POST['datetofollowup'] ?? '';

    $selectrequest = $_POST['selectrequest'] ?? '';
    $chapel = $_POST['chapel'] ?? '';
    $firstname = $_POST['firstname'] ?? '';  
    $lastname = $_POST['lastname'] ?? ''; 
    $middlename = $_POST['middlename'] ?? ''; 
    $firstnames = $_POST['firstnames'] ?? '';  
    $lastnames = $_POST['lastnames'] ?? ''; 
    $middlenames = $_POST['middlenames'] ?? ''; 
    $address = $_POST['address'] ?? ''; 
    $cpnumber = $_POST['cpnumber'] ?? '';

    $fullname = trim($firstname . ' ' . $middlename . ' ' . $lastname);
    $fullnames = trim($firstnames . ' ' . $middlenames . ' ' . $lastnames);


    // Insert into the baptism fill table
    $citizenModel->insertRequestFormFill(
        $selectrequest,
        $fullname,  
        $datetofollowup,
        $address,         
        $cpnumber,
        $fullnames,
        $chapel
    );

    $_SESSION['status'] = "success";
    header('Location: ../View/PageStaff/StaffDashboard.php');
    exit();
}

}
?>
