<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
  </style>
  <title>Valdymo Skydas</title>
</head>

<body>
  <div class="jumbotron ">
    <div class="container">
      <h2>Mokinių sąrašas
        <?php
        echo "(" . substr($_SESSION["code"], 0, 7) . ")";
        ?>
      </h2>
      <table class="table">
        <thead>
          <tr>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Kodas</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
          if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
            exit();
          }

          $statement = mysqli_prepare($mysqli, "SELECT first_name, last_name, code, students.id AS student_id FROM students INNER JOIN accounts ON students.code_id = accounts.id WHERE students.school_id = ?");
          mysqli_stmt_bind_param($statement, "i", $_SESSION['user_id']);
          mysqli_stmt_execute($statement);

          $result = mysqli_stmt_get_result($statement);
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row["first_name"] . '</td>';
            echo '<td>' . $row["last_name"] . '</td>';
            echo '<td><code>' . $row["code"] . '</code></td>';
            echo '<td><form action="remove_student.php" method="post">
            <input type="hidden" name="student_id" value="' . $row["student_id"] . '">
            <input type="submit" name="delete_button" value="Ištrinti" class="btn btn-danger">
            </form>
            </td>';
            echo '<tr>';
          }
          ?>
        </tbody>
      </table>
      <form method="POST" action="add_student.php">
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
    <div class="container">
      <?php
      $statement = mysqli_prepare($mysqli, "SELECT type, description, questions.id AS question_id FROM questions INNER JOIN admins ON questions.school_id = admins.code_id WHERE admins.code_id = ?");
      mysqli_stmt_bind_param($statement, "i", $_SESSION['user_id']);
      mysqli_stmt_execute($statement);

      $result = mysqli_stmt_get_result($statement);

      $statement2 = mysqli_prepare($mysqli, "SELECT question_choices.description AS choice_description, question_choices.id AS choice_id FROM question_choices INNER JOIN questions ON question_choices.question_id = questions.id WHERE questions.id = ?");
      mysqli_stmt_bind_param($statement2, "i", $question_id);

      while ($question = mysqli_fetch_assoc($result)) {
        echo '<div class="form-group">';
        echo '<h3>' . $question["description"] . '</h3>';
        if ($question["type"] == "text") {
          echo '<textarea class="form-control" rows="3" disabled placeholder="Įveskite tekstą"></textarea>';
        } else if ($question["type"] == "number") {
          echo '<input type="number" class="form-control" placeholder="Įveskite skaičių" disabled>';
        } else {
          $question_id = $question["question_id"];
          $result_choices = mysqli_stmt_get_result($statement2);

          if ($result_choices) {
            while ($question_choice = mysqli_fetch_assoc($result_choices)) {
              if ($question["type"] == "multiple") {
                echo '<div class="checkbox">';
                echo '<label><input type="checkbox" name="checkbox_choice' . $question_id . '" checked>' . $question_choice["choice_description"] . '</label>';
                echo '</div>';
              } else {
                echo '<div class="radio">';
                echo '<label><input type="radio" name="radio_choice' . $question_id . '" checked>' . $question_choice["choice_description"] . '</label>';
                echo '</div>';
              }
            }
          }
        }
        echo '</div>';
      }
      ?>
    </div>
    <div class="container">
      <h2>Pridėti pasirinkimą</h2>
      <form method="POST" action="add_question.php">
        <div class="form-group">
          <div class="input-group mb-3">
            <input name="question-description" type="text" class="form-control" placeholder="Aprašymas" required>
            <select name="question-type" class="form-control" data-role="select-dropdown" data-profile="minimal" required>
              <option class="form-control" value="multiple">Pasirinkti keletą iš sąrašo</option>
              <option class="form-control" value="single">Pasirinkti vieną iš sąrašo</option>
              <option class="form-control" value="text">Įrašyti tekstą</option>
              <option class="form-control" value="number">Įrašyti skaičių</option>
            </select>
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