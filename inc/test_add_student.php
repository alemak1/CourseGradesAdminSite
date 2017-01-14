<?php

include('connection.php');
include('functions.php');

?>


<?php

var_dump($_SERVER['REQUEST_METHOD']);

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$student_id = trim(filter_input(INPUT_POST,'student_id',FILTER_SANITIZE_NUMBER_INT));
	$first_name = trim(filter_input(INPUT_POST,'first_name',FILTER_SANITIZE_STRING));
	$last_name = trim(filter_input(INPUT_POST,'last_name',FILTER_SANITIZE_STRING));
	$major = trim(filter_input(INPUT_POST,'major',FILTER_SANITIZE_STRING));
	$level = trim(filter_input(INPUT_POST,'level',FILTER_SANITIZE_STRING));

	var_dump($student_id);
	var_dump($first_name);
	var_dump($last_name);
	var_dump($major);
	var_dump($level);


	if(empty($student_id) || empty($first_name) || empty($last_name) || empty($major) || empty($level)){
		$error_message = "Please enter a value for: Student ID, First Name, Last Name, Major, and Level";
	}else{
		if(add_student($student_id,$first_name,$last_name,$major,$level)){
			echo '<h4> Student Added! </h4>';
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
	<label for="student_id"> Student ID: <input type="text" name="student_id" id="student_id" placeholder="<?php 
		echo htmlspecialchars($student_id);
	?>"> </label> <br>
	<label for="first_name"> First Name: <input type="text" name="first_name" id="first_name" placeholder="<?php echo htmlspecialchars($first_name); ?>"> </label> <br>
	<label for="last_name"> Last Name: <input type="text" name="last_name" id="last_name" placeholder="<?php echo htmlspecialchars($last_name); ?>"> </label> <br>
	<label for="major"> Major: <input type="text" name="major" id="major" placeholder="<?php echo htmlspecialchars($major); ?>"> </label> <br>

	<label for="level"></label>
	<select name="level" id="level" >
		<option value="freshman"> Freshman </option>
		<option value="sophomore"> Sophomore</option>
		<option value="junior"> Junior </option>
		<option value="senior"> Senior</option>
	</select>

	<input type="submit" value="submit">
</form>

</body>
</html>
