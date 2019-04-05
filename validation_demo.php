<?php
header('Access-Control-Allow-Origin: *');
include_once('connection.php');

//$response = file_get_contents("php://input");

if(isset($_GET['fing_serial']) && !empty($_GET['fing_serial']))
{
    // id to search
    $fing_serial = $_GET['fing_serial'];
    
     // mysql search query
    $stu_fing_query = "SELECT * FROM students WHERE fing_serial = :fing_serial";
    
    $stu_fing_result = $conn->prepare($stu_fing_query);
    
    //set your id to the query id
    $stu_fing_exec = $stu_fing_result->execute(array(":fing_serial"=>$fing_serial));
    
    if($stu_fing_result)
    {
        $reg_no     = $_GET['reg_no'];
        $subject_id = $_GET['subject_id'];
        $stu_stmt   = $conn->prepare("SELECT stu_id FROM students WHERE reg_no=".$reg_no);
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
    else{
            echo "Invalid Registration Id or subject Id";
            #exit(0);
        }
    }
}
else{
        echo "Please send registration id and subject Id";
        exit(0);
}
?>