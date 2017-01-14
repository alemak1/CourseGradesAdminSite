<?php


$pageTitle = "grade_list";

include('inc/header.php');
include('css/main.css');
include('inc/functions.php');



?>

<div class="all-title-box">
	<div class="row">
		<div class="col-xs-10 offset-xs-1 ">
			<h2> Grade List </h2>
		</div>
	</div>
</div>

<ul class="list-group col-xs-10 offset-xs-1">

	<style type="text/css">
		.list-group-item{

		}

		.grade-title{
			margin-bottom: 1em;
			margin-top: 1em;
		}
	</style>

	<?php

		if(isset($_GET) && !empty($_GET)){

			if(isset($_GET['student_id']) && !empty($_GET['student_id'])){
				$student_id = $_GET['student_id'];
			}else if(isset($_GET['last_name']) && !empty($_GET['last_name'])){
				$last_name = $_GET['last_name'];
			}else if(isset($_GET['major']) && !empty($_GET['major'])){
				$major = $_GET['major'];
			}else if(isset($_GET['level']) && !empty($_GET['level'])){
				$level = $_GET['level'];
			}

			if(isset($student_id)){
				searchByID($student_id);
			}else if(isset($last_name)){
				searchByLastName($last_name);
			}else if(isset($major)){
				searchByMajor($major);
			}else if(isset($level)){
				searchByLevel($level);
			}else{
				echo '<li> No search criteria specified </li>';
			}

	}else{

		foreach(get_students_list() as $student){
			searchByID($student['student_id']);
		}
		
	}




		
	?>

	

</ul>


<?php
include('inc/footer.php');
?>