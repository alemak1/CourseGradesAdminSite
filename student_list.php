<?php

$pageTitle = "student_list";

include('inc/header.php');
include('css/main.css');
include('inc/functions.php');

if(isset($_POST['delete'])){

	if(delete_student(filter_input(INPUT_POST,'delete',FILTER_SANITIZE_NUMBER_INT))){
		echo '<script type="text/javascript">window.location = "student_list.php?msg=Student+Deleted"; </script>';
		exit;
	}else{
		echo '<script type="text/javascript">window.location = "student_list.php?msg=Unable+To+Delete+Student"; </script>';
		exit;
	}

}

if(isset($_GET['msg'])){
	$error_message = trim(filter_input(INPUT_GET,'msg',FILTER_SANITIZE_STRING));

}


?>

<div class="container all-title-box">
	<div class="row">
		<div class="col-xs-6 offset-xs-2">
			<h2> Current Students: </h2>
		</div>
	</div>
</div>


<style>
	.grade-link{
		width: 10em;
		padding: 2px;
		border-radius: 5%;
	}

		
	}
</style>


<?php

if(isset($error_message)){ ?>
		<div class="container">		
		<div class="alert alert-danger" role="alert">
	  		<strong>Error:</strong> <?php echo $error_message; ?>
		</div>
		</div>
<?php } ?>

<ul class="list-group col-xs-8 offset-xs-2">
	<?php foreach(get_students_list() as $student){ ?> 
		  <li class="list-group-item">
		  	<a href="student.php?student_id=<?php echo $student['student_id']; ?>" title="">
		    <span class="tag tag-default tag-pill float-xs-right hidden-sm-down"> <?php echo $student['level']?></span>
		    <?php echo $student['first_name'] . ' ' . $student['last_name'] . '(' . $student['student_id'] . ')' . '/' ?>
		    <?php echo 'Major: ' . $student['major'] ?>
		    </a>

		    <div class="row">	
		      <a href="grade_list.php?student_id=<?php echo $student['student_id']; ?>" title=""><p class="bg-success text-white grade-link col-xs-3"> View Grades</p></a>


		      <?php
		      	echo "<form method='post' action='student_list.php'>";
		      	echo "<input type='hidden' value='" . $student['student_id'] . "' name='delete' onsubmit='" . "return confirm('Are you sure you want to delete this student?');" ."'>";
		      	echo "<input type='submit' class='btn btn-danger btn-sm col-xs-2 offset-xs-1' value='Delete'> </input>";
		      	echo "</form>";
		      ?>
		      </div>
		  </li>

	  <?php } ?>

</ul>


<?php
include('inc/footer.php');
?>