<header class="header">
  <div class="header-container container">

    <nav class="navigation">

      <a href="index.php" class="logo"></a>

      <ul class="desktop-nav">
        <?php
        if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
          echo '<li><a href="trips.php"> Izleti</a></li>';
        }
        if (isset($_SESSION["tip"]) && $_SESSION["tip"] == 0) {
          echo '<li><a href="users.php"> Korisnici</a></li>';
        }
        if (isset($_SESSION["tip"])) {
          echo '<li><a href="user.php">' . $_SESSION["ime"] . '</a></li>';
          echo '<li><a href="login.php?odjava=1">Odjava</a></li>';
        } else {
          echo '<li><a href="login.php">Prijava</a></li>';
        }
        ?>
        <li><a href="o_autoru.html">O autoru</a></li>
        <div class="clearfix"></div>
      </ul>

      <div class="hamburgerMenu">
        <div class="mobile-nav-container">
          <a *ngIf="!vm.isLoggedIn" class="d-lg-none login">Prijava</a>
          <div class="hamburger-icon" onclick="toggleMenu()">
            <div id="nav-icon1">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>
      </div>

      <div id="side-nav" class="side-nav">
        <div class="side-nav-body">

          <div class="underline">
            <li><a href="login.php">Prijava</a></li>
          </div>
          <div class="underline">
            <li><a href="o_autoru.html">O autoru</a></li>
          </div>
          <div class="underline logout">
            <a>Odjava</a>
          </div>


        </div>
      </div>

    </nav>

  </div>



</header>