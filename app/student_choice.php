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
} else if ($_SESSION["type"] != "student") {
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
    <h2>Viso valandų: 25 <small class="text-light">(Turi būti nuo 28 ligi 35)</small></h2>
  </nav>
  <div class="container-fluid h-100">
    <div class="jumbotron">
      <h1>Mokinio tvarkaraščio sudarymas</h1>
      <h2>Dorinis ugdymas <small class="text-muted">(1 valanda per savaitę)</small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="etika-1" autocomplete="off" checked> Etika
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="tikyba-1" autocomplete="off"> Tikyba
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
          <input type="radio" name="options" id="pirma-3" autocomplete="off" checked>3 valandos
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="pirma-5" autocomplete="off">5 valandos
        </label>
      </div>
      <p></p>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="pirma-anglu" autocomplete="off" checked>Anglų kalba
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="pirma-vokieciu" autocomplete="off">Vokiečių kalba
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
          <input type="radio" name="options" id="antra-prancuzu-3" autocomplete="off">Rusų kalba
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
          <input type="radio" name="options" id="fizinis-2" autocomplete="off" checked>Fizinis ugdymas <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="fizinis-4" autocomplete="off">Fizinis ugdymas <small class="">4 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="sportinissokis-2" autocomplete="off">Sportinis šokis <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="krepsinis-2" autocomplete="off">Krepšinis <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="tinklinis-2" autocomplete="off">Tinklinis <small class="">2 valandos</small>
        </label>
      </div>

      <h2>Informacinės technologijos <small class="text-muted"></small></h2>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="program-3" autocomplete="off" checked>Programavimas <small class="">3/2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="program-2" autocomplete="off">Programavimas <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="leidyba-3" autocomplete="off">Elektroninė leidyba <small class="">3 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="duomenu-2" autocomplete="off">Duomenų bazės <small class="">2 valandos</small>
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="options" id="informatika-1" autocomplete="off">Informatika <small class="">1 valanda</small>
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
    
    </div>
  </div>
</body>

</html>