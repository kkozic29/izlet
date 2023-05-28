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

                $q2 = "SELECT * FROM korisnik WHERE korisnik.tip_id = 1";
                $user_types_r = izvrsiUpit($v,$q2);
                $message = '';
        if (isset($_POST["edit-agency"])) {
                $name = $_POST["name"];
                $description = $_POST["description"];
                $moderator_id = $_POST["moderator_id"];
                $greska = false;    

                if(!isset($name) || empty($name))
                {
                    $greska = true;                    
                }
                if(!isset($description) || empty($description))
                {
                    $greska = true;                    
                }
                if(!$greska) {
                    $q4 = "SELECT COUNT(1) AS exist FROM agencija WHERE moderator_id = $moderator_id AND NOT agencija_id = $id;";
                    $exist_r = izvrsiUpit($v, $q4);
                    $row_exist = mysqli_fetch_array($exist_r);

                    if ($row_exist['exist'] == 0){
                        $message = "Ažurirali ste agenciju";
                        $q3 = "UPDATE agencija SET `moderator_id`='".$moderator_id."', `naziv`='".$name."', `opis`='".$description."' WHERE `agencija_id` = ".$id;
                        izvrsiUpit($v,$q3);
                    } else {
                        $message = "Nažalost samo 1 moderator može biti zadužen za jednu agenciju.";
                    }

                }
            }            

        $q1 = "SELECT * FROM agencija WHERE agencija_id = " . $id;
        $agency_r = izvrsiUpit($v, $q1);
        $agency = mysqli_fetch_assoc($agency_r);

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
                        if($message) { ?>
                            <div class="d-flex alert alert-info justify-content-center">
                                            <small class="form-text text-muted"> <?php echo $message ?> </small>
                                        </div>
                      <?php  }
            ?>

            <h3>Uređivanje agencije:</h3>
            <br>

            <form name="edit-user" method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $id; ?> ">

                <div class="form-group">
                    <label for="name"> Naziv </label>
                    <input class="form-control" name="name" value="<?php echo $agency["naziv"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Opis </label>
                    <textarea cols="30" rows="10" class="form-control" name="description" required><?php echo $agency["opis"]; ?></textarea>  
                </div>
                <div class="form-group">
                    <label for="user_type">Moderator: </label>
                    <select class="form-control" name="moderator_id" id="name">
                        <?php


                        $agency_moderator = $agency["moderator_id"];
                        while ($row = mysqli_fetch_array($user_types_r)) {
                            $moderator_id = $agency["moderator_id"];
                            $korisnik_id = $row["korisnik_id"];

                            $selected = ($agency_moderator == $row["korisnik_id"]) ? ' selected="selected"' : '';
                            echo "<option value=\"" . $korisnik_id . "\" '.$selected.'";

                            echo ">" . $row["ime"] . ' ' . $row["prezime"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="d-flex form-group justify-content-center">
                    <input class="btn btn-danger d-flex" type="submit" name="edit-agency" id="submit" value="Spremi">
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php
    zatvoriVezu($v);
?>