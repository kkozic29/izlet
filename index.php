<?php
	session_start();	
		include_once("baza.php");
		$v = otvoriVezu();
		$q = "SELECT * FROM agencija";
		$r = izvrsiUpit($v,$q);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Izgradnja web aplikacija</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</head>
<body>
    <?php 
      include("header.php");
    ?> 

    <div class="table">
            <div class="table-container container">
                <div class="col-12">
                <?php      


                        while($row = mysqli_fetch_array($r)) {
                            echo 
                            "<div class='col-12 table-row'>
                                <a href=\"single_agency.php?id=" . $row[0] . "\">" . $row["naziv"] . "</a>";
                                if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
                                    echo "<a class=\"edit\" href=\"edit_agency.php?id=" . $row[0] . "\"> 
                                            Uredi
                                          </a>";
                                }                                
                                
                            echo "</div>";
                        }	
                        
                        if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
                            echo "<div class=\"create-agency\">
                                    <a href=\"create_agency.php\">
                                        Kreiraj novu
                                    </a>
                                  </div>";
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