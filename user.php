<?php
session_start();
include_once("baza.php");
$v = otvoriVezu();
$message = '';

if (isset($_GET['predbiljezba'])) {
    $boolean_msg = $_GET['predbiljezba'];
    if ($boolean_msg) {
        $message = 'Uspješno ste se predbilježili na izlet!';
    }
}


if (isset($_SESSION["id"])) {

    $user_id = $_SESSION["id"];

    $q1 = "SELECT  * FROM izlet, rezervacija, predbiljezba
        WHERE rezervacija.izlet_id = izlet.izlet_id
        AND predbiljezba.rezervacija_id = rezervacija.rezervacija_id
        AND predbiljezba.korisnik_id = $user_id;";
    $trip_r = izvrsiUpit($v, $q1);

    if (isset($_POST["register"])) {
        $reservation_id = $_GET['reservation_id'];
        $update_status_q = "UPDATE predbiljezba SET `status` = 1 WHERE korisnik_id = $user_id AND rezervacija_id = $reservation_id";
        izvrsiUpit($v, $update_status_q);
        header("Location: user.php");
    }

    if (isset($_POST["filter_by_name"])) {
        $agency_name = $_POST["name"];
        $q2 = "SELECT * FROM izlet, rezervacija, predbiljezba
            WHERE rezervacija.izlet_id = izlet.izlet_id
            AND predbiljezba.rezervacija_id = rezervacija.rezervacija_id
            AND predbiljezba.korisnik_id = $user_id
            AND izlet.odrediste = '$agency_name' ;";

        $trip_r = izvrsiUpit($v, $q2);
    }

    $err_datum_p = "";
    $err_datum_d = "";
    $err_vrijeme_p = "";
    $err_vrijeme_d = "";

    if (isset($_POST["filter_by_date"])) {
        $datum1 = date("Y-m-d", strtotime($_POST['datum_p']));
        $datum2 = date("Y-m-d", strtotime($_POST['datum_k']));
        $vrijeme1 = $_POST['vrijeme_p'];
        $vrijeme2 = $_POST['vrijeme_k'];

        if (empty($_POST["datum_p"])) {
            $err_datum_p = "Molimo unesite i datum polaska.";
        }
        if (empty($_POST["datum_k"])) {
            $err_datum_d = "Molimo unesite i datum dolaska.";
        }
        if (empty($_POST["vrijeme_p"])) {
            $err_vrijeme_p = "Molimo unesite i vrijeme polaska.";
        }
        if (empty($_POST["vrijeme_k"])) {
            $err_vrijeme_d = "Molimo unesite i vrijeme dolaska.";
        }

        if (!empty($_POST["datum_p"]) && !empty($_POST["datum_k"]) && !empty($_POST["vrijeme_p"]) && !empty($_POST["vrijeme_k"])) {
            $q3 = "SELECT odrediste, datum_vrijeme_polaska, status, organiziran FROM izlet, rezervacija, predbiljezba
                WHERE rezervacija.izlet_id = izlet.izlet_id
                AND predbiljezba.rezervacija_id = rezervacija.rezervacija_id
                AND predbiljezba.korisnik_id = 3
                AND izlet.datum_vrijeme_polaska BETWEEN '$datum1 $vrijeme1' AND '$datum2 $vrijeme2';";

            $trip_r = izvrsiUpit($v, $q3);
        }
    }
} else {
    header("Location: login.php");
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
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <div class="user">
        <div class="user-container container">



            <?php
            if ($message) { ?>
                <div class="d-flex alert alert-success justify-content-center">
                    <small class="form-text text-muted"> <?php echo $message ?> </small>
                </div>
            <?php  }
        ?>

            <div class="col-12">
                <h5>Filter popisa izleta</h5>
                <form name="forma" id="forma" method="POST" class="forma" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="form-group">
                        <label for="name">Naziv izleta: </label>
                        <input class="form-control" name="name" id="name" type="text" placeholder="npr. New York City" required>
                    </div>
                    <div class="d-flex form-group justify-content-center">
                        <input class="btn btn-danger d-flex" type="submit" name="filter_by_name" id="submit" value="Filter po nazivu">
                    </div>
                </form>
                <form name="forma" id="forma" method="POST" class="forma" action="<?php echo $_SERVER["PHP_SELF"] ?>">

                    <div class="form-group">
                        <label for="ime">Datum polaska: </label>
				        <input class="form-control" name="datum_p" id="datum_p" type="text" value="" placeholder="npr. 06.05.2016" required/>
                    </div>
                    <div class="form-group">
                        <label for="ime">Datum dolazka: </label>
				        <input class="form-control" name="datum_k" id="datum_k" type="text" value="" placeholder="npr. 06.05.2018" required/>
                        <small class="form-text text-muted"> <?php echo $err_datum_d ?> </small>
                    </div>
                    <div class="form-group">
                        <label for="ime">Vrijeme polaska: </label>
                        <input class="form-control" name="vrijeme_p" id="vrijeme_p" type="text" placeholder="hh:mm:ss" required>
                        <small class="form-text text-muted"> <?php echo $err_vrijeme_p ?> </small>
                    </div>
                    <div class="form-group">
                        <label for="ime">Vrijeme dolaska: </label>
                        <input class="form-control" name="vrijeme_k" id="vrijeme_k" type="text" placeholder="hh:mm:ss" required>
                        <small class="form-text text-muted"> <?php echo $err_vrijeme_d ?> </small>
                    </div>

                    <div class="d-flex form-group justify-content-center">
                        <input class="btn btn-danger d-flex" type="submit" name="filter_by_date" id="submit" value="Filter po vremenu" />
                    </div>


                </form>
                <h3>Popis svih mojih izleta</h3>
                <br>

                <table>
                    <tr>
                        <th>Odredište</th>
                        <th>Datum i vrijeme polaska</th>
                        <th>Organiziran</th>
                        <th>Status</th>
                        <th>Potvrdi rezervaciju</th>
                    </tr>
                    <?php
                    if ($trip_r->num_rows > 0) {

                        while ($row = mysqli_fetch_array($trip_r)) {
                            echo "<tr>" .
                                "<td>" . $row["odrediste"] . "</td>" .
                                "<td>" . date('d.m.Y H:m:s',strtotime($row['datum_vrijeme_polaska'])) . " sati. </td>" .
                                "<td>" . $row["organiziran"] . "</td>" .
                                "<td>" . $row["status"] . "</td>"  ?>

                            <td class="d-flex justify-content-center">
                                <?php
                                if ($row["organiziran"] == 1 && $row["status"] == 0) {
                                    ?>
                                    <form name="submit" id="forma" method="POST" action=" <?php echo $_SERVER["PHP_SELF"] . "?reservation_id=" . $row["rezervacija_id"]; ?> ">
                                        <input class="btn btn-primary" type='submit' name="register" value='Potvrdi' />
                                    </form>
                                <?php
                            } else if ($row["organiziran"] == 1 && $row["status"] == 1) {
                                echo "<span>Rezervacija potvrđena.</span>";
                            } else {
                                echo "<span>Potvrda moguća nakon organiziranja izleta.</span>";
                            }
                            ?>
                            </td>

                            </tr>
                        <?php }
                } ?>
                </table>


            </div>

        </div>
    </div>
</body>

</html>


<?php
zatvoriVezu($v);
?>