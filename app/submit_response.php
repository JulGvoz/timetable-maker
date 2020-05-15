<?php
session_start();
?>
<?php
if (!isset($_SESSION['type'])) {
  header("Location: index.php");
  exit();
} else if ($_SESSION["type"] != "student") {
  header("Location: index.php");
  exit();
}
?>
<?php
if (count($_POST) == 0) {
  header("Location: student_choice.php");
  exit();
}
?>
<?php

$mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
  exit();
}

$get_student_id_stmt = "SELECT students.id AS id FROM students INNER JOIN accounts ON accounts.id = students.code_id WHERE code_id = " . $_SESSION["user_id"];
$get_student_id_result = mysqli_query($mysqli, $get_student_id_stmt);



$check_statement = mysqli_prepare($mysqli, 'SELECT COUNT(*) AS response_count FROM responses INNER JOIN students ON student_id = students.id WHERE students.code_id = ? AND responses.subject = ?');
mysqli_stmt_bind_param($check_statement, "s", $response_subject);

$insert_statement = mysqli_prepare($mysqli, 'INSERT INTO responses(student_id, subject, response) VALUES (?, ?, ?)');


print_r($_POST);

//header("Location: index.php");
//exit();
?>