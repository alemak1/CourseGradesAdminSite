<?php

	


function get_students_list(){
	include('connection.php');

	try{

		$query = 'select * from students';
		return $db->query($query);

	}catch(Exception $e){
		echo 'Error' . $e->getMessage() . '</br>';
		return array();
	}
}





function get_grades_list(){
	include('connection.php');

	try{
		$query = 'select grades.*,students.* from grades inner join students on students.student_id = grades.student_id';
		return $db->query($query);

	}catch(Exception $e){
		echo 'Error' . $e->getMessage() . '</br>';
		return array();
	}

}

function get_grades_list2($filter = null){
	include('connection.php');

	try{

		$orderBy = 'order by grades.student_id asc';

		$where = '';

		if(is_array($filter)){
			switch($filter[0]){ 
				case'student':
					$where = 'where grades.student_id = ?';
					break;
				case'level':
					$where = 'where students.level = ?';
					break;
				case'major':
					$where = 'where students.major = ?';
					break;
				case'date':
					$where = 'where grades.date >= ? and grades.date <= ?';
					break;
			}

		}

		if($filter){
			$orderBy = 'order by grades.student_id asc, grades.date desc';
		}

		$query = 'select grades.*,students.* from grades inner join students on students.student_id = grades.student_id ';
		$results =  $db->prepare($query . $where . $orderBy);
		if(is_array($filter)){
			$results->bindValue(1,$filter[1]);
			if($filter[0] == 'date'){
				$results->bindValue(2,$filter[2],PDO::PARAM_STR);
			}
		}	

		$results->execute();

	}catch(Exception $e){
		echo 'Error' . $e->getMessage() . '</br>';
		return array();
	}

	return $results->fetchAll(PDO::FETCH_ASSOC);

}

function get_grade_report($student_id){
		echo '<table>';

		$total_earned_points = 0;
		$total_max_points = 0;

		foreach(get_grades_list() as $grade){
			if($grade['student_id'] = $student_id){

				$total_earned_points += $grade['earned_points'];
				$total_max_points += $grade['max_points'];

				echo '<tr>';
				echo '<td>'. $grade['date'] .'</td>';
				echo '<td>'. $grade['title'] .'</td>';
				echo '<td>'. $grade['description'] .'</td>';
				echo '<td>'. $grade['earned_points'] .'</td>';
				echo '<td>'. $grade['max_points'] .'</td>';
				echo '</tr>';

			}
		}

		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';

		echo "<th class='total-score-label'> Total Earned Points </th>";
		echo "<td>" . $total_earned_points ."</td>";
		echo "<td class='total-max-points-label'> ". $total_max_points . "  </td>";
		echo '</tr>';

		echo '</table>';
	}


function add_grade($student_id, $date, $title, $description, $max_points, $earned_points){
	include('connection.php');

	$sql = 'insert into grades(student_id,date,title,description,max_points,earned_points) values(?,?,?,?,?,?)';

	try{
		$results = $db->prepare($sql);
		$results->bindValue(1,$student_id);
		$results->bindValue(2,$date);
		$results->bindValue(3,$title);
		$results->bindValue(4,$description);
		$results->bindValue(5,$max_points);
		$results->bindValue(6,$earned_points);
		$results->execute();
	}catch(Exception $e){
		echo "Error: " . $e->getMessage() . "<br />";
		return false;
	}

	return true;
}
function update_student($student_id,$first_name,$last_name,$major,$level){
	include('connection.php');

	$sql = 'update students set first_name = ?, last_name = ?, major = ?, level = ? where student_id = ?';
	
	try{
			$results = $db->prepare($sql);
			$result->bindValue(1,$first_name,PDO::PARAM_STR);
			$result->bindValue(2,$last_name,PDO::PARAM_STR);
			$result->bindValue(3,$major,PDO::PARAM_STR);
			$result->bindValue(4,$level,PDO::PARAM_STR);
			$result->bindValue(5,$student_id,PDO::PARAM_INT);
			$results->execute();

	}catch(Exception $e){
		echo "Error: " . $e->getMessage() . "<br />";
		return false;
	}

	return true;
}
function add_student($student_id,$first_name,$last_name,$major,$level,$shouldUpdate){
	include('connection.php');

	if($shouldUpdate){
		$sql = 'update students set first_name = ?, last_name = ?, major = ?, level = ? where student_id = ?';
	}else{
		$sql = 'insert into students(student_id,first_name,last_name,major,level) values(?,?,?,?,?)';
	}

	try{
		$results = $db->prepare($sql);
		if($shouldUpdate){
			$result->bindValue(1,$first_name,PDO::PARAM_STR);
			$result->bindValue(2,$last_name,PDO::PARAM_STR);
			$result->bindValue(3,$major,PDO::PARAM_STR);
			$result->bindValue(4,$level,PDO::PARAM_STR);
			$result->bindValue(5,$student_id,PDO::PARAM_INT);
		}else{
			$results->bindValue(1,$student_id,PDO::PARAM_INT);
			$results->bindValue(2,$first_name,PDO::PARAM_STR);
			$results->bindValue(3,$last_name,PDO::PARAM_STR);
			$results->bindValue(4,$major,PDO::PARAM_STR);
			$results->bindValue(5,$level,PDO::PARAM_STR);
		}

		$results->execute();

	}catch(Exception $e){
		echo "Error: " . $e->getMessage() . "<br />";
		return false;
	}

	return true;
}

