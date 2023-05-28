<?php
session_start();
include_once("baza.php");
$v = otvoriVezu();
$agency_id = $_GET['agency_id'];
$trip_id = $_GET['trip_id'];

$q1 = "SELECT * FROM izlet WHERE izlet_id = '$trip_id';";
$trip = izvrsiUpit($v, $q1);

$q2 = "SELECT COUNT(*) AS broj_sudionika FROM predbiljezba, rezervacija
           WHERE predbiljezba.rezervacija_id = rezervacija.rezervacija_id
           AND predbiljezba.status = 1 AND rezervacija.izlet_id = '$trip_id' AND agencija_id = '$agency_id';";
$users_count_r = izvrsiUpit($v, $q2);

$q3 = "SELECT rezervacija_id FROM rezervacija
    WHERE rezervacija.agencija_id = $agency_id AND rezervacija.izlet_id = $trip_id;";
$reservation_id_r = izvrsiUpit($v, $q3);

$reservation_id = mysqli_fetch_array($reservation_id_r);

$q4 = "SELECT broj_mjesta FROM rezervacija
    WHERE rezervacija.agencija_id = $agency_id AND rezervacija.izlet_id = $trip_id;";
$moderator_count_r = izvrsiUpit($v, $q4);

$moderator_count = mysqli_fetch_array($moderator_count_r);

if (isset($_POST["preregister"])) {
    $q5 = "INSERT INTO predbiljezba 
        (korisnik_id,rezervacija_id,status)
        VALUES ('" . $_SESSION["id"] . "',
            '" . $reservation_id["rezervacija_id"] . "',
            '" . 0 . "');";

    $r = izvrsiUpit($v, $q5);
    header("Location: user.php?predbiljezba=1");
    exit();
}



if (isset($_SESSION["tip"]) && $_SESSION["tip"] <= 2) {
    $user_id = $_SESSION["id"];
    $user_type = $_SESSION["tip"];


    $q6 = "SELECT * FROM agencija WHERE agencija_id = '$agency_id';";
    $agency_r = izvrsiUpit($v, $q6);
    $agency = mysqli_fetch_array($agency_r);
    $agency_moderator = $agency["moderator_id"];

    $q7 = "SELECT ime, prezime, status FROM korisnik, predbiljezba, rezervacija
        WHERE korisnik.korisnik_id = predbiljezba.korisnik_id
        AND predbiljezba.rezervacija_id = rezervacija.rezervacija_id
        AND rezervacija.izlet_id = $trip_id ";
    $trip_users = izvrsiUpit($v, $q7);
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
    <link rel="stylesheet" href="./css/trip.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <div class="trip">
        <div class="trip-container container">

            <div class="col-12">
                <?php
                if ($trip->num_rows > 0) {
                    $users_count = mysqli_fetch_array($users_count_r);
                    while ($row = mysqli_fetch_array($trip)) {
                        echo "<h2 class='title'> Odredište: " . $row['odrediste'] . "</h2>";
                        echo "<p class='description'>" . $row['opis'] . "<p>";
                        if (isset($_SESSION["tip"])) {
                            echo "<p class='description'> <strong> Broj rezervacija moderatora: </strong>" . $moderator_count[0] . "<p>";
                            echo "<p class='description'> <strong> Ukupan broj mjesta: </strong>" . $row['ukupan_broj_mjesta'] . "<p>";
                        }
                        echo "<p class='description'> <strong> Broj sudionika na izletu: </strong>" . $users_count[0] . "<p><hr>";
                        if (isset($_SESSION["tip"])) {
                            echo "<p class='description'> <strong> Broj slobodnih mjesta: </strong>" . ($row['ukupan_broj_mjesta'] - $users_count[0]) . "<p>";
                        }
                        break;
                    }
                } ?>
                <?php
                if (($row['ukupan_broj_mjesta'] - $users_count[0]) > 0 && isset($_SESSION["tip"])) {
                    ?>
                    <form name="submit" id="forma" method="POST" action="trip.php?trip_id= <?php echo $trip_id  ?> &agency_id= <?php echo $agency_id ?>">
                        <input class="btn btn-primary" type='submit' name="preregister" value='Predbilježba' />
                    </form>
                <?php
            }

            if (isset($_SESSION["tip"]) && ($agency_moderator == $user_id || $user_type == 0)) {
                ?>
                    <br>

                    <h3>Popis sudionika izleta</h3>
                    <br>

                    <table>
                        <tr>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Status</th>
                        </tr>
                        <?php
                        if ($trip_users->num_rows > 0) {

                            while ($row = mysqli_fetch_array($trip_users)) {
                                echo "<tr>" .
                                    "<td>" . $row["ime"] . "</td>" .
                                    "<td>" . $row["prezime"] . "</td>" .
                                    "<td>" . $row["status"] . "</td>"  ?>

                                </tr>
                            <?php }
                    } ?>
                    </table>

                <?php }

            ?>


            </div>

        </div>
    </div>
</body>

</html>


<?php
zatvoriVezu($v);
?>