<?php
    session_start();
    include_once("baza.php");
        $v = otvoriVezu();
        $id = $_GET['id'];

        if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
            $q1 = "SELECT * FROM korisnik;";
            $users = izvrsiUpit($v, $q1);
        } else {
            header("Location: login.php");
        }

        $q2 = "SELECT * FROM tip_korisnika";
        $user_types_r = izvrsiUpit($v,$q2);
        $message = '';


        if (isset($_POST["edit-user"])) {
                $name = $_POST["name"];
                $surename = $_POST["surename"];
                $email = $_POST["email"];
                $user_type = $_POST["user_type"];
                $image =  "korisnici/".$_POST["image"];
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                $greska = false;

                if(!isset($name) || empty($name))
                {
                    $greska = true;
                    
                }
                if(!isset($surename) || empty($surename))
                {
                    $greska = true;
                    
                }
                if(!isset($email) || empty($email))
                {
                    $greska = true;
                    
                }
                if(!isset($user_type))
                {
                    $greska = true;
                    
                }
                if(!isset($username) || empty($username))
                {
                    $greska = true;
                    
                }
                if(!isset($password) || empty($password))
                {
                    $greska = true;
                    
                }
                if(!$greska) {
                    $message = "Ažurirali ste korisnika";
                    $q3 = "UPDATE korisnik SET `tip_id`=".$user_type
                    .", `ime`='".$name."',`prezime`='".$surename."', `slika`='".$image."', `email`='".$email."', `korisnicko_ime`='".$username
                    ."', `lozinka`='".$password."' WHERE korisnik_id = ".$id;
                    izvrsiUpit($v,$q3);
                }
            }            

        $q1 = "SELECT * FROM korisnik WHERE korisnik_id = " . $id;
        $user_r = izvrsiUpit($v, $q1);
        $user = mysqli_fetch_assoc($user_r);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Izgradnja web aplikacija</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/edit-user.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <div class="edit-user">
        <div class="edit-user-container container">
        <?php 
                        if($message) { ?>
                            <div class="d-flex alert alert-info justify-content-center">
                                            <small class="form-text text-muted"> <?php echo $message ?> </small>
                                        </div>
                      <?php  }
            ?>

            <h3>Uređivanje korisnika id: <?php echo $id; ?></h3>
            <br>

            <form name="edit-user" method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?> ">

           <div style='position:relative; padding-bottom: 20px;'><img src='<?php echo $user["slika"]; ?>'/></div>
                <div class="form-group">
                    <label for="name">Ime </label>
                    <input class="form-control" name="name" value="<?php echo $user["ime"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="surename">Prezime </label>
                    <input class="form-control" name="surename" value="<?php echo $user["prezime"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="user_type">Tip korisnika: </label>
                    <select class="form-control" name="user_type" id="name">
                        <?php

                        while ($row = mysqli_fetch_array($user_types_r)) {
                            echo "<option value=\"" . $row["tip_id"] . "\"";

                            echo ">" . $row["tip_id"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Korisničko ime </label>
                    <input class="form-control" name="username" value="<?php echo $user["korisnicko_ime"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Lozinka </label>
                    <input class="form-control" name="password" value="<?php echo $user["lozinka"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input class="form-control" name="email" value="<?php echo $user["email"]; ?>" required>
                </div>
                <div class="form-group">
                <label>Slika</label>
                <input type="file" name="image" required value="<?php echo $user["slika"]; ?>"><br/>
                </div>
                <div class="d-flex form-group justify-content-center">
                    <input class="btn btn-danger d-flex" type="submit" name="edit-user" id="submit" value="Spremi">
                </div>
            </form>

        </div>
    </div>
</body>

</html>


<?php
zatvoriVezu($v);
?>