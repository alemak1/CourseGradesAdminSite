<?php

include('connection.php');
include('functions.php');

?>


<?php

var_dump($_SERVER['REQUEST_METHOD']);

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$student_id = trim(filter_input(INPUT_POST,'student_id',FILTER_SANITIZE_STRING));
	$grade_id = trim(filter_input(INPUT_POST,'grade_id',FILTER_SANITIZE_NUMBER_INT));
	$title = trim(filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING));
	$description = trim(filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING));
	$earned_points = trim(filter_input(INPUT_POST,'earned_points',FILTER_SANITIZE_NUMBER_INT));
	$max_points = trim(filter_input(INPUT_POST,'max_points',FILTER_SANITIZE_NUMBER_INT));
	$date = trim(filter_input(INPUT_POST,'date',FILTER_SANITIZE_STRING));

	var_dump($student_id);
	var_dump($grade_id);
	var_dump($title);
	var_dump($description);
	var_dump($max_points);
	var_dump($earned_points);
	var_dump($date);

	$dateMatch = explode('/',$date);


	if(	empty($student_id) || 	
		empty($grade_id) ||
		empty($date) || 
		empty($title) || 
		empty($description) || 
		empty($max_points) ||
		empty($earned_points) ||
		count($dateMatch) != 3 ||
		strlen($dateMatch[0]) != 2 ||
		strlen($dateMatch[1]) != 2 ||
		strlen($dateMatch[2] != 4)){
		
			$error_message = "Please enter a value for: Student ID, Grade ID, Title, Description, Max Points, and Earned Points";
	}else{
		if(add_grade($student_id,$grade_id,$date,$title,$description,$max_points,$earned_points)){
			echo '<h4> Grade Added! </h4>';
			header('location:test_functions.php?status=thanks');
			exit;
		}else{
			$error_message = "Could not add student";
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php

if(isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'thanks'){
	echo '<h1> New student added! Thank you! </h1>';
	exit;
}


echo '<ul>';

foreach(get_students_list() as $student){
	echo '<li>';
	echo $student['student_id'] . ' ' . $student['first_name'] . ' ' . $studentp['last_name'] .  ' ' . $student['major'];
	echo '</li>';
}

echo '</ul>';


echo '<ul>';

foreach(get_grades_list() as $grade){
	echo '<li>';

	echo 'Student Name: ';
	echo $grade['first_name'] . ' ' . $grade['last_name'] . '<br/>';

	echo 'Grade Information: ';
	echo $grade['title'] . ": " . $grade['description'] . ' on ' . $grade['date'] .  '<br/>';
	echo $grade['earned_points'] . "/" . $grade['max_points'] . '<br/>';
	echo '</li>';
}

echo '</ul>';

?>

<?php

if(isset($error_message)){
	echo '<h2> Error: </h2>' . $error_message;
}

?>

<form action="./test_functions.php" method="post">

	<label for="student_id"></label>
	<select name="student_id" id="student_id" >
		<?php
			foreach(get_students_list() as $student){
				echo "<option value= '" . $student['student_id'] . "' >";
					echo "Student name: " . $student['first_name'] . ' ' . $student['last_name'] . "(". $student['student_id'] .")" ;
				echo "</option>";
			}

		?>
		
	</select>

	<label for="grade_id"> Grade ID: <input type="text" name="grade" id="grade" placeholder="<?php 
		echo htmlspecialchars($grade_id);
	?>"> </label> <br>
	<label for="title"> Title: <input type="text" name="title" id="title" placeholder="<?php echo htmlspecialchars($title); ?>"> </label> <br>
	<label for="description"> Description: <input type="text" name="description" id="description" placeholder="<?php echo htmlspecialchars($description); ?>"> </label> <br>
	<label for="date"> Date: <input type="text" name="date" id="date" placeholder="<?php echo htmlspecialchars($date); ?>"> </label> <br>
	<label for="max_points"> Max Points Possible: <input type="text" name="max_points" id="max_points" placeholder="<?php echo htmlspecialchars($max_points); ?>"> </label> <br>
	<label for="earned_points"> Earned Points: <input type="text" name="earned_points" id="earned_points" placeholder="<?php echo htmlspecialchars($earned_points); ?>"> </label> <br>



	<input type="submit" value="submit">
</form>

</body>
</html>
