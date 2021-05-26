<?php
session_start();
include 'assets/model/Database.php';
include_once 'assets/model/classUser.php';
$user = new User();

$error = '';
if (isset($_POST['submit'])) {
    extract($_POST);
    $login = $user->check_login($emailusername, $password);
    if ($login) {
        // Registration Success
        header("location:adminProductAanmaken.php?pagename=Product%20Aanmaken");
    } else {
        // Registration Failed
        $error = "<div class='alert alert-danger text-center' >
                        <strong>Inloggen mislukt</strong>, deze e-mail en gebruikersnaam combinatie bestaat niet.
                      </div>";
    }
}
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


<!-- INLOGGEN
================================================== -->

<section class="section menu-section" id="login"></section>
<section class="section section_menu section_border_bottom">
    <div id="container" class="container">
        <?= $error;
        ?>
        <h1>Inloggen</h1>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" name="login" class="needs-validation" novalidate>
                    <small><span class='red'>*</span> = verplicht</small>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="emailusername">Gebruikersnaam of e-mail <span class='red'>*</span></label>
                            <input type="text" class="form-control" id="emailusername" name="emailusername" placeholder="" required>
                            <div class="valid-feedback">
                                Gebruikersnaam of e-mail is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Gebruikersnaam of e-mail is niet ingevuld!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Wachtwoord <span class='red'>*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                            <div class="valid-feedback">
                                Wachtwoord is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Wachtwoord is niet ingevuld!
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" name="submit" value="Inoggen" onclick="return(submitlogin());">
                </form>
                <br><br>
                <a href="register.php?pagename=Registreren#register">   Nog geen account? Klik hier!</a>
            </div>
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
    function submitlogin() {
        var form = document.login;
        if (form.emailusername.value == "") {
            alert("Voer e-mail of gebruikersnaam in.");
            return false;
        } else if (form.password.value == "") {
            alert("Voer wachtwoord in.");
            return false;
        }
    }
</script>
</body>
</html>