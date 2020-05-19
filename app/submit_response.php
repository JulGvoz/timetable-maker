<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_POST["choices"]) || !isset($_POST["code"])) {
  header("Location: index.php");
  exit();
}
?>
<?php



$mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
  exit();
}

$statement = mysqli_prepare($mysqli, 'SELECT students.id AS student_id FROM students INNER JOIN accounts ON code_id = accounts.id WHERE code = ?');
mysqli_stmt_bind_param($statement, "s", $_POST["code"]);
mysqli_stmt_execute($statement);

$result = mysqli_stmt_get_result($statement);
if (mysqli_num_rows($result) == 0) {
  header("Location: index.php");
  exit();
}
$student_id = mysqli_fetch_assoc($result)["student_id"];


$delete_sql = "DELETE FROM responses WHERE student_id = " . $student_id;

$insert_statement = mysqli_prepare($mysqli, 'INSERT INTO responses(student_id, subject, response) VALUES (?, ?, ?)');
mysqli_stmt_bind_param($insert_statement, "iss", $student_id, $subject, $response);

foreach ($_POST["choices"] as $key => $value) {
  $subject = preg_replace('/[^0-9A-Za-z\-]/', "0", $key);
  $response = preg_replace('/[^0-9A-Za-z\-]/', "0", $value);

  

  mysqli_stmt_execute($insert_statement);
}

if (isset($_POST["admin_code"])) {
  header("Location: admin_panel.php?code=" . $_POST["admin_code"]);
  exit();
}

header("Location: index.php?response=success");
exit();
?>