<?php
include 'assets/model/Database.php';
include_once 'assets/model/classUser.php';
$user = new User();
// Checking for user logged in or not
//if (!$user->get_session())
//{
//   header("location:account.php?pagename=Mijn%20Account");
//}

?>

<!-- HEAD
================================================== -->
<?php include 'assets/elements/head.php' ?>

<!-- NAVBAR
================================================== -->
<?php include 'assets/elements/nav.php' ?>

<!-- WELCOME
================================================== -->
<?php include 'assets/elements/welcome.php' ?>


<!-- REGISTREREN
================================================== -->

<section class="section menu-section" id="register"></section>
<section class="section section_menu section_border_bottom">
    <div id="container" class="container">

        <?php
        if (isset($_POST['submit'])){
            extract($_POST);
            $register = $user->reg_user($fullname, $uname, $upass, $uemail);
            if ($register) {
                // Registration Success
                echo "<div class='alert alert-success text-center' >
                        <strong>Registratie gelukt</strong>, klik <a href='login.php?pagename=Inloggen'>hier</a> om in te loggen.
                      </div>";
            } else {
                // Registration Failed
                echo "<div class='alert alert-danger text-center' >
                        <strong>Registratie mislukt</strong>, deze e-mail of gebruikersnaam bestaat al.
                      </div>";
            }
        }
        ?>
        <h1>Registreren</h1>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" name="reg" class="needs-validation" novalidate>
                <small><span class='red'>*</span> = verplicht</small>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fullname">Naam <span class='red'>*</span></label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="" required>
                        <div class="valid-feedback">
                            Naam is ingevuld!
                        </div>
                        <div class="invalid-feedback">
                            Naam is niet ingevuld!
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="uname">Gebruikersnaam <span class='red'>*</span></label>
                        <input type="text" class="form-control" id="uname" name="uname" placeholder="" required>
                        <div class="valid-feedback">
                            Gebruikersnaam is ingevuld!
                        </div>
                        <div class="invalid-feedback">
                            Gebruikersnaam is niet ingevuld!
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="uemail">E-mail <span class='red'>*</span></label>
                        <input type="email" class="form-control" id="uemail" name="uemail" placeholder="" required>
                        <div class="valid-feedback">
                            E-mail is ingevuld!
                        </div>
                        <div class="invalid-feedback">
                            E-mail is niet ingevuld!
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="upass">Wachtwoord <span class='red'>*</span></label>
                        <input type="password" class="form-control" id="upass" name="upass" placeholder="" required>
                        <div class="valid-feedback">
                            Wachtwoord is ingevuld!
                        </div>
                        <div class="invalid-feedback">
                            Wachtwoord is niet ingevuld!
                        </div>
                    </div>
                </div>
                <input class="btn btn-primary" type="submit" name="submit" value="Registreren" onclick="return(submitreg());">
            </form>
            <br><br>
            <a href="login.php?pagename=Inloggen#login">   Al een account? Klik hier!</a>
        </div>
    </div>
</section>

<!-- FOOTER
================================================== -->
<?php include 'assets/elements/footer.php' ?>
<!-- JAVASCRIPT
================================================== -->
<?php include 'assets/elements/scripts.php' ?>

<script>
    function submitreg() {
        var form = document.reg;
        if (form.name.value == "") {
            alert("Vor naam in.");
            return false;
        } else if (form.uname.value == "") {
            alert("Voer gebruikersnaam in.");
            return false;
        } else if (form.upass.value == "") {
            alert("Voer wachtwoord in.");
            return false;
        } else if (form.uemail.value == "") {
            alert("Voer e-mail in.");
            return false;
        }
    }
</script>
</body>
</html>