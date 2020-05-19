<?php
if (!isset($_POST["code"])) {
  header("Location: index.php");
  exit();
}

$mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
  exit();
}

$statement = mysqli_prepare($mysqli, 'SELECT accounts.id AS user_id FROM accounts WHERE code = ? AND type = "admin"');
mysqli_stmt_bind_param($statement, "s", $_POST["code"]);
mysqli_stmt_execute($statement);

$result = mysqli_stmt_get_result($statement);
if (mysqli_num_rows($result) == 0) {
  header("Location: index.php");
  exit();
}
$row = mysqli_fetch_assoc($result);

$user_id = $row["user_id"];

if (!isset($_POST['first_name']) || !isset($_POST['last_name'])) {
  header("Location: admin_panel.php?code=" . $_POST["code"] . "&superadmin_code" = $_POST["superadmin_code"]);
  exit();
}
?>
<?php

$mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
  exit();
}

$statement = mysqli_prepare($mysqli, 'INSERT INTO accounts (code, type) VALUES (?, "student")');
$first_name = preg_replace("/[^A-Za-z]/", '', $_POST["first_name"]);
$last_name = preg_replace("/[^A-Za-z]/", '', $_POST["last_name"]);
$code = substr($first_name, 0, 3) . substr($last_name, 0, 4) . random_int(100000000, 999999999);
mysqli_stmt_bind_param($statement, "s", $code);
mysqli_stmt_execute($statement);

$last_id = mysqli_insert_id($mysqli);

$statement = mysqli_prepare($mysqli, 'INSERT INTO students (code_id, first_name, last_name, school_id) VALUES (?, ?, ?, ?)');
mysqli_stmt_bind_param($statement, "issi", $last_id, $_POST['first_name'], $_POST['last_name'], $_SESSION["user_id"]);
mysqli_stmt_execute($statement);

header("Location: admin_panel.php");
exit();
?>