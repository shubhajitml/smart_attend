<?php
	
	include_once("header.php");
  // student attendence 
	$stmt = $conn->prepare("SELECT * FROM students");
	$stmt->execute();
	$start_Date = "20-01-2019";
	$total_class_days = 90;
	$student_data = "";
	if($stmt->rowCount() > 0)
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$stmt1 =$conn->prepare("SELECT COUNT(*) as attendance_count FROM attendance_sheet WHERE fk_student_id = ".$row['stu_id']); // AND date > $start_Date
			$stmt1->execute();
			$attendance_data = $stmt1->fetch(PDO::FETCH_ASSOC);
			// print_r($attendance_data);
			$atd_percentage = $attendance_data['attendance_count'] / $total_class_days * 100;
			$student_data .= '<tr>
									<td>'.$row['reg_no'].'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['branch'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['mobile'].'</td> 
									<td>'.$attendance_data['attendance_count'].'</td>
									<td>'.number_format($atd_percentage, 2).'</td>
								</tr>';
					
		}
	}

	// faculty attendance
	$f_stmt = $conn->prepare("SELECT * FROM faculty_users");
	$f_stmt->execute();
	$start_Date = "20-01-2019";
	$total_class_days = 90;
	$faculty_data = "";
	if($f_stmt->rowCount() > 0)
	{
		while($f_row = $f_stmt->fetch(PDO::FETCH_ASSOC))
		{
			$f_stmt1 =$conn->prepare("SELECT COUNT(*) as attendance_count FROM fac_attendance_sheet WHERE fk_faculty_id = ".$f_row['fac_id']); // AND date > $start_Date
			$f_stmt1->execute();
			$f_attendance_data = $f_stmt1->fetch(PDO::FETCH_ASSOC);
			// print_r($attendance_data);
			$f_atd_percentage = $f_attendance_data['attendance_count'] / $total_class_days * 100;
			$faculty_data .= '<tr>
									<td>'.$f_row['fac_reg_no'].'</td>
									<td>'.$f_row['name'].'</td>
									<td>'.$f_row['branch'].'</td>
									<td>'.$f_row['email'].'</td>
									<td>'.$f_row['mobile'].'</td> 
									<td>'.$f_attendance_data['attendance_count'].'</td>
									<td>'.number_format($f_atd_percentage, 2).'</td>
								</tr>';
					
		}
	}
?>
    <main role="main" class="container">
		<section>
				<div class="col-xs-12 col-sm-12">
					<div class="card custom-cards">
						<div class="card-header"> Student Attendance Summary</div>
						<div class="card-body">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Registration No.</th>
										<th>Name</th>
										<th>Branch</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Atd Count</th>
										<th>Atd Percentage</th>
									</tr>									
								</thead>
								<tbody>
									<?php echo $student_data; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
				<div class="col-xs-12 col-sm-12">
					<div class="card custom-cards">
						<div class="card-header"> Faculty Attendance Summary</div>
						<div class="card-body">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Registration No.</th>
										<th>Name</th>
										<th>Branch</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Atd Count</th>
										<th>Atd Percentage</th>
									</tr>									
								</thead>
								<tbody>
									<?php echo $faculty_data; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
    </main><!-- /.container -->
<?php include_once("footer.php"); ?>