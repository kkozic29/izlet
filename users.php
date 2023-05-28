<?php
session_start();
    include_once("baza.php");
    $v = otvoriVezu();


    if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0 ) {
        $q1 = "SELECT * FROM korisnik;";
        $users = izvrsiUpit($v, $q1);
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
    <link rel="stylesheet" href="./css/users.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>

<body>
    <?php
    include("header.php");
    ?>

    <div class="users">
        <div class="users-container container">

        <h3>Popis svih korisnika</h3>
            <br>

            <table>  
            <tr>
                <th>Korisnik Id</th>
                <th>Korisnik Tip</th>
                <th>Korisničko ime</th>
                <th>Ime</th> 
                <th>Prezime</th>
                <th>Email</th>
                <th>Uredi</th>
            </tr>
            <?php
            if ($users->num_rows > 0) {               
                
                while ($row = mysqli_fetch_array($users)) {
                echo "<tr>" . 
                        "<td>" . $row["korisnik_id"] . "</td>" .                         
                        "<td>" . $row["tip_id"] . "</td>" . 
                        "<td>" . $row["korisnicko_ime"] . "</td>" . 
                        "<td>" . $row["ime"] . "</td>" . 
                        "<td>" . $row["prezime"] . "</td>" .  
                        "<td>" . $row["email"] . "</td>"  ?>
                        <td class="d-flex justify-content-center">            
                            
                                <div class="btn btn-primary"> <?php echo '<a style="color: #fff" href="edit_user.php?id=' . $row["korisnik_id"] . '">Uredi</a>'; ?> </div>
                            
                        </td>
                    </tr>
            <?php }
        } ?> 
            </table>

        </div>
    </div>
</body>

</html>


<?php
zatvoriVezu($v);
?>