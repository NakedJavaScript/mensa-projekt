<?PHP include_once 'functions/login.php'; ?>
<nav class="navbar navbar-expand-lg navbar-light custom-nav-bg" id="cd-top-link">
    <a class="navbar-brand" href="index.php"><img src='../images/logo.png' width="120px"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?PHP
                if (isset($_SESSION['adminrechte'])) {
                    if($_SESSION['adminrechte'] == 2) { // Only admins can see these sites
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='benutzerliste.php'>Benutzerliste <span class='sr-only'>(current)</span></a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='essensliste.php'>Essensliste</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='orders.php'>Bestellungen</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='umsatz.php'>Umsatz</a>
                        </li>";
                    } else if($_SESSION['adminrechte'] == 3) { // Normal users will see this
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='profil.php'>Profil</a>
                        </li>";
                    }
                }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
                if (isset($_SESSION['email'])) { // Shows the Profile Dropdown for the current user
                    echo  "<div class='btn-group pl-5 pr-5'>
                    <a role='button' href='profil.php' class='btn btn-primary'>" . $_SESSION['vorname'] . "</a>
                    <button type='button' class='btn btn-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <span class='sr-only'>" . $_SESSION['email'] . "</span>
                    </button>
                    <div class='dropdown-menu'>
                    <a class='dropdown-item mx-0 my-0 pt-0 pb-0 pl-2 pr-2' href='profil.php#v-pills-profile'>Profil</a>
                    <a class='dropdown-item mx-0 my-0 pt-0 pb-0 pl-2 pr-2' href='profil.php#v-pills-order'>Bestellungen</a>
                    <div class='dropdown-divider'></div>
                    <a class='dropdown-item mx-0 my-0 pt-0 pb-0 pl-2 pr-2' href='logout.php'>Logout</a>
                    </div>
                    </div>";
                } else { // Or else a login button
                    echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#popUpWindow'>Login</button>";
                }
            ?>
        </ul>
    </div>
</nav>

<div class="container position-absolute ml-auto mr-auto alert-container">
    <?PHP echo $Alert; // This is used to show our messages which we defined in the dependencies.php ?>
    <div class='alert alert-dismissable fade mt-4' id='orderInfo'>
        <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="popUpWindow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Login</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <div class="form-group">
                        <label for="email">Email</label><input type="email" name="email" class="form-control"  placeholder="Email" required/><br>
                        <label for="password" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" required/>
                    </div>
                    <div class="modal-footer flex-column">
                        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Einloggen">
                        <a href="forgotPassword.php">Passwort vergessen?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper"> <!-- Start of the page-content-wrapper, everything inside it is our content, also makes sure that the footer stays at the bottom -->
