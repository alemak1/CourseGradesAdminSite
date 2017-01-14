<?php

$pageTitle = "home";

include('inc/header.php');
?>

		<style>

				.jumbotron{
					margin-top: 3em;
				}

				.main-group{
					margin-top: 2em;
				}

				h2{
					text-align: center;
				}

				.list-group a{
					text-align: center;
				}

		</style>

	<div class="container" id="jumbotron-container">
		<div class="jumbotron">
		<div class="container">
		  <h1 class="display-3"> Web Design 101 Course Grading System</h1>
		  <p class="lead">Add/remove/update records for students and grades for the course.</p>
		  <hr class="my-2">
		  <p> Spring 2016 Semester</p>
		  <p class="lead">
		    <a class="btn btn-primary btn-lg" href="#" role="button">Instructions/Documentation</a>
		  </p>
		  </div>
	</div>
	</div>

<div class="container">
	<div class="row">


		<div class="main-group col-xs-12 col-md-10 offset-md-1">


			<h2>Menu</h2>

			<div class="list-group">
			  <a href="search.php" class="list-group-item list-group-item-action">Search a Student's Grade</a>
			  <a href="student_list.php" class="list-group-item list-group-item-action">See All Students </a>
			  <a href="grade_list.php" class="list-group-item list-group-item-action">See All Grades</a>
			  <a href="reports.php" class="list-group-item list-group-item-action">Reports/Analysis</a>
			  <a href="student.php" class="list-group-item list-group-item-action ">Add a New Student</a>
			  <a href="grade.php" class="list-group-item list-group-item-action">Add a New Grade</a>
			</div>
		</div>
	</div>
</div>


<?php
include('inc/footer.php');
?>