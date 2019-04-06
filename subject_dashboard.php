<?php
	include_once("header.php");
    if(isset($_POST['submit']))
    { //print_r($_POST);
        if(isset($_POST['sub_code']) && !empty($_POST['sub_code']) && isset($_POST['nm']) && !empty($_POST['nm']) && isset($_POST['brn']) && !empty($_POST['brn'])&& isset($_POST['sem']) && !empty($_POST['sem'])&& isset($_POST['fac']) && !empty($_POST['fac']) )
        {
            print_r($_POST);
            $sub_code = $_POST['sub_code'];
            $nm = $_POST['nm'];
            $branch = $_POST['brn'];
            $sem = $_POST['sem'];
            $fac = $_POST['fac'];


            $stmt = $conn->prepare("INSERT INTO subjects(`subject_code`, 'subject_name', `branch`, `semester`,`fk_faculty_id`) VALUES(:sub,:nam, :brn, :sem, :fac_id)");
            
            if($stmt->execute(array(
            "sub" => $sub_code,
            "nam" => $nm,
            "brn" => $branch,
            "sem" => $sem,
            "fac" => $fac
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
	
	$stmt = $conn->prepare("SELECT * FROM subjects");
	$stmt->execute();	
	$stmt2 = $conn->prepare("SELECT * FROM faculty_users");
	$stmt2->execute();	

    $faculty_data = "";
    $subject_data = "";
    $option_data = "";
	
	if($stmt2->rowCount() > 0)
	{
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC) )
		{
                                
            $option_data .= "<option value=".$row2['fac_id'].">".$row2['name']."</option>";

                                
		}
	}
	if($stmt->rowCount() > 0)
	{
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
                                
            $subject_data .= '<tr>
									<td>'.$row['subject_code'].'</td>
									<td>'.$row['subject_name'].'</td>
                                    <td>'.$row['branch'].'</td>
                                    <td>'.$row['semester'].'</td>
									<td>'.$row['fk_faculty_id'].'</td>                                    
								</tr>';                     
		}
	}
	
?>
    <main role="main" class="container">
		<section>
			<div class="row">
				<div class="col-xs-12 col-sm-3">
					<div class="card custom-cards">
						<div class="card-header">Subject Registration</div>
						<div class="card-body">
							<form method="POST" action="">
								<div class="form-group">
									<label>Subject Code</label>
									<input type="text" name="sub_code" class="form-control">
								</div>
								<div class="form-group">
									<label>Name</label>
									<input type="text" name="nm" class="form-control">
								</div>
                                <div class="form-group">
									<label>Branch</label>
									<input type="text" name="branch" class="form-control">
								</div>
                                <div class="form-group">
									<label>Semester</label>
									<input type="text" name="sem" class="form-control">
								</div>
								<div class="form-group">
									<label>Faculty</label>
                                    <select name='fac'>
                                    <?php echo $option_data; ?>
                                    </select>
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
                    <div class="card-header"> Subject Data</div>
						<div class="card-body">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Subject Code</th>
										<th>Subject Name</th>
                                        <th>Branch</th>
                                        <th>Semester</th>
                                        <th>Faculty ID</th>
                                        
									</tr>									
								</thead>
								<tbody>
									<?php echo $subject_data; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>

    </main><!-- /.container -->
<?php include_once("footer.php"); ?>