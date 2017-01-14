<?php

$pageTitle = "grade";

include('inc/header.php');
include('css/main.css');
include('inc/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$student_id = trim(filter_input(INPUT_POST,'student_id',FILTER_SANITIZE_NUMBER_INT));
	$title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
	$description =trim(filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING));
	$date = trim(filter_input(INPUT_POST,'date',FILTER_SANITIZE_STRING));
	$earned_points = trim(filter_input(INPUT_POST,'earned_points',FILTER_SANITIZE_NUMBER_INT));
	$max_points = trim(filter_input(INPUT_POST,'max_points',FILTER_SANITIZE_NUMBER_INT));

	if(empty($student_id) || empty($date) || empty($description) || empty($earned_points) || empty($max_points) || empty($title)){
		$error_message = "Please fill in all the values: Student ID, First Name, Last Name, Major, and Level";
	}else{
		if(add_grade($student_id, $date, $title, $description, $max_points, $earned_points)){
				echo '<script type="text/javascript">window.location = "grade.php?status=added"; </script>';
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
	  <strong>Success!</strong> Grade successfully added to database! Want to add another grade?
	</div>

<?php }else{ ?>

<h2 class="main-title ">Enter a grade: </h2>

<?php } ?>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<form action="grade.php" method="post" class="offset-xs-1 col-xs-10 offset-sm-2 col-md-8 col-lg-9">
			<div class="row">



				<div class="form-group col-xs-12 <?php if(empty($student_id)){ echo 'has-danger'; }?>">
					<div class="row ">



						<label for="student_id" class="col-xs-4"> Select student: </label>
						<select class="custom-select col-xs-8" name="student_id" id="student_id">
						  <?php
						  	foreach(get_students_list() as $student){
						  		echo '<option>';
						  		echo $student['first_name'] . ' ' . $student['last_name'] . '(' . $student['student_id'] . ')';
						  		echo '/Major: ' . $student['major'];
						  		echo '</option>';
						  	}

						  ?>
						</select>
						
					</div>
				</div>

				<div class="form-group col-xs-6 <?php if(empty($title)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="title" class="">Title: </label>
						<input class="form-control" type="text" placeholder="<?php if(isset($title)){ echo $title; }?>" name="title">
					</div>
				</div>

				<div class="form-group offset-xs-2 col-xs-4 <?php if(empty($date)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="date" class="">Date: </label>
						<input class="form-control" type="text" placeholder="<?php if(isset($date)){ echo $date; }?>" name="date">
					</div>
				</div>
				


				<div class="form-group col-xs-12 <?php if(empty($description)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="description" class="col-xs-4">Description: </label>
						<input class="form-control col-xs-3" type="text" placeholder="<?php if(isset($description)){ echo $description; }?>" name="description">
					</div>
				</div>

				<div class="form-group col-xs-5 <?php if(empty($earned_points)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="earned_points" class="">Points Earned: </label>
						<input class="form-control" type="text" placeholder="<?php if(isset($earned_points)){ echo $earned_points; }?>" name="earned_points">
					</div>
				</div>

				<div class="form-group offset-xs-2 col-xs-5 <?php if(empty($max_points)){ echo 'has-danger'; }?>">
					<div class="row">
						<label for="max_points" class="">Total Points Possible: </label>
						<input class="form-control" type="text" placeholder="<?php if(isset($max_points)){ echo $max_points; }?>" name="max_points">
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