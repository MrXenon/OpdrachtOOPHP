<?php
include 'assets/model/Database.php';
include 'assets/model/classProduct.php';
$producten = new classProduct();
$product_list = $producten->getProductList();
$mobiel_list = $producten->getMobielList();
?>

<?php include 'assets/elements/head.php'?>

<!-- NAVBAR
================================================== -->
<?php include 'assets/elements/nav.php'?>

<!-- WELCOME
================================================== -->
<?php include 'assets/elements/welcome.php'?>

<!-- OVER NORCOM
================================================== -->
<?php include 'assets/elements/about.php'?>

<!-- Divider met logo -->
<div class="separator">
    <img class="seperator-logo" src="assets/img/logo-3d.png">
</div>

<!-- DISCOVER  DE STAPPEN
================================================== -->

<?php include 'assets/elements/stappen.php'?>

<br><br><br>
<!-- Divider met logo -->
<div class=separator>
    <img class="seperator-logo" src="assets/img/logo-3d.png">
</div>
<!-- PRIJZEN
================================================== -->

<?php include 'assets/elements/prijzen.php'?>

<br><br>
<!-- Divider met logo -->
<div class=separator>
    <img class="seperator-logo" src="assets/img/logo-3d.png">
</div>

<!-- DOELGROEPEN
================================================== -->

<?php include 'assets/elements/doelgroepen.php'?>

<!-- DOELGROEPEN
================================================== -->

<?php include 'assets/elements/gallery.php'?>

<!-- BESTELLING PLAATSEN
================================================== -->

<?php include 'assets/elements/offerte.php'?>


<!-- FOOTER
================================================== -->
<?php include 'assets/elements/footer.php'?>
<!-- JAVASCRIPT
================================================== -->
<?php include 'assets/elements/scripts.php'?>


</body>
</html>