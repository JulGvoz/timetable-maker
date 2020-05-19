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

$statement = mysqli_prepare($mysqli, 'SELECT accounts.id AS user_id FROM accounts WHERE code = ? AND type = "superadmin"');
mysqli_stmt_bind_param($statement, "s", $_POST["code"]);
mysqli_stmt_execute($statement);

$result = mysqli_stmt_get_result($statement);
if (mysqli_num_rows($result) == 0) {
  header("Location: index.php");
  exit();
}
$row = mysqli_fetch_assoc($result);
?>
<?php
if (!isset($_POST['groupname'])) {
  header("Location: superadmin_panel.php?code=" . $_POST["code"]);
  exit();
}
?>
<?php

$statement = mysqli_prepare($mysqli, 'INSERT INTO accounts (code, type) VALUES (?, "admin")');

$keywords = preg_split("/[\s,]+/", ucwords($_POST['groupname']));

$code = "";
$i = 5;
foreach ($keywords as $key => $value) {
  $code = $code . substr($value, 0, max($i, 0));
  $i--;
}

$code = $code .  random_int(100000000, 999999999);

mysqli_stmt_bind_param($statement, "s", $code);
mysqli_stmt_execute($statement);



$last_id = mysqli_insert_id($mysqli);

$statement = mysqli_prepare($mysqli, 'INSERT INTO admins (code_id, groupname) VALUES (?, ?)');
mysqli_stmt_bind_param($statement, "is", $last_id, $_POST["groupname"]);
mysqli_stmt_execute($statement);

header("Location: superadmin_panel.php?code=" . $_POST["code"]);
exit();
?>