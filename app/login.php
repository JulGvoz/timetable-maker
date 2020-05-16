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
    $_SESSION["code"] = $row["code"];
    $_SESSION["type"] = $row["type"];
    $_SESSION["user_id"] = $row["id"];
    if ($row["type"] == "superadmin") {
      header("Location: superadmin_panel.php");
      exit();
    } else if ($row["type"] == "admin") {
      header("Location: admin_panel.php");
      exit();
    } else {
      $sql = "SELECT students.id AS student_id FROM accounts INNER JOIN students ON students.code_id = accounts.id WHERE accounts.id = " . $_SESSION["user_id"];
      $result = mysqli_query($mysqli, $sql);

      $row = mysqli_fetch_assoc($result);
      $_SESSION["student_id"] = $row["student_id"];

      header("Location: student_choice.php");
      exit();
    }
  }
}
?>
