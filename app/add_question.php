<?php
session_start();
?>
<?php
if (!isset($_SESSION['type'])) {
  header("Location: index.php");
  exit();
} else if ($_SESSION["type"] != "admin") {
  header("Location: index.php");
  exit();
}
?>
<?php
if (!isset($_POST['question-description']) || !isset($_POST['question-type'])) {
  header("Location: admin_panel.php");
  exit();
} else if (!in_array($_POST["question-type"], ["multiple", "single", "text", "number"], true)) {
  header("Location: admin_panel.php");
  exit();
}
?>
<?php

$mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
  exit();
}

$statement = mysqli_prepare($mysqli, 'INSERT INTO questions (description, type, school_id) VALUES (?, ?, ?)');
$description = $_POST["question-description"];
$description = html_entity_decode($description);
$type = $_POST['question-type'];
$school_id = $_SESSION["user_id"];

echo $description . $type . $school_id;

mysqli_stmt_bind_param($statement, "ssi", $description, $type, $school_id);
mysqli_stmt_execute($statement);

header("Location: admin_panel.php");
exit();
?>