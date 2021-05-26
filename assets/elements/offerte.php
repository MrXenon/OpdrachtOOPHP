<section class="section menu-section" id="offerte"></section>
<!--</section>-->
<section class="section section_gray section_newsletter&testimonials">
    <div class="row">
        <div class="col-md-6">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <!-- Heading -->
                        <h2 class="section__heading section_newsletter__heading text-center">
                            Bestelling plaatsen
                        </h2>
                        <p class="section__subheading text-center">
                            In aliquam sem ut lorem accumsan accumsan quis sed mi.
                        </p>
                    </div>
                </div> <!-- / .row -->
                <div class="row justify-content-center">

                    <div class="col-lg-8">
                        <!-- HTML e-mail formulier -->

                        <?php
                        /*         * *****************************
                         *        CONTACT FORMULIER
                         *                                                             *
                         *        Author: Kevin Schuit        *
                         *        Datum: 10 september 2010     *
                         *                                                             *
                         *        Pas het e-mail adres aan     *
                         *        bij $mail_ontv en upload   *
                         *        het naar je webserver..         *
                         * ****************************** */

                        $recipients = array("info@tele4.media-portfolios.nl"); // <<<----- voer jouw e-mailadres hier in!

                        // E-mailadres van de ontvanger
                        $mail_ontv = implode(',', $recipients);
                        // Speciale checks voor naam en e-mailadres
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // voornaam controle
                            if (empty($_POST['voornaam']))
                                $voornaam_fout = 1;
                            // achternaam controle
                            if (empty($_POST['achternaam']))
                                $achternaam_fout = 1;
                            // tel controle
                            if (empty($_POST['tel']))
                                $tel_fout = 1;
                            // abonnement controle
                            if (empty($_POST['abonnement']))
                                $abonnement_fout = 1;
                            // mobiel controle
                            if (empty($_POST['mobiel']))
                            $mobiel_fout = 1;
                            // e-mail controle
                            if (function_exists('filter_var') && !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
                                $email_fout = 1;
                            // antiflood controle
                            if (!empty($_SESSION['antiflood'])) {
                                $seconde = 20; // 20 seconden voordat dezelfde persoon nog een keer een e-mail mag versturen
                                $tijd = time() - $_SESSION['antiflood'];
                                if ($tijd < $seconde)
                                    $antiflood = 1;
                            }
                        }

                        // Kijk of alle velden zijn ingevuld - naam mag alleen uit letters bestaan en het e-mailadres moet juist zijn
                        if (($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($antiflood) || empty($_POST['voornaam']) || !empty($voornaam_fout) || empty($_POST['achternaam']) || !empty($achternaam_fout) || empty($_POST['tel']) || !empty($tel_fout) || empty($_POST['abonnement']) || !empty($abonnement_fout) || empty($_POST['mobiel']) || !empty($mobiel_fout) || empty($_POST['mail']) || !empty($email_fout) ||  empty($_POST['onderwerp']))) || $_SERVER['REQUEST_METHOD'] == 'GET') {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if (!empty($voornaam_fout))
                                    echo '<p class="alert alert-danger" role="alert">Uw voornaam is niet ingevuld.</p>';
                                elseif (!empty($achternaam_fout))
                                    echo '<p class="alert alert-danger" role="alert">Uw achternaam is niet ingevuld.</p>';
                                elseif (!empty($tel_fout))
                                    echo '<p class="alert alert-danger" role="alert">Uw telefoonnummer is niet ingevuld.</p>';
                                elseif (!empty($abonnement_fout))
                                    echo '<p class="alert alert-danger" role="alert">Uw abonnement is niet ingevuld.</p>';
                                elseif (!empty($mobiel_fout))
                                    echo '<p class="alert alert-danger" role="alert">Uw mobiel is niet ingevuld.</p>';
                                elseif (!empty($email_fout))
                                    echo '<p class="alert alert-danger" role="alert">Uw e-mailadres is niet juist ingevuld.</p>';
                                elseif (!empty($antiflood))
                                    echo '<p class="alert alert-danger" role="alert">U mag slechts &eacute;&eacute;n bericht per ' . $seconde . ' seconde versturen.</p>';
                                else
                                    echo '<p class="alert alert-danger" role="alert">U bent uw naam, e-mailadres, onderwerp of bericht vergeten in te vullen.</p>';
                            }

                            // HTML e-mail formlier
                            echo '<form id="contact" method="post" action="' . $_SERVER['REQUEST_URI'] . '" enctype="multipart/form-data"/>';
                            echo '<div class="form-inline">';
                            echo '<input type="text" class="form-control half" id="voornaam" name="voornaam" placeholder="Voornaam" value="' . (isset($_POST['voornaam']) ? htmlspecialchars($_POST['voornaam']) : '') . '" /><br />';
                            echo '<input type="text" class="form-control half" id="achternaam" name="achternaam" placeholder="Achternaam"  value="' . (isset($_POST['achternaam']) ? htmlspecialchars($_POST['achternaam']) : '') . '" /><br />';
                            echo '</div>';
                            echo '<div class="form-inline">';
                            echo '<input type="text" class="form-control half" id="mail" name="mail" placeholder="E-mail"  value="' . (isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '') . '" /><br />';
                            echo '<input type="text" class="form-control half" id="tel" name="tel" placeholder="Telefoonnummer"  value="' . (isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '') . '" /><br />';
                            echo '</div>';
                            echo '<div class="form-inline">';
                            echo '<select name="abonnement" class="form-control half" required>';
                                foreach($product_list as $product_obj){
                                    echo '<option value="'.$product_obj->getAbonnement().'">'.$product_obj->getAbonnement().'</option>';
                                }
                            echo '</select>';
                            echo '<select name="mobiel" class="form-control half" required>';
                                foreach($mobiel_list as $mobiel_obj){
                                    echo '<option value="'.$mobiel_obj->getMobiel().'">'.$mobiel_obj->getMobiel().'</option>';
                                }
                            echo '</select>';
                            echo '<input type="hidden" class="form-control half" id="onderwerp" name="onderwerp" placeholder="Onderwerp" value="Nieuw abonnement aanvraag" /><br />';
                            echo '</div>';
                            echo '<input class="button button1" type="submit" name="submit" value=" Bestellen " />';
                            echo'</form>';
                        } // versturen naar
                        else {

                            // set datum
                            $datum = date('d/m/Y H:i:s');


                            $inhoud_mail .= "Naam: " . htmlspecialchars($_POST['voornaam']) .' '. htmlspecialchars($_POST['achternaam']) . "\n";
                            $inhoud_mail .= "Telefoonnummer: " . htmlspecialchars($_POST['tel']) . "\n";
                            $inhoud_mail .= "E-mail adres: " . htmlspecialchars($_POST['mail']) . "\n";
                            $inhoud_mail .= "Gekozen abonnement: " . htmlspecialchars($_POST['abonnement']) . "\n";
                            $inhoud_mail .= "Gekozen telefoon: " . htmlspecialchars($_POST['mobiel']) . "\n";


                            // --------------------
                            // spambot protectie
                            // ------
                            // van de tutorial: http://www.phphulp.nl/php/tutorial/beveiliging/spam-vrije-contact-formulieren/340/
                            // ------

                            $headers = 'From: ' . htmlspecialchars($_POST['voornaam']) .' '. htmlspecialchars($_POST['achternaam']) . ' <' . $_POST['mail'] . '>';

                            $headers = stripslashes($headers);
                            $headers = str_replace('\n', '', $headers); // Verwijder \n
                            $headers = str_replace('\r', '', $headers); // Verwijder \r
                            $headers = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $headers)); // Slashes van quotes

                            $_POST['onderwerp'] = str_replace('\n', '', $_POST['onderwerp']); // Verwijder \n
                            $_POST['onderwerp'] = str_replace('\r', '', $_POST['onderwerp']); // Verwijder \r
                            $_POST['onderwerp'] = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $_POST['onderwerp'])); // Slashes van quotes

                            if (mail($mail_ontv, $_POST['onderwerp'], $inhoud_mail, $headers)) {
                                // zorg ervoor dat dezelfde persoon niet kan spammen
                                $_SESSION['antiflood'] = time();

                                echo '<script> alert("Uw offerte aanvraag is succesvol verzonden, er zal zo spoedig mogelijk contact met u worden opgenomen.")</script>
                                    <script>window.location.href = "index.php#offerte";</script>';
                            } else {
                                echo '<h1>Verzending mislukt</h1>

                          <p><b>Onze excuses.</b> Het contactformulier kon niet verzonden worden.</p>';
                            }
                        }
                        ?>

                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div>
        <!-- -------------Volgende colum--------------------- -->
        <div class="col-md-6">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <!-- Heading -->
                        <h2 class="section__heading text-center">
                            Testimonials
                        </h2>

                        <!-- Subheading -->
                    </div>
                </div> <!-- / .row -->
                <div class="row">
                    <div class="col">
                        <div class="section_testimonials__carousel">
                            <div class="section_testimonials__carousel__item text-center text-md-left">
                                <div class="row align-items-center">
                                    <div class="col-md-3 order-md-3">

                                        <!-- Photo -->
                                        <div class="section_testimonials__photo">
                                            <img src="assets/img/logo-3d.png" class="img-fluid" alt="...">
                                        </div>

                                    </div>
                                    <div class="col-md-7 order-md-2">

                                        <!-- Blockquote -->
                                        <blockquote class="section_testimonials__blockquote mx-auto">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor aliquet nunc eget pretium. Vestibulum ac bibendum nibh.
                                                Sed lobortis volutpat egestas. Aliquam euismod eros ut sapien posuere fringilla.
                                                Sed tincidunt nibh at neque hendrerit elementum. Pellentesque dolor diam, dapibus id eros tempus, feugiat molestie sem.
                                            </p>
                                            <footer class="text-muted">
                                               Grisham Hölnfjördsen - 3DYNAMISCH
                                            </footer>
                                        </blockquote>

                                    </div>
                                    <div class="col-md-1 order-md-1"></div>
                                </div> <!-- / .row -->
                            </div>
                            <div class="section_testimonials__carousel__item text-center text-md-left">
                                <div class="row align-items-center">
                                    <div class="col-md-3 order-md-3">

                                        <!-- Photo -->
                                        <div class="section_testimonials__photo">
                                            <img src="assets/img/logo-3d.png" class="img-fluid" alt="...">
                                        </div>

                                    </div>
                                    <div class="col-md-7 order-md-2">

                                        <!-- Blockquote -->
                                        <blockquote class="section_testimonials__blockquote mx-auto">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor aliquet nunc eget pretium. Vestibulum ac bibendum nibh.
                                                Sed lobortis volutpat egestas. Aliquam euismod eros ut sapien posuere fringilla.
                                                Sed tincidunt nibh at neque hendrerit elementum. Pellentesque dolor diam, dapibus id eros tempus, feugiat molestie sem.
                                            </p>
                                            <footer class="text-muted">
                                               Kevin Schuit - 3DYNAMISCH
                                            </footer>
                                        </blockquote>

                                    </div>
                                    <div class="col-md-1 order-md-1"></div>
                                </div> <!-- / .row -->
                            </div>
                        </div> <!-- / .carousel -->
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div>
    </div>
</section>