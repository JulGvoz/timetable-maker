<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
if (!isset($_GET["code"])) {
  header("Location: index.php");
  exit();
}

$mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
  exit();
}

$statement = mysqli_prepare($mysqli, 'SELECT accounts.id AS user_id FROM accounts WHERE code = ? AND type = "admin"');
mysqli_stmt_bind_param($statement, "s", $_GET["code"]);
mysqli_stmt_execute($statement);

$result = mysqli_stmt_get_result($statement);
if (mysqli_num_rows($result) == 0) {
  header("Location: index.php");
  exit();
}
$row = mysqli_fetch_assoc($result);

$user_id = $row["user_id"];
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <style>
    .completion-icon {
      height: 32px;
      width: 100%;
      object-fit: contain;
    }
  </style>
  <title>Valdymo Skydas</title>
</head>

<body>
  <div class="jumbotron ">
    <div class="container">
      <h2>Mokinių sąrašas
        <?php
        echo "(" . substr($_GET["code"], 0, 7) . ")";
        ?>
      </h2>
      <table class="table">
        <thead>
          <tr>
            <th style="text-align: center">Pateikta</th>
            <th>Pateikimo laikas</th>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Kodas</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php

          $statement = mysqli_prepare($mysqli, "SELECT first_name, last_name, code, students.id AS student_id FROM students INNER JOIN accounts ON students.code_id = accounts.id WHERE students.school_id = ?");
          mysqli_stmt_bind_param($statement, "i", $user_id);
          mysqli_stmt_execute($statement);

          $result = mysqli_stmt_get_result($statement);
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $count_responses_sql = "SELECT timestamp FROM responses WHERE student_id = " . $row["student_id"];
            $responses_result = mysqli_query($mysqli, $count_responses_sql);
            $response_count = mysqli_num_rows($responses_result);
            if ($response_count > 0) {
              $response_time = mysqli_fetch_assoc($responses_result)["timestamp"];
            }


            echo '<tr>';

            if ($response_count == 0) {
              echo '<td><img src="cancel.svg" class="completion-icon"></td>';
              echo '<td>-</td>';
            } else {
              echo '<td><img src="confirmed.svg" class="completion-icon"></td>';
              echo '<td>' . $response_time . '</td>';
            }

            echo '<td>' . $row["first_name"] . '</td>';
            echo '<td>' . $row["last_name"] . '</td>';
            echo '<td><code>' . $row["code"] . '</code></td>';
            echo '<td><form action="student_choice.php" method="get">
            <input type="hidden" name="code" value="' . $row["code"] . '">
            <input type="hidden" name="admin_code" value="' . $_GET["code"] . '">
            <button type="submit" class="btn btn-warning">Keisti pasirinkimus</button>
            </form>
            </td>';
            echo '<td><form action="remove_student.php" method="post">
            <input type="hidden" name="student_id" value="' . $row["student_id"] . '">
            <input type="submit" name="delete_button" value="Ištrinti mokinį" class="btn btn-danger">
            </form>
            </td>';
            echo '<tr>';
          }
          ?>
        </tbody>
      </table>
      <form method="POST" action="add_student.php">
        <input type="hidden" name="code" value="<?php
                                                echo $_GET["code"];
                                                ?>">
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Pridėti mokinį</span>
            </div>
            <input name="first_name" type="text" class="form-control" placeholder="Vardas" required>
            <input name="last_name" type="text" class="form-control" placeholder="Pavardė" required>
            <div class="input-group-append">
              <button class="btn btn-success" type="submit">Pridėti</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>