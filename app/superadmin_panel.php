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
  <title>Superadmin Panel</title>
</head>

<body>
  <div class="jumbotron ">
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>account_id</th>
            <th>admin_id</th>
            <th>code</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $mysqli = mysqli_connect("localhost", "admin", "Bind-Defeat-Journey-Interest-Sound-Stair-Insurance-Hinder-Influence-Sensitive-4", "users");
          if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
            exit();
          }

          $sql = 'SELECT code , admins.id AS admin_id, accounts.id AS account_id FROM admins INNER JOIN accounts ON admins.code_id = accounts.id WHERE accounts.type = "admin"';
          $result = mysqli_query($mysqli, $sql);

          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row["account_id"] . '</td>';
            echo '<td>' . $row["admin_id"] . '</td>';
            echo '<td><code>' . $row["code"] . '</code></td>';
            echo '<td><form action="remove_admin.php" method="post">
            <input type="hidden" name="admin_id" value="' . $row["admin_id"] . '">
            <input type="submit" name="delete_button" value="Delete" class="btn btn-danger">
            </form>
            </td>';
            echo '<tr>';
          }
          ?>
        </tbody>
      </table>
      <form method="POST" action="add_admin.php">
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Add an Admin</span>
            </div>
            <input name="code" type="text" class="form-control" placeholder="Code" required>
            <div class="input-group-append">
              <button class="btn btn-success" type="submit">Add</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>

</html>