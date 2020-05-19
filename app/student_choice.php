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

$statement = mysqli_prepare($mysqli, 'SELECT * FROM accounts WHERE code = ? AND type = "student"');
mysqli_stmt_bind_param($statement, "s", $_GET["code"]);
mysqli_stmt_execute($statement);

$result = mysqli_stmt_get_result($statement);
if (mysqli_num_rows($result) == 0) {
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
    @media (min-width: 768px) {
      #sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
      }
    }
  </style>
  <title>Tvarkaraščio sudarymas</title>
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-info navbar-light fixed-top">
    <h2>Viso valandų: <span id="total-hour-count">25</span> <small class="text-light">(Turi būti nuo 28 ligi 35)</small></h2>
  </nav>
  <div class="container-fluid h-100">
    <div class="jumbotron" style="background-color:rgb(255, 225, 255)">
      <h1>Mokinio tvarkaraščio sudarymas</h1>
      <p>Užrašai kaip <code>3/4 valandos</code> reiškia, kad 3-ioje klasėje bus 3 valandos per savaitę, o 4-oje klasėje bus 4 valandos per savaitę.</p>
      <h2>Dorinis ugdymas <small class="text-muted">(1 valanda per savaitę)</small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="dorinis-etika-1" autocomplete="off" checked> Etika
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="dorinis-tikyba-1" autocomplete="off"> Tikyba
        </label>
      </div>

      <h2>Lietuvių kalba ir literatūra <small class="text-muted">(4 arba 6 valandos per savaitę)</small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="lietuviu-4" autocomplete="off" checked>4 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="lietuviu-6" autocomplete="off">6 valandos
        </label>
      </div>

      <h2>Matematika <small class="text-muted">(3/4 arba 6 valandos per savaitę)</small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="matematika-4" autocomplete="off" checked>3/4 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="matematika-6" autocomplete="off">6 valandos
        </label>
      </div>

      <h2>Pirma kalba <small class="text-muted">3 arba 5 valandos per savaitę</small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="pirmaval-3" autocomplete="off" checked>3 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="pirmaval-5" autocomplete="off">5 valandos
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="pirmakalba-anglu" autocomplete="off" checked>Anglų kalba
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="pirmakalba-vokieciu" autocomplete="off">Vokiečių kalba
        </label>
      </div>

      <h2>Antra kalba <small class="text-muted">3 valandos per savaitę</small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="antra-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="antra-anglu-3" autocomplete="off">Anglų kalba
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="antra-vokieciu-3" autocomplete="off">Vokiečių kalba
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="antra-prancuzu-3" autocomplete="off">Prancūzų kalba
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="antra-rusu-3" autocomplete="off">Rusų kalba
        </label>
      </div>

      <h2>Trečia kalba <small class="text-muted">2 valandos per savaitę</small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="trecia-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="trecia-ispanu-2" autocomplete="off">Ispanų kalba
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="trecia-vokieciu-2" autocomplete="off">Vokiečių kalba
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="trecia-rusu-2" autocomplete="off">Rusų kalba
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="trecia-prancuzu-2" autocomplete="off">Prancūzų kalba
        </label>
      </div>

      <h2>Socialiniai mokslai <small class="text-muted">Reikia pasirinkti bent vieną</small></h2>
      <h3>Istorija <small class="text-muted">2 arba 4 valandos per savaitę</small></h3>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="istorija-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="istorija-2" autocomplete="off">2 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="istorija-4" autocomplete="off">4 valandos
        </label>
      </div>
      <h3>Geografija <small class="text-muted">2 arba 3 valandos per savaitę</small></h3>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="geo-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="geo-2" autocomplete="off">2 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="geo-3" autocomplete="off">3 valandos
        </label>
      </div>


      <h2>Gamtos mokslai <small class="text-muted">Reikia pasirinkti bent vieną</small></h2>
      <h3>Biologija <small class="text-muted">2 arba 4 valandos per savaitę</small></h3>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="bio-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="bio-2" autocomplete="off">2 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="bio-4" autocomplete="off">4 valandos
        </label>
      </div>
      <h3>Fizika <small class="text-muted">2 arba 4 valandos per savaitę</small></h3>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="fiz-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="fiz-2" autocomplete="off">2 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="fiz-4" autocomplete="off">4 valandos
        </label>
      </div>
      <h3>Chemija <small class="text-muted">2 arba 3 valandos per savaitę</small></h3>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="che-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="che-2" autocomplete="off">2 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="che-3" autocomplete="off">3 valandos
        </label>
      </div>

      <h2>Sporto šaka <small class="text-muted"></small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="sportas-fizinis-2" autocomplete="off" checked>Fizinis ugdymas <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="sportas-fizinis-4" autocomplete="off">Fizinis ugdymas <small class="">4 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="sportas-sportinissokis-2" autocomplete="off">Sportinis šokis <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="sportas-krepsinis-2" autocomplete="off">Krepšinis <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="sportas-tinklinis-2" autocomplete="off">Tinklinis <small class="">2 valandos</small>
        </label>
      </div>

      <h2>Informacinės technologijos <small class="text-muted"></small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="it-program-3" autocomplete="off" checked>Programavimas <small class="">3/2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="it-program-2" autocomplete="off">Programavimas <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="it-leidyba-3" autocomplete="off">Elektroninė leidyba <small class="">3 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="it-duomenu-2" autocomplete="off">Duomenų bazės <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="it-informatika-1" autocomplete="off">Informatika <small class="">1 valanda</small>
        </label>
      </div>

      <h2>Papildomi dalykai <small class="text-muted">Kiekvienas po 1 valandą per savaitę</small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="psicho-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="psicho-1" autocomplete="off">Psichologija
        </label>
      </div>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="braiz-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="braiz-1" autocomplete="off">Braižyba
        </label>
      </div>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="lotynu-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="lotynu-1" autocomplete="off">Lotynų kalba
        </label>
      </div>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="ekonomika-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="ekonomika-1" autocomplete="off">Ekonomika ir verslumas
        </label>
      </div>

      <h2>Menai ir technologijos <small class="text-muted">Pasirinkti bent vieną</small></h2>
      <h3>Menai <small class="text-muted">Galima rinktis du menus</small></h3>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="daile-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="daile-2" autocomplete="off">Dailė <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="daile-3" autocomplete="off">Dailė <small class="">3 valandos</small>
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="grafinis-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="grafinis-2" autocomplete="off">Grafinis dizainas <small class="">2 valandos</small>
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="muzika-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="muzika-2" autocomplete="off">Muzika <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="muzika-3" autocomplete="off">Muzika <small class="">3 valandos</small>
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="teatras-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="teatras-2" autocomplete="off">Teatras <small class="">2 valandos</small>
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="filmai-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="filmai-2" autocomplete="off">Filmų kūrimas <small class="">2 valandos</small>
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="foto-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="foto-2" autocomplete="off">Fotografija <small class="">2 valandos</small>
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="sokis-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="sokis-2" autocomplete="off">Šokis <small class="">2 valandos</small>
        </label>
      </div>
      <h3>Technologijos <small class="text-muted">Rinktis daugiausia vieną</small></h3>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="tekstile-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="tekstile-2" autocomplete="off">Tekstilė ir apranga <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="tekstile-3" autocomplete="off">Tekstilė ir apranga <small class="">3 valandos</small>
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="mityba-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="mityba-2" autocomplete="off">Turizmas ir mityba <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="mityba-3" autocomplete="off">Turizmas ir mityba <small class="">3 valandos</small>
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="medzio-none" autocomplete="off" checked>Nesirinkti
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="medzio-2" autocomplete="off">Statyba ir medžio apdirbimas <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="medzio-3" autocomplete="off">Statyba ir medžio apdirbimas <small class="">3 valandos</small>
        </label>
      </div>
      <p></p>
      <h2>Reikalavimai</h2>
      <div id="require-hours" class="alert alert-danger" role="alert">
        Tinkamas valandų skaičius (turi būti nuo 28 valandų iki 35 valandų per savaitę)
      </div>
      <div id="require-social" class="alert alert-danger" role="alert">
        Pasirinktas bent vienas socialinis mokslas
      </div>
      <div id="require-science" class="alert alert-danger" role="alert">
        Pasirinktas bent vienas gamtos mokslas
      </div>
      <div id="require-arts" class="alert alert-danger" role="alert">
        Pasinktas bent vienas meno ar technologijos dalykas
      </div>
      <div id="require-languages" class="alert alert-danger" role="alert">
        Nesikartoja pirma/antra/trečia užsienio kalbos
      </div>
      <div id="require-art-limits" class="alert alert-danger" role="alert">
        Pasirinkta daugiausia du menų dalykai, arba daugiausia vienas meno ir vienas technologijų dalykas
      </div>
      <form action="submit_response.php" method="POST">
        <div id="submit-div" class="form-group">
          <input class="btn btn-success" type="submit" id="submit-button" value="Pateikti" disabled>
        </div>
        <input type="hidden" name="code" value="<?php
                                                echo $_GET["code"];
                                                ?>">
        <?php
        if (isset($_GET["admin_code"])) {
          echo '<input type="hidden" name="admin_code" value="' . $_GET["admin_code"] . '">';
        }
        ?>
      </form>
    </div>
  </div>
  <script>
    var selections = {};
    for (var i = 0; i < $(".active").length; i++) {
      selections[$(".active")[i].control.id.split("-")[0]] = $(".active")[i].control.id;
      $("#submit-div").append(' \
      <input id="hidden-input-' + $(".active")[i].control.id.split("-")[0] + '" type="hidden" name="choices[' + $(".active")[i].control.id.split("-")[0] + ']" value=' + $(".active")[i].control.id + '>\
      ');
    }
    var total_hours = 0;

    function calculate_hours() {
      total_hours = 0
      for (var prop in selections) {
        if (selections.hasOwnProperty(prop)) {
          total_hours += +selections[prop].replace(/[^0-9]/g, "");
        }
      }
      $("#total-hour-count").text(total_hours);
    }

    function shared_property_hours(arr) {
      var hour_value = 0;
      for (var prop in arr) {
        if (selections.hasOwnProperty(arr[prop])) {
          hour_value += +selections[arr[prop]].replace(/[^0-9]/g, "");
        }
      }
      return hour_value;
    }

    function tgl(id, bl) {
      if (bl) {
        $(id).removeClass("alert-danger");
        $(id).addClass("alert-success");
      } else {
        $(id).removeClass("alert-success");
        $(id).addClass("alert-danger");
      }
    }

    function validate_hours() {
      calculate_hours();
      tgl("#require-hours", total_hours >= 28 && total_hours <= 35);

    }

    function validate_socials() {
      tgl("#require-social", shared_property_hours(["istorija", "geo"]) > 0);
    }

    function validate_sciences() {
      tgl("#require-science", shared_property_hours(["bio", "fiz", "che"]) > 0);
    }

    function validate_arts() {
      tgl("#require-arts", shared_property_hours(["daile", "grafinis", "muzika", "teatras", "filmai", "foto", "sokis", "tekstile", "mityba", "medzio"]) > 0);
    }

    function validate_languages() {
      var first = selections["pirmakalba"].split("-");
      var second = selections["antra"].split("-");
      var third = selections["trecia"].split("-");

      var language_selections = [];
      for (var i = 0; i < first.length; i++) {
        language_selections[first[i]] = (language_selections[first[i]] || 0) + 1;
      }
      for (var i = 0; i < second.length; i++) {
        language_selections[second[i]] = (language_selections[second[i]] || 0) + 1;
      }
      for (var i = 0; i < third.length; i++) {
        language_selections[third[i]] = (language_selections[third[i]] || 0) + 1;
      }

      var assert_correct = true;
      var languages = ["anglu", "rusu", "vokieciu", "prancuzu", "ispanu"]
      for (var i = 0; i < languages.length; i++) {
        if ((language_selections[languages[i]] || 0) > 1) {
          assert_correct = false;
        }
      }
      tgl("#require-languages", assert_correct);
    }

    function validate_arts_technology() {
      var arts = ["daile", "grafinis", "muzika", "teatras", "filmai", "foto", "sokis"];
      var tech = ["tekstile", "mityba", "medzio"];

      var arts_selected = arts.length;
      var tech_selected = tech.length;

      for (var i = 0; i < arts.length; i++) {
        if (selections[arts[i]].split("-").includes("none")) {
          arts_selected--;
        }
      }
      for (var i = 0; i < tech.length; i++) {
        if (selections[tech[i]].split("-").includes("none")) {
          tech_selected--;
        }
      }
      tgl("#require-art-limits", (arts_selected <= 2 && tech_selected == 0) || (arts_selected <= 1 && tech_selected <= 1));
    }

    validate_hours();

    $('input[type="radio"').on('change', function(obj) {
      selections[obj.target.id.split("-")[0]] = obj.target.id;
      $('#hidden-input-' + obj.target.id.split("-")[0]).val(obj.target.id);
      console.log($('#hidden-input-' + obj.target.id.split("-")[0]));
      validate_hours();
      validate_socials();
      validate_sciences();
      validate_arts();
      validate_languages();
      validate_arts_technology();
      if ($(".alert-danger").length == 0) {
        $("#submit-button").removeAttr("disabled");
      } else {
        $("#submit-button").attr("disabled", true);
      }
    });
  </script>
</body>

</html>