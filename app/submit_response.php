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

$delete_sql = "DELETE FROM responses WHERE student_id = " . $_SESSION["student_id"];
mysqli_query($mysqli, $delete_sql);

$insert_statement = mysqli_prepare($mysqli, 'INSERT INTO responses(student_id, subject, response) VALUES (?, ?, ?)');
mysqli_stmt_bind_param($insert_statement, "iss", $_SESSION["student_id"], $subject, $response);

foreach ($_POST["choices"] as $key => $value) {
  $subject = preg_replace('/[^0-9A-Za-z\-]/', "0", $key);
  $response = preg_replace('/[^0-9A-Za-z\-]/', "0", $value);

  mysqli_stmt_execute($insert_statement);
}

header("Location: index.php?response=success");
exit();
?>