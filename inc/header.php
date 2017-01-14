



<!DOCTYPE html>
<html>
<head >
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href=css/normalize.css"">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body class="bg-info">


<ul class="nav nav-pills nav-stacked hidden-sm-up text-xs-center bg-warning">
  <li class="nav-item">
    <a class="nav-link <?php if($pageTitle == 'home'){ echo 'active'; } ?>" href="/index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($pageTitle == 'student_list'){ echo 'active'; } ?>" href="/student_list.php">View All Students</a>
  </li>

  <li class="nav-item">
    <a class="nav-link <?php if($pageTitle == 'grade_list'){ echo 'active'; } ?>" href="/grade_list.php">View All Grades</a>
  </li>

  <li class="nav-item">
    <a class="nav-link <?php if($pageTitle == 'search'){ echo 'active'; } ?>" href="/search.php">Search a Student</a>
  </li>

  <li class="nav-item">
    <a class="nav-link <?php if($pageTitle == 'student'){ echo 'active'; } ?>" href="/student.php">Add New Student</a>
  </li>

  <li class="nav-item">
    <a class="nav-link <?php if($pageTitle == 'grade'){ echo 'active'; } ?>" href="/grade.php">Add New Grade</a>
  </li>
</ul>

<nav class="navbar navbar-light bg-warning hidden-sm-down">
  <ul class="nav navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="/index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/student_list.php">See All Students</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/search.php">Search a Student</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/grade_list.php">See All Grades</a>
    </li>
    
     <form class="form-inline float-xs-right">

     <li class="nav-item">
      <a class="nav-link" href="/student.php">Add New Student</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/grade.php">Add New Grade</a>
    </li>

    </form>
    
  </ul>

</nav>