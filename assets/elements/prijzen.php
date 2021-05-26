<section class="section menu-section" id="prijzen"></section>
<section class="section section_menu section_border_bottom">
    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Heading -->
                <h2 class="section__heading text-center">
                   Onze abonnementen
                </h2>
                <p class="section__subheading text-center">
                    Proin malesuada, nisl sit amet pretium dignissim, ipsum velit viverra justo, eu scelerisque ligula elit nec tortor.
                </p>

            </div>
        </div> <!-- / .row -->

        <div class="row">
            <?php
            // Voor elk $product_list hernoemt als $abonnement, voer de actie tussen de { } uit.
            foreach ($product_list as $abonnement){ ?>
                <div class="col-md-4 top">
                    <img class="img" src="<?= ''. $abonnement->getAfbeelding();?>">
                    <h3 class="text-center"><?= $abonnement->getAbonnement();?></h3>
                    <p class="text-center">
                        € <?= $abonnement->getPrijs();?>
                    </p>
                    <div class="center">
                        <a href="<?= 'product.php?&id='. $abonnement->getProductId().'&pagename=Producten';?>" class="button2">Meer informatie</a>
                    </div>
                </div>
           <?php } 
           ?>
        </div>
    </div> <!-- / .container -->
</section>