<?php
session_start();
include_once("baza.php");
$v = otvoriVezu();

if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {

} else {
    header("Location: login.php");
}

$q2 = "SELECT * FROM korisnik WHERE korisnik.tip_id = 1";
$user_types_r = izvrsiUpit($v, $q2);
$message = '';

if (isset($_POST["edit-trip"])) {
    $odrediste = $_POST["destination"];
    $opis = $_POST["description"];
    $datum = $_POST["date"];
    $mjesta = $_POST["places"];
    $slika = $_POST["img"];
    $video = $_POST["video"];

    $datum_pocetka = date('Y-m-d H:i:s', strtotime($datum));

    $greska = false;

    if (!isset($odrediste) || empty($odrediste)) {
            $greska = true;
        }
    if (!isset($opis) || empty($opis)) {
            $greska = true;
        }
    if (!isset($datum) || empty($datum)) {
            $greska = true;
        }
    if (!isset($mjesta) || empty($mjesta)) {
            $greska = true;
        }
    if (!isset($slika) || empty($slika)) {
            $greska = true;
        }

    if (!$greska) {
        $message = "Kreirali ste izlet.";
        $q3 = "INSERT INTO izlet 
        (odrediste,datum_vrijeme_polaska,opis,ukupan_broj_mjesta,slika,video,organiziran) 
        VALUES ('" . $odrediste . "',
        '" . $datum_pocetka . "',
        '" . $opis . "',
        '" . $mjesta . "',
        '" . $slika . "',
        '" . $video . "',
        '" . 0 . "');";

izvrsiUpit($v, $q3);
    } else {
        $message = "Greška kod kreiranja izleta.";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Izgradnja web aplikacija</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/edit-agency.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <div class="edit-agency">
        <div class="edit-agency-container container">
            <?php
            if ($message) { ?>
                <div class="d-flex alert alert-info justify-content-center">
                    <small class="form-text text-muted"> <?php echo $message ?> </small>
                </div>
            <?php  }
        ?>

            <h3>Kreiranje izleta:</h3>
            <br>

            <form name="edit-trip" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?> ">

                <div class="form-group">
                    <label for="name"> Odredište </label>
                    <input class="form-control" name="destination" value="" required>
                </div>
                <div class="form-group">
                    <label for="description">Opis </label>
                    <textarea cols="30" rows="10" class="form-control" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="datum_o">Datum i vrijeme polaksa: </label>
                    <input class="form-control" name="date" id="date" type="text" value="" />
                </div>
                <div class="form-group">
                    <label for="name"> Ukupan broj mjesta </label>
                    <input class="form-control" name="places" value="" required>
                </div>
                <div class="form-group">
                    <label for="name"> Slika </label>
                    <input class="form-control" name="img" value="" required>
                </div>
                <div class="form-group">
                    <label for="name"> Video </label>
                    <input class="form-control" name="video" value="">
                </div>

                <div class="d-flex form-group justify-content-center">
                    <input class="btn btn-danger d-flex" type="submit" name="edit-trip" id="submit" value="Spremi">
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php
zatvoriVezu($v);
?>