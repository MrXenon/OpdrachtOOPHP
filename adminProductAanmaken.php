<?php
session_start();
include 'assets/model/Database.php';
// Include model:
include_once 'assets/model/classUser.php';
include_once "assets/model/classProduct.php";

// Declare class variable:
$user = new User();
$product = new classProduct();

$uid = $_SESSION['uid'];

if (!$user->get_session()){
    header("location:login.php?pagename=Inloggen");
}

if (isset($_GET['q'])){
    $user->user_logout();
    header("location:login.php?pagename=Inloggen");
}
$page = basename(__FILE__);

// Add params to base url
$base_url = $page;

// Get the GET data in filtered array
$get_array = $product->getGetValues();

// Keep track of current action.
$action = FALSE;
if (!empty($get_array)) {

    // Check actions
    if (isset($get_array['action'])) {
        $action = $product->handleGetAction($get_array);
    }
}

/* Na checken     */
// Get the POST data in filtered array
$post_array = $product->getPostValues();

// Collect Errors
$error = FALSE;
// Check the POST data
if (!empty($post_array['add'])) {

    // Check the add form:
    $add = FALSE;
    // Save event types
    $result = $product->save($post_array);
    if ($result) {
        // Save was succesfull
        $add = TRUE;
    } else {
        // Indicate error
        $error = TRUE;
    }
}

