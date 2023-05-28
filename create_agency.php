<?php
session_start();
include_once("baza.php");
$v = otvoriVezu();
$message = '';

if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
    $q1 = "SELECT * FROM korisnik WHERE tip_id = 1";
    $moderators = izvrsiUpit($v, $q1);
} else {
    header("Location: login.php");
}

if (isset($_POST["create-agency"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $moderator = $_POST["moderator"];

    $greska = false;

    if (!isset($name) || empty($name)) {
        $greska = true;
    }
    if (!isset($description) || empty($description)) {
        $greska = true;
    }
    if (!isset($moderator) || empty($moderator)) {
        $greska = true;
    }

    if (!$greska) {
        $q4 = "SELECT COUNT(1) AS exist FROM agencija WHERE moderator_id = $moderator;";
        $exist_r = izvrsiUpit($v, $q4);
        $row_exist = mysqli_fetch_array($exist_r);

        if ($row_exist["exist"]) {
            $message = "Nažalost samo 1 moderator može biti zadužen za jednu agenciju.";
        } else {
            $message = "Kreirali ste agenciju";
            $q3 = "INSERT INTO agencija 
                    (moderator_id,naziv,opis) 
                    VALUES ('" . $_POST["moderator"] . "',
                    '" . $_POST["name"] . "',
                    '" . $_POST["description"] . "');";

            izvrsiUpit($v, $q3);
        }
    } else {
        $message = "Greška prilikom kreiranja agencije!";
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
    <link rel="stylesheet" href="./css/create-agency.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <div class="create-agency">
        <div class="create-agency-container container">
            <?php
            if ($message) { ?>
                <div class="d-flex alert alert-info justify-content-center">
                    <small class="form-text text-muted"> <?php echo $message ?> </small>
                </div>
            <?php  }
        ?>

            <h3>Kreiranje agencije: </h3>
            <br>

            <form name="create-agency" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?> ">

                <div class="form-group">
                    <label for="name"> Naziv </label>
                    <input class="form-control" name="name" value="" required>
                </div>
                <div class="form-group">
                    <label for="surename"> Opis </label>
                    <input class="form-control" name="description" value="" required>
                </div>
                <div class="form-group">
                    <label for="surename"> Odabir moderatora </label>
                    <select class="form-control" name="moderator" id="moderator">
                        <?php
                        while ($moderator = mysqli_fetch_array($moderators)) {
                            echo "<option value=\"" . $moderator["korisnik_id"] . "\"";

                            echo ">" . $moderator["korisnicko_ime"] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="d-flex form-group justify-content-center">
                    <input class="btn btn-danger d-flex" type="submit" name="create-agency" id="submit" value="Kreiraj">
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php
zatvoriVezu($v);
?>