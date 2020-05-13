<?php
session_start();
?>
<?php
if (!isset($_SESSION['type'])) {
  header("Location: index.php");
  exit();
} else if ($_SESSION["type"] != "superadmin") {
  header("Location: index.php");
  exit();
}
?>
<?php
if (!isset($_POST['code'])) {
  header("Location: superadmin_panel.php");
  exit();
}
?>
<?php
$mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
  exit();
}

$statement = mysqli_prepare($mysqli, 'INSERT INTO accounts (code, type) VALUES (?, "admin")');
$code = preg_replace("/[^A-Za-z0-9]/", '', $_POST['code']);
mysqli_stmt_bind_param($statement, "s", $code);
mysqli_stmt_execute($statement);

$last_id = mysqli_insert_id($mysqli);

$statement = mysqli_prepare($mysqli, 'INSERT INTO admins (code_id) VALUES (?)');
mysqli_stmt_bind_param($statement, "i", $last_id);
mysqli_stmt_execute($statement);

header("Location: superadmin_panel.php");
exit();
?>