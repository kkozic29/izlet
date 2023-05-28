<?php

    if (isset($_GET["odjava"])) {
        session_start();
        unset($_SESSION["id"]);
        unset($_SESSION["ime"]);
        unset($_SESSION["tip"]);
        session_destroy();
        setcookie("prijava", "", time() - 3600);
    }

    $error = '';

    if (isset($_POST["username"]) || isset($_POST["password"]) ) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $error = "Molim unesite korisničko ime i lozinku.";
        } else {
                include_once("baza.php");
                $v = otvoriVezu();
                $username = $_POST['username'];
                $password = $_POST['password'];

                $q = "SELECT * FROM korisnik WHERE korisnicko_ime='" . $username . "' 
                                                AND lozinka='" . $password . "'";

                $r = izvrsiUpit($v, $q);
                $row_num = mysqli_num_rows($r);

                if ($row_num === 1) {                    
                    session_start();
                    zatvoriVezu($v);
                    setcookie("prijava", $_POST["username"]);
                    $row = mysqli_fetch_array($r);

                    $_SESSION["id"] = $row["korisnik_id"];
                    $_SESSION["tip"] = $row["tip_id"];
                    $_SESSION["ime"] = $row["ime"];
                    $_SESSION["prezime"] = $row["prezime"];
                    header("Location: index.php");
                    exit();
            } else {
                $error = "Nepostojeći korisnik. Pokušajte ponovo.";
                zatvoriVezu($v);
            }
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
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <div class="login">
        <div class="login-container container">
            <div class="login-wrapper col-12">
                <form name="form" method="POST" action="login.php">

                    <label for="username"><b>Korisničko ime</b></label>
                    <input type="text" placeholder="Korisničko ime" name="username">

                    <label for="password"><b>Lozinka</b></label>
                    <input type="password" placeholder="Lozinka" name="password">

                    <button type="submit">Prijava korisnika</button>
                    <!--  <label>
                            <input type="checkbox" checked="checked" name="remember"> Zapamti prijavu
                            </label>
                    -->
                   <span class="error-message"> <?php echo $error ?> </span>
                </form>
            </div>
        </div>
    </div>

</body>

</html>