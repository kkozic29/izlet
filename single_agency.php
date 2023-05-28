<?php
session_start();
include_once("baza.php");
$v = otvoriVezu();
$id = $_GET['id'];

$q1 = "SELECT * FROM agencija WHERE agencija_id = '$id';";
$agency_title = izvrsiUpit($v, $q1);

if (isset($_SESSION["tip"]) && $_SESSION["tip"] <= 1) {
    $q2 = "SELECT * FROM agencija, rezervacija, izlet
                WHERE agencija.agencija_id = rezervacija.agencija_id
                AND rezervacija.izlet_id = izlet.izlet_id AND agencija.agencija_id = $id ";
    $activities = izvrsiUpit($v, $q2);

    $all_trips = "SELECT * FROM izlet";
    $select_list = izvrsiUpit($v, $all_trips);
} else {
    $q3 = "SELECT * FROM agencija, rezervacija, izlet
                WHERE agencija.agencija_id = rezervacija.agencija_id
                AND rezervacija.izlet_id = izlet.izlet_id AND agencija.agencija_id = $id";
    $activities = izvrsiUpit($v, $q3);
}

$message = '';

if (isset($_POST["reserve"])) {
    $trip_id = $_POST['trip_id'];
    $place_number = $_POST['place_number'];

    $q4 = "SELECT COUNT(1) AS exist FROM rezervacija WHERE agencija_id = $id AND izlet_id = $trip_id;";
    $exist_r = izvrsiUpit($v, $q4);
    $row_exist = mysqli_fetch_array($exist_r);

    if ($row_exist["exist"]) {
        $message = "Rezervacija za navedeni izlet već postoji.";
    } else {
        $q5 = "INSERT INTO rezervacija 
                (agencija_id,izlet_id,broj_mjesta)
                VALUES ('" . $id . "',
                    '" . $trip_id . "',
                    '" . $place_number . "');";
        $r = izvrsiUpit($v, $q5);
        $message = "Rezervacija uspješno obavljena!";
    }
}

if (isset($_SESSION["tip"]) && $_SESSION["tip"] <= 2) {
    $user_id = $_SESSION["id"];
    $user_type = $_SESSION["tip"];

    $q6 = "SELECT * FROM agencija WHERE agencija_id = '$id';";
    $agency_r = izvrsiUpit($v, $q6);
    $agency = mysqli_fetch_array($agency_r);
    $agency_moderator = $agency["moderator_id"];
}

if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {

    $q7 = "SELECT COUNT(*) AS broj_predbiljezbi FROM predbiljezba, rezervacija
    WHERE predbiljezba.rezervacija_id = rezervacija.rezervacija_id
    AND predbiljezba.status = 0 AND rezervacija.agencija_id = $id;";
    $broj_pred = izvrsiUpit($v, $q7);
    $predbiljezbe = mysqli_fetch_array($broj_pred);

    $q8 = "SELECT COUNT(*) AS broj_sudionika FROM predbiljezba, rezervacija
    WHERE predbiljezba.rezervacija_id = rezervacija.rezervacija_id
    AND predbiljezba.status = 1 AND agencija_id = $id;";
    $broj_potvrdenih = izvrsiUpit($v, $q8);
    $predbiljezbe_potvrdene = mysqli_fetch_array($broj_potvrdenih);


    $q9 = "SELECT broj_mjesta FROM rezervacija
    WHERE rezervacija.agencija_id = $id";
    $broj_r = izvrsiUpit($v, $q9);
    $rezervacije = mysqli_fetch_array($broj_r);
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Izgradnja web aplikacija</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/single_agency.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <div class="single-agency">
        <div class="single-agency-container container">
            <?php
            if ($message) { ?>
                <div class="d-flex alert alert-info justify-content-center">
                    <small class="form-text text-muted"> <?php echo $message ?> </small>
                </div>
            <?php  }
        ?>


            <div class="col-12">
                <?php
                if ($agency_title->num_rows > 0) {
                    while ($row = mysqli_fetch_array($agency_title)) {
                        echo "<h2 class='title'>" . $row['naziv'] . "</h2>";
                        if (isset($_SESSION["tip"]) && ($agency_moderator == $user_id)) {
                            echo "<small><b> (Moderator agencije)</b> </small> <br><br>";
                        }
                        echo "<p class='description'>" . $row['opis'] . "<p>";
                        break;
                    }
                } ?>
                <?php

                if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {   ?>
                    <h6>
                        Statistika: </h6>
                    <p>Ukupan broj ne potvrđenih predbilježbi agencije: <?php echo $predbiljezbe['broj_predbiljezbi'] . "<br>";  ?></p>
                    <p>Ukupan broj potvrđenih predbilježbi agencije: <?php echo $predbiljezbe_potvrdene['broj_sudionika'] . "<br>";  ?></p>
                    <p>Ukupan broj rezervacija agencije: <?php echo $rezervacije['broj_mjesta'] . "<br>";  ?></p>
                <?php   }


            ?>



                <h5 class='title activities'> Popis izleta agencije: </h5>
                <?php
                if ($activities->num_rows > 0) { ?>
                    <table>
                        <?php
                        if ($activities->num_rows > 0) {

                            while ($row = mysqli_fetch_array($activities)) {
                                echo "<tr>" .
                                    "<td>" . "<a class='description col-6' href=\"trip.php?trip_id=" . $row[8] . "&agency_id=" . $id . "\">" . $row[9] . "</a>" . "</td>"  ?>
                                <td>
                                    <?php
                                    if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
                                        echo "<a class=\"edit\" href=\"edit_trip.php?id=" . $row[8] . "&agency_id=" . $id . "\">" . "Uredi" . "</a>";
                                    }
                                    ?>
                                </td>
                                </tr>

                            <?php }
                    } ?>
                    </table>
                <?php } else {
                echo "Agencija nema izleta.";
                if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
                    echo "<div class=\"create-trip\">
                            <a href=\"create_trip.php\">
                                Kreiraj novi
                            </a>
                          </div>";
                }
            }

            ?>
                <?php
                if (isset($_SESSION["tip"]) &&  $_SESSION["tip"] <= 1) {
                    ?>
                    <br><br>
                    <?php

                    if (isset($_SESSION["tip"]) && ($agency_moderator == $user_id || $user_type == 0)) {
                        ?>
                        <h5>Rezervacija moderatora:</h5>
                        <form name="reserve-trip" method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?> ">
                            <div class="form-group">

                                <label for="moderator_id">Odabir izleta: </label>
                                <select class="form-control" name="trip_id" id="moderator_id">
                                    <?php

                                    while ($row = mysqli_fetch_array($select_list)) {
                                        echo "<option value=\"" . $row["izlet_id"] . "\"";

                                        echo ">" . $row["odrediste"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Odabir broja mjesta: </label>
                                <input class="form-control" name="place_number" id="place_number" type="number" placeholder="npr. 3" required>
                            </div>
                            <div class="d-flex form-group justify-content-center">
                                <input class="btn btn-danger d-flex" type="submit" name="reserve" id="submit" value="Rezerviraj">
                            </div>
                        </form>
                    <?php  } ?>
                <?php
            }
            ?>

            </div>

        </div>
    </div>
</body>

</html>


<?php
zatvoriVezu($v);
?>