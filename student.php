<?php


include('inc/functions.php');


$pageTitle = "student";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['student_id'])){
		$willUpdate = true;
		list($major,$level,$first_name,$last_name,$student_id) = get_student(filter_input(INPUT_GET,'student_id',FILTER_SANITIZE_NUMBER_INT));
	}
}


include('inc/header.php');
include('css/main.css');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$student_id = trim(filter_input(INPUT_POST,'student_id',FILTER_SANITIZE_NUMBER_INT));
	$first_name =trim(filter_input(INPUT_POST,'first_name',FILTER_SANITIZE_STRING));
	$last_name = trim(filter_input(INPUT_POST,'last_name',FILTER_SANITIZE_STRING));
	$major = trim(filter_input(INPUT_POST,'major',FILTER_SANITIZE_STRING));
	$level = trim(filter_input(INPUT_POST,'level',FILTER_SANITIZE_STRING));
	$willUpdate = trim(filter_input(INPUT_POST,'willUpdate',FILTER_SANITIZE_STRING));
	var_dump($willUpdate);
	
	if(empty($student_id) || empty($first_name) || empty($last_name) || empty($major) || empty($level)){
		$error_message = "Please fill in all the values: Student ID, First Name, Last Name, Major, and Level";
	}else{
		if($willUpdate == "yes"){
			if(update_student($student_id,$first_name,$last_name,$major,$level)){
				echo '<script type="text/javascript">window.location = "student.php?status=updated"; </script>';
				exit;
			}else{
				$error_message = "Failed to update student";
			}
		}else if(add_student($student_id,$first_name,$last_name,$major,$level,false)){
				echo '<script type="text/javascript">window.location = "student.php?status=added"; </script>';
				exit;
		}else{
			$erro_message = "Could not add student.  Please try again.";
		}

	}

}


?>

<div class="container">
	<div class="row">
		<div class="title-box offset-xs-1 col-xs-10 offset-sm-2 col-md-7 col-lg-6">
<?php if(isset($error_message)){  ?>

	<div class="alert alert-danger" role="alert">
  		<strong>Error:</strong> <?php echo $error_message; ?>
	</div>

<?php }else if(isset($_GET['status']) && $_GET['status'] == 'added') { ?>

	<div class="alert alert-success" role="alert">
	  <strong>Added!</strong> Student successfully added to database! Want to add another student?
	</div>

<?php }else if(isset($_GET['status']) && $_GET['status'] == 'updated'){ ?>

	<div class="alert alert-success" role="alert">
	  <strong>Updated!</strong> Student successfully updated to database!
	</div>

<?php }else{ ?>

<h2 class="main-title ">
	<?php
	if(isset($student_id)){
		echo "Update a ";
	}else{
		echo "Add a ";
	}

	?>

	student
</h2>

<?php } ?>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<form action="student.php" method="post" class="offset-xs-1 col-xs-10 offset-sm-2 col-md-7 col-lg-6">
			<div class="row">

				<div class="form-group col-xs-12 <?php if(empty($student_id)){ echo 'has-danger'; }?>">
					<div class="row ">
						<label for="student_id" class="col-xs-4">Student ID: </label>
						<input class="form-control col-xs-3" type="text" placeholder=" <?php if(isset($student_id)){ echo $student_id; }?> " name="student_id">

						<?php
							if($willUpdate){
								echo "<input type='hidden' name='willUpdate' value='yes'></input>";
							}
						?>

					</div>
				</div>

				<div class="form-group col-xs-12 <?php if(empty($first_name)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="first_name" class="col-xs-4">First Name: </label>
						<input class="form-control col-xs-3" type="text" placeholder="<?php if(isset($student_id)){ echo $first_name; }?>" name="first_name">
					</div>
				</div>


				<div class="form-group col-xs-12 <?php if(empty($last_name)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="last_name" class="col-xs-4">Last Name: </label>
						<input class="form-control col-xs-3" type="text" placeholder="<?php if(isset($student_id)){ echo $last_name; }?>" name="last_name">
					</div>
				</div>

				<div class="form-group col-xs-12 <?php if(empty($major)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="major" class="col-xs-4">Major: </label>
						<input class="form-control col-xs-3" type="text" placeholder="<?php if(isset($student_id)){ echo $major; }?>" name="major">
					</div>
				</div>



				<div class="form-group col-xs-12 <?php if(empty($level)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="level" class="col-form-label col-xs-2">Level: </label>
						<select class="custom-select col-xs-5" name="level" id="level">
						  <option selected value="Freshman">Freshman</option>
						  <option value="Sophomore">Sophomore</option>
						  <option value="Junior">Junior</option>
						  <option value="Senior">Senior</option>
						</select>
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>

	</div>
</div>




<?php
include('inc/footer.php');
?>



