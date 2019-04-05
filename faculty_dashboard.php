<?php
	include_once("header.php");
    if(isset($_POST['submit']))
    { //print_r($_POST);
        if(isset($_POST['regd_no']) && !empty($_POST['regd_no'])&& isset($_POST['fac_fing_serial']) && !empty($_POST['fac_fing_serial']) && isset($_POST['nm']) && !empty($_POST['nm']) && isset($_POST['brn']) && !empty($_POST['brn'])&& isset($_POST['mail']) && !empty($_POST['mail'])&& isset($_POST['mob']) && !empty($_POST['mob']) )
        {
            print_r($_POST);
			$regd_no = $_POST['regd_no'];
			$fac_fing_serial = $_POST['fac_fing_serial'];
            $nm = $_POST['nm'];
            $mail = $_POST['mail'];
            $mob = $_POST['mob'];
			$brn = $_POST['brn'];


            $stmt = $conn->prepare("INSERT INTO faculty_users(`fac_reg_no`,'fac_fing_serial', `name`, `email`,`mobile`, `branch`, `created_by`, `created_on` )
            VALUES(:regno,:fac_fing_serial, :nam, :branch, :email, :mobile, :creator, :creationtime)");
            
            if($stmt->execute(array(
			"regno" => $regd_no,
			"fac_fing_serial" => $fac_fing_serial,
            "nam" => $nm,
            "branch" => $brn,
            "email" => $mail,
            "mobile" => $mob,
            "creator" => $_SESSION['uid'],
            "creationtime" => date('Y-m-d H:i:s')
            )))
            {
                echo 'Success';
            }
            else
            {
                echo 'NOT Success';
            }
        }
        else
        {
            echo "All fields are mandatory";
        }
	}
	
	$stmt = $conn->prepare("SELECT * FROM faculty_users");
	$stmt->execute();

	$student_data = "";
	if($stmt->rowCount() > 0)
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$student_data .= '<tr>
									<td>'.$row['fac_reg_no'].'</td>
									<td>'.$row['fac_fing_serial'].'</td>
									<td>'.$row['name'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>'.$row['mobile'].'</td>
									<td>'.$row['branch'].'</td>                                    
								</tr>';
		}
	}
?>
    <main role="main" class="container">
		<section>
			<div class="row">
				<div class="col-xs-12 col-sm-3">
					<div class="card custom-cards">
						<div class="card-header">Add Faculty User</div>
						<div class="card-body">
							<form method="POST" action="">
								<div class="form-group">
									<label>Registration No.</label>
									<input type="text" name="regd_no" class="form-control">
								</div>
								<div class="form-group">
									<label>Finger Serial</label>
									<input type="text" name="fac_fing_serial" class="form-control">
								</div>

								<div class="form-group">
									<label>Name</label>
									<input type="text" name="nm" class="form-control">
								</div>
                                <div class="form-group">
									<label>Email</label>
									<input type="text" name="mail" class="form-control">
								</div>
                                <div class="form-group">
									<label>Mobile</label>
									<input type="text" name="mob" class="form-control">
								</div>
								<div class="form-group">
									<label>Branch</label>
									<input type="text" name="brn" class="form-control">
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-success" value="Submit">
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9">
					<div class="card custom-cards">
                    <div class="card-header"> Faculty List</div>
						<div class="card-body">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Reg. No.</th>
										<th>Faculty Serial</th>
										<th>Name</th>
										<th>Email</th>
                                        <th>Mobile</th>
                                        <th>Branch</th>
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

    </main><!-- /.container -->
<?php include_once("footer.php"); ?>