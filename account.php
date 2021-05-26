<?php
session_start();
include 'assets/model/Database.php';
include_once 'assets/model/classUser.php';
$user = new User();

$uid = $_SESSION['uid'];

if (!$user->get_session()){
    header("location:login.php?pagename=Inloggen");
}

if (isset($_GET['q'])){
    $user->user_logout();
    header("location:login.php?pagename=Inloggen");
}

$page = basename(__FILE__);
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


<!-- UITLOGGEN & NAAM MELDING
================================================== -->
<section class="section section_menu section_border_bottom">
    <div id="container" class="container">
        <div id="header">
            <a href="<?=$page;?>?q=logout">Uitloggen </a> | <?php $user->get_fullname($uid); ?>
        </div>
    </div>
</section>

<section class="section section_menu section_border_bottom">
    <div class="container">
        <h2>Mijn account</h2>
        <table>
            <tr>
                <td>Volledige naam:</td>
                <td><?php $user->get_fullname($uid); ?></td>
            </tr>
            <tr>
                <td>Gebruikersnaam:</td>
                <td><?php $user->get_uname($uid); ?></td>
            </tr>
            <tr>
            <td>E-mail:</td>
            <td><?php $user->get_uemail($uid); ?></td>
            </tr>
        </table>
    </div>
</section>



<!-- FOOTER
================================================== -->
<?php include 'assets/elements/footer.php' ?>
<!-- JAVASCRIPT
================================================== -->
<?php include 'assets/elements/scripts.php' ?>

</body>
</html>