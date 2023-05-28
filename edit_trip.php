<?php
session_start();
include_once("baza.php");
$v = otvoriVezu();
$id = $_GET['id'];

if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
    $q1 = "SELECT * FROM izlet WHERE izlet_id = " . $id;
    $trip = izvrsiUpit($v, $q1);

    $q2 = "SELECT * FROM agencija";
    $agency = izvrsiUpit($v, $q2);

    $q4 = "SELECT izlet_id, ukupan_broj_mjesta, ((SELECT COUNT(*) FROM predbiljezba, rezervacija
WHERE predbiljezba.rezervacija_id = rezervacija.rezervacija_id AND rezervacija.izlet_id = izlet.izlet_id)/ukupan_broj_mjesta)*100 AS popunjeno FROM izlet WHERE izlet_id=$id";
    $popunjeno = izvrsiUpit($v, $q4);

    while ($row = $popunjeno->fetch_assoc()) {
        echo $row['popunjeno'] . "<br>";
    }
} else {
    header("Location: login.php");
}

$q2 = "SELECT * FROM korisnik WHERE korisnik.tip_id = 1";
$user_types_r = izvrsiUpit($v, $q2);
$message = '';

if (isset($_POST["organise"])) {
    $q3 = "UPDATE izlet SET `organiziran`='" . 1 . "' WHERE `izlet_id` = " . $id;
    izvrsiUpit($v, $q3);
    $message = "Uspješno ste organizirali izlet.";
}

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
        $message = "Ažurirali ste izlet s novim podacima.";
        $q3 = "UPDATE izlet SET `odrediste`='" . $odrediste . "', `datum_vrijeme_polaska`='" . $datum_pocetka . "',
                         `opis`='" . $opis . "', `ukupan_broj_mjesta`='" . $mjesta . "', `slika`='" . $slika . "', `video`='" . $video . "' WHERE `izlet_id` = " . $id;
        izvrsiUpit($v, $q3);
    } else {
        $message = "Greška kod ažuriranja izleta.";
    }
}

$q1 = "SELECT * FROM izlet WHERE izlet_id = " . $id;
$trip_r = izvrsiUpit($v, $q1);
$trip = mysqli_fetch_assoc($trip_r);

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

            <h3>Uređivanje izleta:</h3>
            <br>

            <form name="edit-trip" method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?> ">
                <?php
                if ($trip["slika"]) {
                    ?>
                    <div class="form-group">
                        <div style='position:relative; padding-bottom: 20px; '><img height="300" ; src='<?php echo $trip["slika"]; ?>' /></div>
                        <label for="name"> Odredište </label>
                        <input class="form-control" name="destination" value="<?php echo $trip["odrediste"]; ?>" required>
                    </div>
                <?php  }  ?>

                <div class="form-group">
                    <label for="description">Opis </label>
                    <textarea cols="30" rows="10" class="form-control" name="description" required><?php echo $trip["opis"]; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="datum_o">Datum i vrijeme polaksa: </label>
                    <input class="form-control" name="date" id="date" type="text" value="<?php echo date("d.m.Y H:m:s", strtotime($trip['datum_vrijeme_polaska'])); ?>" />
                </div>
                <div class="form-group">
                    <label for="name"> Ukupan broj mjesta </label>
                    <input class="form-control" name="places" value="<?php echo $trip["ukupan_broj_mjesta"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="name"> Slika </label>
                    <input class="form-control" name="img" value="<?php echo $trip["slika"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="name"> Video </label>
                    <input class="form-control" name="video" value="<?php echo $trip["video"]; ?>">
                </div>

                <div class="d-flex form-group justify-content-center">
                    <input class="btn btn-danger d-flex" type="submit" name="edit-trip" id="submit" value="Spremi">
                </div>
            </form>

            <form name="organise" method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?> ">

                <div class="d-flex form-group justify-content-center">
                    <input class="btn btn-danger d-flex" type="submit" name="organise" id="submit" value="Organiziraj">
                </div>

            </form>
        </div>
    </div>

</body>

</html>

<?php
zatvoriVezu($v);
?>