function get_student($student_id){
	include('connection.php');

	$sql = 'select * from students where students.student_id = ?';

	try{
		$results = $db->prepare($sql);
		$results->bindValue(1,$student_id);
		$results->execute();

	}catch(Exception $e){
		echo "Error: " . $e->getMessage() . "<br />";
		return false;
	}

	return $results->fetch();
}

function delete_student($student_id){
	include('connection.php');

	$sql = 'delete from students where students.student_id = ?';

	try{
		$results = $db->prepare($sql);
		$results->bindValue(1,$student_id,PDO::PARAM_INT);
		$results->execute();

	}catch(Exception $e){
		echo "Error: " . $e->getMessage() . "<br />";
		return false;
	}

	return true;
}


?>


	<?php 

		foreach(get_grades_list() as $grade){
			if($grade['student_id'] == $student_id){
				echo '<h4> Grades for: '. $grade['first_name'] . ' ' . $grade['last_name'] .'</h4>';
				break;
			}
		}

		?>

	<?php 

	function searchByID($student_id){ 

		foreach(get_grades_list() as $grade){
			if($grade['student_id'] == $student_id){
				echo '<h4 class="grade-title"> Grades for: '. $grade['first_name'] . ' ' . $grade['last_name'] .'</h4>';
				break;
			}
		}

		foreach(get_grades_list() as $grade){  
			if($grade['student_id'] == $student_id){ ?>

				  <li class="list-group-item">
				    <span class="tag tag-default tag-pill float-xs-right"> <?php echo $grade['earned_points'] . '/' . $grade['max_points']; ?></span>
				    <?php echo '<b>'. $grade['title'] . '</b> : ' . $grade['description'] . '(' . $grade['date'] . ')'  ?>
				  </li>
			  
	<?php } } } ?>


	<?php

	function searchByLastName($last_name){ 

		foreach(get_grades_list() as $grade){
			if($grade['last_name'] == $last_name){
				echo '<h4> Grades for: '. $grade['first_name'] . ' ' . $grade['last_name'] .'</h4>';
				break;
			}
		}

		foreach(get_grades_list() as $grade){  
			if($grade['last_name'] == $last_name){ ?>

				  <li class="list-group-item">
				    <span class="tag tag-default tag-pill float-xs-right"> <?php echo $grade['earned_points'] . '/' . $grade['max_points']; ?></span>
				    <?php echo '<b>'. $grade['title'] . '</b> : ' . $grade['description'] . '(' . $grade['date'] . ')'  ?>
				  </li>
			  
	<?php } } } ?>


	<?php

	function searchByMajor($major){ 

		foreach(get_grades_list() as $grade){
			if($grade['major'] == $major){
				echo '<h4> Grades for: '. $grade['first_name'] . ' ' . $grade['last_name'] .'</h4>';
				break;
			}
		}

		foreach(get_grades_list() as $grade){  
			if($grade['major'] == $major){ ?>

				  <li class="list-group-item">
				    <span class="tag tag-default tag-pill float-xs-right"> <?php echo $grade['earned_points'] . '/' . $grade['max_points']; ?></span>
				    <?php echo '<b>'. $grade['title'] . '</b> : ' . $grade['description'] . '(' . $grade['date'] . ')'  ?>
				  </li>
			  
	<?php } } } ?>

	<?php

	function searchByLevel($level){ 

		foreach(get_grades_list() as $grade){
			if($grade['level'] == $level){
				echo '<h4> Grades for: '. $grade['first_name'] . ' ' . $grade['last_name'] .'</h4>';
				break;
			}
		}


		foreach(get_grades_list() as $grade){  
			if($grade['level'] == $level){ ?>

				  <li class="list-group-item">
				    <span class="tag tag-default tag-pill float-xs-right"> <?php echo $grade['earned_points'] . '/' . $grade['max_points']; ?></span>
				    <?php echo '<b>'. $grade['title'] . '</b> : ' . $grade['description'] . '(' . $grade['date'] . ')'  ?>
				  </li>
			  
	<?php } } } ?>