$Edelete = FALSE;
// Check the POST data
if (!empty($post_array['delete'])) {

    // Check the add form:
    $delete = FALSE;
    // Save event types
    $result = $product->delete($_POST['id']);
    if ($result) {
        // Save was succesfull
        $delete = TRUE;
    } else {
        // Indicate error
        $Edelete = TRUE;
    }
}
// Check the update form:
if (isset($post_array['update'])) {
    // Save event types
    $product->update($post_array);
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

<?php
// checkt of het gegeven uid 1 is, corespondeert met de standaard data -
// DEFAULT id 1 is admin met password 3dynamisch
if ($uid == '1'){?>
<!-- UITLOGGEN & NAAM MELDING
================================================== -->
<section class="section section_menu section_border_bottom">
    <div id="container" class="container">
        <div id="header">
            <a href="<?=$page;?>?q=logout">Uitloggen </a> | <?php $user->get_fullname($uid);?>
        </div>

    <h2>Abonnementen</h2>
    <a class="btn btn-primary" href="adminProductAanmaken.php?pagename=Overzicht#overzicht">Overzicht</a>
    <a class="btn btn-primary" href="adminProductAanmaken.php?pagename=Product%20Aanmaken#aanmaken">Product Aanmaken</a>
    <?php
    if (isset($add)) {
        echo($add ? '<div class="alert alert-success text-center">
                        <strong>Gelukt!</strong> Product is succesvol aangemaakt.</div>'
            :
            '<div class="alert text-center alert-danger">
                        <strong>Error!</strong> Product kon niet worden aangemaakt.
                        </div>');
    }

    if (isset($delete)) {
        echo($delete ? '<div class="alert alert-success text-center">
                        <strong>Gelukt!</strong> Product is succesvol verwijderd.</div>'
            :
            '<div class="alert text-center alert-danger">
                        <strong>Error!</strong> Product kon niet worden verwijderd.
                        </div>');
    }
    // Define file path
    // Edit file path  -- to actual file path
    $filepath = 'http://localhost/OpdrachtOOPHP/adminProductAanmaken.php?pagename=Overzicht';
    if($pagename == 'Overzicht'){
    ?>
    <table class="table table-striped table-hover" id="overzicht">
    <?php  if($action!='update'){?>
    <thead class="table-primary">
    <tr>
        <th width="10">PID</th>
        <th width="500">Abonnement</th>
        <th width="2000">Internetsnelheid</th>
        <th width="2000">Gb Internet</th>
        <th width="2000">Belminuten</th>
        <th width="2000">Sms</th>
        <th width="2000">Extra Kosten</th>
        <th width="2000">Prijs</th>
        <th width="2000">Afbeelding URL</th>
        <th colspan="2" width="200">Actions</th>
    </tr>
    </thead>
    <?php } ?>
        <br><br>
        <?php
        //*
        if ($product->getNrOfProducten() < 1) {
            ?>
            <tr>
                <td colspan="3">
                    <div class="alert text-center alert-danger">
                         Er zijn nog geen producten, start met deze aan te maken.
                    </div>
                </td>
            </tr>
        <?php } else {
            $product_list = $product->getProductList();


            //** Show all event types in the tabel
            foreach ($product_list as $product_obj) {

                // Add params to base url update link
                $upd_link =  $filepath . '&action=update&id='. $product_obj->getProductId();


                // Add params to base url delete link
                $del_link =  $filepath . '&action=delete&id='. $product_obj->getProductId();
                ?>
                    <?php
                    // If update and id match show update form
                    // Add hidden field id for id transfer
                    if (($action == 'update') && ($product_obj->getProductId() == $get_array['id'])) {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="<?=$base_url;?>" method="post" class="needs-validation" novalidate">
                                <small><span class='red'>*</span> = verplicht</small>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="hidden" id="id" name="id" value="<?= $product_obj->getProductId(); ?>">
                                        <label for="abonnement">Abonnement <span class='red'>*</span></label>
                                        <input type="text" class="form-control" id="abonnement" name="abonnement" value="<?=$product_obj->getAbonnement(); ?>"required>
                                        <div class="valid-feedback">
                                            Abonnement is ingevuld!
                                        </div>
                                        <div class="invalid-feedback">
                                            Abonnement is niet ingevuld!
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="internetsnelheid">Internetsnelheid <span class='red'>*</span></label>
                                        <select class="custom-select" name="internetsnelheid" required>
                                            <?php if($product_obj->getInternetsnelheid() == '2G'){
                                                $internetsnelheid1 ='selected ';
                                            }elseif($product_obj->getInternetsnelheid() == '3G'){
                                                $internetsnelheid2 ='selected ';
                                            }elseif($product_obj->getInternetsnelheid() == '4G'){
                                                $internetsnelheid3 ='selected ';
                                            }elseif($product_obj->getInternetsnelheid() == '5G'){
                                                $internetsnelheid4 ='selected ';
                                            }else{}
                                            ?>
                                            <option <?php if(!empty($internetsnelheid1)){echo $internetsnelheid1;} ?>
                                                    value="2G">2G</option>
                                            <option <?php if(!empty($internetsnelheid2)){echo $internetsnelheid2;} ?>
                                                    value="3G">3G</option>
                                            <option <?php if(!empty($internetsnelheid3)){echo $internetsnelheid3;} ?>
                                                    value="4G">4G</option>
                                            <option <?php if(!empty($internetsnelheid4)){echo $internetsnelheid4;} ?>
                                                    value="5G">5G</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Internetsnelheid is ingevuld!
                                        </div>
                                        <div class="invalid-feedback">
                                            Internetsnelheid is niet ingevuld!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="gb">Gb Internet <span class='red'>*</span></label>
                                        <select class="custom-select" name="gb" required>
                                            <?php if($product_obj->getGbInternet() == '5 GB'){
                                                $internet1 ='selected ';
                                            }elseif($product_obj->getGbInternet() == '50 GB'){
                                                $internet2 ='selected ';
                                            }elseif($product_obj->getGbInternet() == '100 GB'){
                                                $internet3 ='selected ';
                                            }elseif($product_obj->getGbInternet() == '250 GB'){
                                                $internet4 ='selected ';}
                                            elseif($product_obj->getGbInternet() == 'Onbeperkt'){
                                                $internet5 ='selected ';
                                            }else{}
                                            ?>
                                            <option <?php if(!empty($internet1)){echo $internet1;} ?>
                                                    value="5 GB">5 GB</option>
                                            <option <?php if(!empty($internet2)){echo $internet2;} ?>
                                                    value="50 GB">50 GB</option>
                                            <option <?php if(!empty($internet3)){echo $internet3;} ?>
                                                    value="100 GB">100 GB</option>
                                            <option <?php if(!empty($internet4)){echo $internet4;} ?>
                                                    value="250 GB">250 GB</option>
                                            <option <?php if(!empty($internet5)){echo $internet5;} ?>
                                                    value="Onbeperkt">Onbeperkt</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Gb Internet is ingevuld!
                                        </div>
                                        <div class="invalid-feedback">
                                            Gb Internet is niet ingevuld!
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="belminuten">Belminuten <span class='red'>*</span></label>
                                        <select class="custom-select" name="belminuten" required>
                                            <?php if($product_obj->getBelminuten() == '250'){
                                                $bel1 ='selected ';
                                            }elseif($product_obj->getBelminuten() == '500'){
                                                $bel2 ='selected ';
                                            }elseif($product_obj->getBelminuten() == 'Onbeperkt'){
                                                $bel3 ='selected ';
                                            }else{}
                                            ?>
                                            <option <?php if(!empty($bel1)){echo $bel1;} ?> value="250">250</option>
                                            <option <?php if(!empty($bel2)){echo $bel2;} ?> value="500">500</option>
                                            <option <?php if(!empty($bel3)){echo $bel3;} ?> value="Onbeperkt">Onbeperkt</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Belminuten is ingevuld!
                                        </div>
                                        <div class="invalid-feedback">
                                            Belminuten is niet ingevuld!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sms">Sms <span class='red'>*</span></label>
                                        <select class="custom-select" name="sms" required>
                                            <?php if($product_obj->getSms() == '100'){
                                                $sms1 ='selected ';
                                            }elseif($product_obj->getSms() == '200'){
                                                $sms2 ='selected ';
                                            }elseif($product_obj->getSms() == '250'){
                                                $sms3 ='selected ';
                                            }elseif($product_obj->getSms() == 'Onbeperkt'){
                                                $sms4 ='selected ';
                                            }else{}
                                            ?>
                                            <option <?php if(!empty($sms1)){echo $sms1;} ?>
                                                    value="100">100</option>
                                            <option <?php if(!empty($sms2)){echo $sms2;} ?>
                                                    value="200">200</option>
                                            <option <?php if(!empty($sms3)){echo $sms3;} ?>
                                                    value="250">250</option>
                                            <option <?php if(!empty($sms4)){echo $sms4;} ?>
                                                    value="Onbeperkt">Onbeperkt</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Sms is ingevuld!
                                        </div>
                                        <div class="invalid-feedback">
                                            Sms is niet ingevuld!
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kosten">Extra kosten <span class='red'>*</span></label>
                                        <select class="custom-select" name="kosten" required>
                                            <?php if($product_obj->getExtraKosten() == 'Ja'){
                                                $kosten ='selected';
                                            }else{
                                                $kosten ='';
                                            }
                                            ?>
                                            <option value="Nee">Nee</option>
                                            <option <?=$kosten;?> value="Ja">Ja</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Extra kosten is ingevuld!
                                        </div>
                                        <div class="invalid-feedback">
                                            Extra kosten is niet ingevuld!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="prijs">Prijs <span class='red'>*</span></label>
                                        <input type="number" class="form-control" step="0.01" lang="en-US" id="prijs" name="prijs" value="<?= $product_obj->getPrijs(); ?>" placeholder="€ 5.00" required>
                                        <div class="valid-feedback">
                                            Prijs is ingevuld!
                                        </div>
                                        <div class="invalid-feedback">
                                            Prijs is niet ingevuld!
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="afbeelding">Afbeelding link <span class='red'>*</span></label>
                                        <input type="text" class="form-control" id="afbeelding" name="afbeelding" value="<?= $product_obj->getAfbeelding(); ?>" placeholder="https://google.com/hallo.jpg" required>
                                        <div class="valid-feedback">
                                            Afbeelding is ingevuld!
                                        </div>
                                        <div class="invalid-feedback">
                                            Afbeelding is niet ingevuld!
                                        </div>
                                    </div>
                                </div>
                                <input class="btn btn-primary" type="submit" name="update" value="Update">
                                </form>
                                <br><br>
                            </div>
                        </div>
                        </div>
                        </section>

                        <tr>
                    <?php } else { ?>
                        <?php if ($action !== 'update') {
                            // If action is update don’t show the action button
                            ?>
                            <td width="10"><?= $product_obj->getProductId(); ?></td>
                            <td width="180"><?=$product_obj->getAbonnement(); ?></td>
                            <td width="200"><?=$product_obj->getInternetsnelheid(); ?></td>
                            <td width="200"><?=$product_obj->getGbInternet(); ?></td>
                            <td width="200"><?=$product_obj->getBelminuten(); ?></td>
                            <td width="200"><?=$product_obj->getSms(); ?></td>
                            <td width="200"><?=$product_obj->getExtraKosten(); ?></td>
                            <td width="200"><?=$product_obj->getPrijs(); ?></td>
                            <td width="200"><?=$product_obj->getAfbeelding(); ?></td>
                            <td><a  class="btn btn-success" name="update" href="<?= $upd_link; ?>">Update</a></td> <!--TODO: Check of name="update" in de cursus staat-->
                            <td><a class="btn btn-danger" name="delete" href="<?= $del_link; ?>">Delete</a></td>
                            <?php
                        } // if action !== update
                        ?>
                    <?php } // if acton !== update ?>
                </tr>
                <?php
            }
            ?>


        <?php } }else {
        ?>
        </table>
        <?php
        // Check if action = update : then end update form
        echo(($action == 'update') ? '</form>' : '');

        if ($action !== 'update') {
            ?>
            <div class="row" id="aanmaken">
                <div class="col-md-12">
                    <form action="<?= $base_url; ?>" method="post" class="needs-validation" novalidate
                    ">
                    <small><span class='red'>*</span> = verplicht</small>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="abonnement">Abonnement <span class='red'>*</span></label>
                            <input type="text" class="form-control" id="abonnement" name="abonnement" placeholder=""
                                   required>
                            <div class="valid-feedback">
                                Abonnement is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Abonnement is niet ingevuld!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="internetsnelheid">Internetsnelheid <span class='red'>*</span></label>
                            <select class="custom-select" name="internetsnelheid" required>
                                <option value="2G">2G</option>
                                <option value="3G">3G</option>
                                <option value="4G">4G</option>
                                <option value="5G">5G</option>
                            </select>
                            <div class="valid-feedback">
                                Internetsnelheid is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Internetsnelheid is niet ingevuld!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="gb">Gb Internet <span class='red'>*</span></label>
                            <select class="custom-select" name="gb" required>
                                <option value="5 GB">5 GB</option>
                                <option value="50 GB">50 GB</option>
                                <option value="100 GB">100 GB</option>
                                <option value="250 GB">250 GB</option>
                                <option value="Onbeperkt">Onbeperkt</option>
                            </select>
                            <div class="valid-feedback">
                                Gb Internet is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Gb Internet is niet ingevuld!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="belminuten">Belminuten <span class='red'>*</span></label>
                            <select class="custom-select" name="belminuten" required>
                                <option value="250">250</option>
                                <option value="500">500</option>
                                <option value="Onbeperkt">Onbeperkt</option>
                            </select>
                            <div class="valid-feedback">
                                Belminuten is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Belminuten is niet ingevuld!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sms">Sms <span class='red'>*</span></label>
                            <select class="custom-select" name="sms" required>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="Onbeperkt">Onbeperkt</option>
                            </select>
                            <div class="valid-feedback">
                                Sms is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Sms is niet ingevuld!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kosten">Extra kosten <span class='red'>*</span></label>
                            <select class="custom-select" name="kosten" required>
                                <option value="Nee">Nee</option>
                                <option value="Ja">Ja</option>
                            </select>
                            <div class="valid-feedback">
                                Extra kosten is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Extra kosten is niet ingevuld!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="prijs">Prijs <span class='red'>*</span></label>
                            <input type="number" class="form-control" step="0.01" lang="en-US" id="prijs" name="prijs"
                                   placeholder="€ 5.00" required>
                            <div class="valid-feedback">
                                Prijs is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Prijs is niet ingevuld!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="afbeelding">Afbeelding link <span class='red'>*</span></label>
                            <input type="text" class="form-control" id="afbeelding" name="afbeelding"
                                   placeholder="https://google.com/hallo.jpg" required>
                            <div class="valid-feedback">
                                Afbeelding is ingevuld!
                            </div>
                            <div class="invalid-feedback">
                                Afbeelding is niet ingevuld!
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" name="add" value="Aanmaken">
                    </form>
                    <br><br>
                </div>
            </div>
            </div>
            </section>
            <?php
        } // if action !== update
    }
        }else{?>
    <section class="section section_menu section_border_bottom">
        <div id="container" class="container">
            <div id="header">
               <p class="alert alert-danger">U bent niet gemachtigd om deze pagina in te zien!</p>
            </div>
        </div>
    </section>
<?php }

if ($pagename=='Overzicht'){}else{?>



<!-- FOOTER
================================================== -->
<?php include 'assets/elements/footer.php' ?>

<?php } ?>
<!-- JAVASCRIPT
================================================== -->
<?php include 'assets/elements/scripts.php' ?>

</body>
</html>