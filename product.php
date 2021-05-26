<?php
include 'assets/model/Database.php';
// Laad classProduct in
include 'assets/model/classProduct.php';
// maak $producten de nieuwe classProduct
$producten = new classProduct();
$product_list = $producten->getProductList();
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

<!-- SINGLE PRODUCT
================================================== -->
<section class="section menu-section" id="prijzen"></section>
<section class="section section_menu section_border_bottom">
    <div class="container">
        <div class="row">
            <?php
            //Haal het ID op
            $pageId = $_GET['id'];
            //Check of het id leeg is, zo ja toon alternatieve melding, zo niet toon product.
            if(!empty($pageId)){
            //Haal enkel product op, gebaseerd op ID
            $single_product = $producten->getProductById($pageId);

            // check of single product niet leeg is, zo ja, voer functie uit, zo niet voer error 1 uit.
            if(!empty($single_product)){
            foreach ($single_product as $abonnement){ ?>
                <div class=" col-md-12">
                    <img class="img center-image" src="<?= $abonnement->getAfbeelding();?>">
                    <h3 class="text-center"><?= $abonnement->getAbonnement();?></h3>
                    <table class="center table table-striped table-hover">
                        <tr>
                            <td>Internet snelheheid</td>
                            <td><?= $abonnement->getInternetSnelheid();?></td>
                        </tr>
                        <tr>
                            <td>gb Internet</td>
                            <td><?= $abonnement->getGbInternet();?></td>
                        </tr>
                        <tr>
                            <td>Sms</td>
                            <td><?= $abonnement->getSms();?></td>
                        </tr>
                        <tr>
                            <td>Extra Kosten</td>
                            <td><?= $abonnement->getExtraKosten();?></td>
                        </tr>
                        <tr>
                            <td>Prijs</td>
                            <td><?= $abonnement->getPrijs();?></td>
                        </tr>
                    </table>
                    <div class="center">
                        <a href="index.php#offerte" class="button2">Bestelling plaatsen</a>
                    </div>
                </div>
            <?php }
            }else{
                // Toon return error 1 in classProduct.php
            }
            }else{
                // Toon error wanneer product id 0 of niet gegeven is.
                echo '<div class="center col-md-12">
                <p class="alert  alert-danger" role="alert">Er zijn op dit moment geen producten aanwezig!</p></div>';
            } ?>
        </div>
    </div> <!-- / .container -->
</section>

<!-- FOOTER
================================================== -->
<?php include 'assets/elements/footer.php'?>
<!-- JAVASCRIPT
================================================== -->
<?php include 'assets/elements/scripts.php'?>


</body>
</html>
