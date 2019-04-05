<?php
header('Access-Control-Allow-Origin: *');
include_once('connection.php');

// $response = file_get_contents("php://input");

// in fingerprint registration phase
if(isset($_GET['reg_no']) && !empty($_GET['reg_no']) && isset($_GET['fing_serial']) && !empty($_GET['fing_serial'])&& isset($_GET['is_student'])&& !empty($_GET['is_student']))
    {
        // check if is student
        if($_GET['is_student'] == 1){
            $reg_no     = $_GET['reg_no'];
            $fing_serial = $_GET['fing_serial'];
            $stu_stmt   = $conn->prepare("UPDATE students SET stu_fing_serial=$fing_serial WHERE reg_no=".$reg_no);
            if ($stu_stmt->execute())
                {
                    echo 'Student record successfully entered';
                }
                else
                {
                    echo 'NOT Success';
                }
            }
        // check if is faculty
        else if($_GET['is_student'] == 0){
            $reg_no     = $_GET['reg_no'];
            $fing_serial = $_GET['fing_serial'];
            $stu_stmt   = $conn->prepare("UPDATE faculty_users SET fac_fing_serial=$fing_serial WHERE reg_no=".$reg_no);
            if ($stu_stmt->execute())
                {
                    echo 'Faculty record successfully entered';
                }
                else
                {
                    echo 'NOT Success';
                }
            }
        }   

// in fingerprint validation phase
else if(isset($_GET['fing_serial']) && !empty($_GET['fing_serial']))
{
    // id to search
   $fing_serial = $_GET['fing_serial'];
    
    // search query
   $stu_fing_query = "SELECT * FROM students WHERE fing_serial = :fing_serial";
   $fac_fing_query = "SELECT * FROM faculty_users WHERE fing_serial = :fing_serial";
   
   
   $stu_fing_result = $conn->prepare($stu_fing_query);
   $fac_fing_result = $conn->prepare($fac_fing_query);
   
   
   //set your serial id to the query serial id
   $stu_fing_exec = $stu_fing_result->execute(array(":fing_serial"=>$fing_serial));
   $fac_fing_exec = $fac_fing_result->execute(array(":fing_serial"=>$fing_serial));
   
// if is student fingerprint
   if($stu_fing_exec)
   {
       // find the student id
       $stu_stmt   = $conn->prepare("SELECT stu_id FROM students WHERE stu_fing_serial=".$fing_serial);
       $stu_stmt->execute();
       if($stu_stmt->rowCount())
       {
           $student_data = $stu_stmt->fetch(PDO::FETCH_ASSOC);
           $attendance_stmt = $conn->prepare("INSERT INTO attendance_sheet(`fk_subject_id`, `fk_student_id`, `date`, `time` )
           VALUES(:fk_subject_id, :fk_student_id, :date, :time)");
           
           if($attendance_stmt->execute(array(
           "fk_subject_id" => $subject_id,
           "fk_student_id" => $student_data['stu_id'],
           'date'=>date('Y-m-d'),
           'time'=>date('H:i:s')
           ))){
               echo 'Success';
           }
           else
           {
               echo 'NOT Success';
           }
        }

// if is faculty fingerprint
    else if($fac_fing_exec){
       // find faculty id
       $fac_stmt   = $conn->prepare("SELECT fac_id FROM faculty_users WHERE fac_fing_serial=".$fing_serial);
       $fac_stmt->execute();
       if($fac_stmt->rowCount())
       {
           $faculty_data = $fac_stmt->fetch(PDO::FETCH_ASSOC);
           $attendance_stmt = $conn->prepare("INSERT INTO fac_attendance_sheet(`fk_subject_id`, `fk_faculty_id`, `date`, `time` )
           VALUES(:fk_subject_id, :fk_faculty_id, :date, :time)");
           
           if($attendance_stmt->execute(array(
           "fk_subject_id" => $subject_id,
           "fk_faculty_id" => $faculty_data['fac_id'],
           'date'=>date('Y-m-d'),
           'time'=>date('H:i:s')
           ))){
               echo 'Success';
           }
           else
           {
               echo 'NOT Success';
           }
    }
   else{
        echo "Invalid Fingerprint Serial";
        #exit(0);
       }
   }
 }
}

else{
    echo "Please send Registration no and Fingerprint Serial";
    exit(0);
    }
?>