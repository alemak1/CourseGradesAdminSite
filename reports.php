<?php

include('inc/header.php');
include('css/main.css');
include('inc/functions.php');

	/**
	if(isset($_GET['student_id']) && !empty('student_id')){
		$student_id = $_GET['student_id'];		
	}

	$filter = 'all';
	**/

if(!empty($_GET['filter'])){
	$filter = explode(":",filter_input(INPUT_GET,'filter',FILTER_SANITIZE_STRING));
}


?>



	<form action="reports.php" method="get">

	 	<div class="offset-xs-3 col-xs-6">
			<label for="filter"></label>
			<select name="filter" id="filter">
				<optgroup label="Student">
					<option value="">Select One</option>
					<?php
						foreach(get_students_list() as $student){
							echo "<option value='student:". $student['student_id']  ."' >";
							echo $student['first_name'] . ' ' . $student['last_name'] . '('.$student['student_id'] .')';
							echo "</option>";
						}

					?>
				</optgroup>
				<optgroup label="Date">
					<option value="date:<?php 
						echo date('m/d/Y',strtotime('-2 Sunday'));
						echo ":"; 
						echo date('m/d/Y',strtotime('-1 Saturday'));
					?>">
					Last Week
					</option>

					<option value="date:<?php 
						echo date('m/d/Y',strtotime('-1 Sunday'));
						echo ":"; 
						echo date('m/d/Y');
					?>">
					This Week
					</option>

					<option value="date:<?php 
						echo date('m/d/Y',strtotime('first day of last month'));
						echo ":"; 
						echo date('m/d/Y',strtotime('last day of last month'));
					?>"> Last Month
					</option>

					<option value="date:<?php 
						echo date('m/d/Y',strtotime('first day of this month'));
						echo ":"; 
						echo date('m/d/Y');
					?>"> This Month
					</option>
					
				</optgroup>

				<optgroup label="Level">
					<option value="level:Freshman">Freshman</option>
					<option value="level:Sophomore">Sophomore</option>
					<option value="level:Sophomore">Junior</option>
					<option value="level:Sophomore">Seniore</option>
				</optgroup>
			</select>
<!-- 
			<div class="input-group">
				<span class="input-group-btn">		      
				<button class="btn btn-secondary" type="submit">Search by Student ID</button>	
				</span>
		 		<input type="text" class="form-control" placeholder="Enter Student ID..." name="student_id">
			</div> -->

			<button class="btn btn-primary" type="submit" value="Search">Search</button>
		</div>

	</form>

	<style>
		#report-title{
			margin-top: 2em;
			text-align: center;
		}

	</style>

	<h1 id="report-title">Report on 
		<?php 
			if(!is_array($filter)){
				echo "All Grades by Student ID";
			}else{
				echo ucwords($filter[0]) . " : ";
				switch($filter[0]){
					case 'student':
						$student = get_student($filter[1]);
						echo $student['first_name'] . ' ' . ['last_name'];

					case 'level':
						echo $filter[1];
						break;
					case 'date':
						echo $filter[1] . ' - ' . $filter[2];
						break;
					case 'major':
						break;
				}
			}

		?>
		
	</h1>



<div class="wrapper">
	

	<?php


		
		echo '<table>';

		$all_student_earned_total = $all_student_max_total = $student_earned_total = $student_max_total = $student_id = 0;
		$grades = get_grades_list2($filter);
		
		foreach($grades as $grade){
			
			if($student_id != $grade['student_id']){
				$student_id = $grade['student_id'];
				echo '<thead>';
				echo '<tr>';
				echo '<th> ' . $grade['first_name'] . ' ' . $grade['last_name'] .'</th>';
				echo '<th> Date </th>';
				echo '<th> Earned Points </th>';
				echo '<th> Max Points<th>';
				echo '</tr>';
				echo '</thead>';
			}
			


			
			
				$student_earned_total += $grade['earned_points'];
				$student_max_total += $grade['max_points'];

				$all_student_earned_total += $grade['earned_points'];
				$all_student_max_total += $grade['max_points'];


				echo "<tr>";
				echo "<td> ". $grade['title'] . ':' . $grade['description'] . "</td>";
				echo "<td>" . $grade['date'] ."</td>";
				echo "<td>" . $grade['earned_points'] ."</td>";
				echo "<td>" . $grade['max_points'] ."</td>";
				echo "</tr>";
				
				
				if(next($grades)['student_id'] != $student_id){
				
					echo "<tr><td></td><td></td>";
					echo "<td> Total Points: </td>";
					echo "<td> $student_earned_total / $student_max_total </td>";
					echo "</tr>";

					$student_earned_total = 0;
					$student_max_total = 0;
				

				}
				
				
			}
			
			echo '</table>';
			

	?>


	<?php

		/**

		if(isset($student_id)){
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


		**/
	?>
	
</div>





<?php

include('inc/footer.php');

?>