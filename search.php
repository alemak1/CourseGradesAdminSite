<?php


$pageTitle = "search";

include('inc/header.php');
include('css/main.css');
include('inc/functions.php');

?>

<style>
	.input-group{
		margin-bottom: 2em;
	}

	#search-box{
		margin-top: 3em;
	}
</style>

	<div class="container-fluid">

	<form action="grade_list.php" method="get">

	<div class="container-fluid" id="search-box">
		<div class="row">
			 <div class="offset-xs-3 col-xs-6">
			    <div class="input-group">
			      <span class="input-group-btn">		      
			        <button class="btn btn-secondary" type="submit">Search by Student ID</button>	
			      </span>
			      <input type="text" class="form-control" placeholder="Enter Student ID..." name="student_id">
			    </div>
			  </div>

			   <div class="offset-xs-3 col-xs-6">
			    <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-secondary" type="submit">Search by Last Name: </button>
			      </span>
			      <input type="text" class="form-control" placeholder="Enter Last Name..." name="last_name">
			    </div>
			  </div>

			    <div class="offset-xs-3 col-xs-6">
			    <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-secondary" type="submit">Search by Major: </button>
			      </span>
			      <input type="text" class="form-control" placeholder="Enter Major..." name="major">
			    </div>
			  </div>

			   <div class="offset-xs-3 col-xs-6">
			    <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-secondary" type="submit">Search by Level: </button>
			      </span>
			      <input type="text" class="form-control" placeholder="Enter Level(i.e. freshman, sophomore,etc)..." name="level">
			    </div>
			  </div>
		</div>
	</div>
	
	</form>

	</div>

<?php

include('inc/footer.php');

?>