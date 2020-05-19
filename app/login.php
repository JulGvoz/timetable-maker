<?php
session_start();
?>
<?php
if (!isset($_POST['code'])) {
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

$statement = mysqli_prepare($mysqli, "SELECT * FROM accounts WHERE code = ?");
mysqli_stmt_bind_param($statement, "s", $_POST['code']);
mysqli_stmt_execute($statement);

$result = mysqli_stmt_get_result($statement);

if ($result) {
  if (mysqli_num_rows($result) == 0) {
    header("Location: index.php?response=badcode");
    exit();
  } else {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($row["type"] == "superadmin") {
      header("Location: superadmin_panel.php?code=" . $row["code"]);
      exit();
    } else if ($row["type"] == "admin") {
      header("Location: admin_panel.php?code=" . $row["code"]);
      exit();
    } else {

      header("Location: student_choice.php?code=" . $row["code"]);
      exit();
    }
  }
}
?>
