<?php
/**
 * Create klasse
 */
class classProduct
{

    /*
     * Definieer alle values als private attributen
     * --------------------------------------------------------
     * START
     */
        private $id = "";
        private $abonnement = "";
        private $internetSnelheid = "";
        private $gb = "";
        private $belminuten = "";
        private $sms = "";
        private $kosten = "";
        private $prijs = "";
        private $afbeelding = "";
    /*
     * --------------------------------------------------------
     * END
     */

    /*--------------------------------------------------------
    GET TABLENAME START
    */

    /**
     * @return string getProductTableName (product)
     */
    private function getProductTableName(){
        return $table = 'product';
    }

    /**
     * @return string getMobielTableName(mobiele_telefoons)
     */
    private function getMobielTableName(){
        return $table = 'mobiele_telefoons';
    }

    /*--------------------------------------------------------
    GET TABLENAME END
    */


    /*--------------------------------------------------------
    GET POST VALUES START
     */
    /**
     * @return string getPostValues($post_check_array)
     */
    public function getPostValues(){

        // Definieer paramameter values check
        $post_check_array = array (
            // on submit actie
            'add' => array('filter' => FILTER_SANITIZE_STRING ),
            'update'   => array('filter' =>FILTER_SANITIZE_STRING ),
            'delete'  => array('filter' =>FILTER_SANITIZE_STRING ),
            // form velden + update form velden
            // abonnement
            'abonnement'   => array('filter' => FILTER_SANITIZE_STRING ),
            // internetsnelheid
            'internetsnelheid'   => array('filter' => FILTER_SANITIZE_STRING ),
            // gb
            'gb'   => array('filter' => FILTER_SANITIZE_STRING ),
            // belminuten
            'belminuten'   => array('filter' => FILTER_SANITIZE_STRING ),
            // belminuten
            'sms'   => array('filter' => FILTER_SANITIZE_STRING ),
            // kosten
            'kosten'   => array('filter' => FILTER_SANITIZE_STRING ),
            // prijs
            'prijs'   => array('filter' => FILTER_SANITIZE_STRING ),
            // afbeelding
            'afbeelding'   => array('filter' => FILTER_SANITIZE_STRING ),
            // Id of current row
            'id'    => array( 'filter'    => FILTER_VALIDATE_INT ),
        );
        // fiter de input:
        $inputs = filter_input_array( INPUT_POST, $post_check_array );
        // RTS (Return to sender) - stuurt de values terug
        return $inputs;
    }
    /*--------------------------------------------------------
    GET POSTVALUES END
     */


    /**
     * getGetValues :
     *  Filter input en haal GET parameters op
     *
     * @return array bevat GET input veld
     */
    public function getGetValues(){
        //Define parameter check
        $get_check_array = array (
            //Action
            'action' => array('filter' => FILTER_SANITIZE_STRING ),

            //Id van huidige rij
            'id' => array('filter' => FILTER_VALIDATE_INT ));

        //Get filtered input:
        $inputs = filter_input_array( INPUT_GET, $get_check_array );

        // RTS (Return to sender) - stuurt de values terug
        return $inputs;

    }

    /*--------------------------------------------------------
    FUNCTIONS PRODUCT START
    */

    /* SAVE START
     *  1. Try(Insert into) throw(Exception error) catch(Exception error -> Empty (zie 2))
     *  2. Wanneer empty, toon niks -> weergave = FALSE -> False toont false bericht op register.php
     *  3. Wanneer succesvol -> Toon True bericht op adminProductAanmaken.php
     *  4. Zie uitleg hieronder voor meer specifieke informatie.
     */
    public function save($input_array){
        try {
            //Check of gegeven values niet verstuurd zijn -> Throw (mist verplichte velden.)
            if (!isset($input_array['abonnement']) OR
                !isset($input_array['internetsnelheid'])OR
                !isset($input_array['gb'])OR
                !isset($input_array['belminuten'])OR
                !isset($input_array['sms'])OR
                !isset($input_array['kosten'])OR
                !isset($input_array['prijs'])OR
                !isset($input_array['afbeelding'])){
                // U mist verplichte velden
                throw new Exception("U mist verplichte velden");
            }
            // Check of de gegeven velden een waarde kleiner dan 1 hebben (0) -> Throw (Verplichte velden zijn leeg.)
            if ( (strlen($input_array['abonnement']) < 1) OR
                (strlen($input_array['internetsnelheid']) < 1) OR
                (strlen($input_array['gb']) < 1) OR
                (strlen($input_array['belminuten']) < 1) OR
                (strlen($input_array['sms']) < 1) OR
                (strlen($input_array['kosten']) < 1) OR
                (strlen($input_array['prijs']) < 1) OR
                (strlen($input_array['afbeelding']) < 1)){
                // Verplichte velden zijn leeg
                throw new Exception("Verplichte velden zijn leeg") ;
            }


            // Voeg de database connectie toe.
            $conn = Database::getConnection();

            // Insert query
            $conn->query("INSERT INTO `". $this->getProductTableName()."` ( 
            `abonnement`, `internetsnelheid`, `gbinternet`, `belminuten`,`sms`,`extrakosten`,`prijs`,`afbeelding`)".
                " VALUES ( '".$input_array['abonnement']."', '".$input_array['internetsnelheid']."','".$input_array['gb']."', '".$input_array['belminuten']. "',
              '".$input_array['sms']. "', '".$input_array['kosten']. "', '".$input_array['prijs']. "', '".$input_array['afbeelding']."');");

            // Indien een error, roept error gegevens op:
            if ( !empty($conn->last_error) ){
                $this->last_error = $conn->last_error;
                // Helaas, toon error bericht in register.php
                return FALSE;
            }
        } catch (Exception $exc) {
            // Roep exception melding aan (word hier niet gebruikt)
            // echo $this->$exc;
            // return FALSE
        }
        // Mooi, toon succes bericht in register.php
        return TRUE;
    }
    /*--------------------------------------------------------
     * SAVE END
     */

    /**
     * @return array GetProductList (List of product items)
     */
    public function getProductList(){

        // Call database = $global wpdb in wordpress
        $conn = Database::getConnection();

        $return_array = array();

        $query = "SELECT * FROM `".$this->getProductTableName()."` ORDER BY id";
        $result = $conn->query($query);

        // For all database results:
        foreach ($result as $idx => $array){
            // Nieuw object
            $product = new classProduct();
            // Set info
            $product->setProductId($array['id']);
            $product->setAbonnement($array['abonnement']);
            $product->setInternetSnelheid($array['internetsnelheid']);
            $product->setGbInternet($array['gbinternet']);
            $product->setBelminuten($array['belminuten']);
            $product->setSms($array['sms']);
            $product->setExtraKosten($array['extrakosten']);
            $product->setPrijs($array['prijs']);
            $product->setAfbeelding($array['afbeelding']);

            // Add new object to return array.
            $return_array[] = $product;
        }
        return $return_array;
    }

    /**
     * @param $pageId
     * @return array
     */
    public function getProductById($pageId) {

        // Call database = $global wpdb in wordpress
        $conn = Database::getConnection();

        $query = "SELECT * FROM `" . $this->getProductTableName() . "` WHERE id = ".$pageId.".";
        $result = $conn->query($query);
        //Setting var as an array
        //Database query
        // Loop through producten
        foreach ($result as $array) {
            // New object
            $product = new classProduct();
            // Set all info
            $product->setProductId($array['id']);
            $product->setAbonnement($array['abonnement']);
            $product->setInternetSnelheid($array['internetsnelheid']);
            $product->setGbInternet($array['gbinternet']);
            $product->setBelminuten($array['belminuten']);
            $product->setSms($array['sms']);
            $product->setExtraKosten($array['extrakosten']);
            $product->setPrijs($array['prijs']);
            $product->setAfbeelding($array['afbeelding']);

            // Add new object to return array.
            $return_array[] = $product;
        }
        // check of return array niet leeg is, zo ja, laad data. Zo niet, toon error 1.
        if (!empty($return_array)){
            // Return array
        return $return_array;
        }else{
            echo '<div class="center col-md-12">
                <p class="alert  alert-danger" role="alert">Het gegeven id bevat geen product informatie!</p></div>';
        }
    }



    /**
     *
     * @return int aantal producten in database
     */
    public function getNrOfProducten(){
        // Call database = $global wpdb in wordpress
        $conn = Database::getConnection();

        $query = "SELECT COUNT(*) AS nr FROM `". $this->getProductTableName()."`";
        $result = $conn->query( $query );
        $followingdata = $result->fetch_assoc();

        return $followingdata['nr'];
    }

    /**
     * geeft aan wat update en delete moeten doen.
     */
    public function handleGetAction( $get_array ){
        $action = '';

        switch($get_array['action']){
            case 'update':
                // Indicate current action is update if id provided
                if ( !is_null($get_array['id']) ){
                    $action = $get_array['action'];
                }
                break;

            case 'delete':
                // Delete current id if provided
                if ( !is_null($get_array['id']) ){
                    $this->delete($get_array);
                }
                $action = 'delete';
                break;

            default:
                // Oops
                break;
        }
        return $action;
    }


    /**
     * Functie die producten verwijderd
     */
    public function update($input_array){
        try {
                //Check of gegeven values niet verstuurd zijn -> Throw (mist verplichte velden.)
            if (!isset($input_array['abonnement']) OR
                !isset($input_array['internetsnelheid'])OR
                !isset($input_array['gb'])OR
                !isset($input_array['belminuten'])OR
                !isset($input_array['sms'])OR
                !isset($input_array['kosten'])OR
                !isset($input_array['prijs'])OR
                !isset($input_array['afbeelding'])){
                // U mist verplichte velden
                throw new Exception("U mist verplichte velden");
            }
            // Check of de gegeven velden een waarde kleiner dan 1 hebben (0) -> Throw (Verplichte velden zijn leeg.)
            if ( (strlen($input_array['abonnement']) < 1) OR
                (strlen($input_array['internetsnelheid']) < 1) OR
                (strlen($input_array['gb']) < 1) OR
                (strlen($input_array['belminuten']) < 1) OR
                (strlen($input_array['sms']) < 1) OR
                (strlen($input_array['kosten']) < 1) OR
                (strlen($input_array['prijs']) < 1) OR
                (strlen($input_array['afbeelding']) < 1)){
                // Verplichte velden zijn leeg
                throw new Exception("Verplichte velden zijn leeg") ;
            }

            // Call database = $global wpdb in wordpress
            $conn = Database::getConnection();
            // Update query
            //*

/**
 *          Voorbeeld waarden, zorg dat de input_array['value'] tussen '' staat, anders leest de MYSQL query de waarden niet correct.
 *          Pas deze query zo nodig aan om indien nodig jouw mysql te testen
 */
//            $conn->query("UPDATE `product` SET `abonnement` = 'Testje', `internetsnelheid` = '3G', `gbinternet` = '50 GB', `belminuten` = '100',
//            `sms` = '250', `extrakosten` = 'Nee', `prijs` = '500',
//            `afbeelding` = 'https://images.pexels.com/photos/1092644/pexels-photo-1092644.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'
//            WHERE `product`.`id` = 29;");

            $conn->query("UPDATE `".$this->getProductTableName()."` SET `abonnement` = '".$input_array['abonnement']."',
             `internetsnelheid` = '".$input_array['internetsnelheid']."', `gbinternet` = '".$input_array['gb']."', `belminuten` = '".$input_array['belminuten']."',
            `sms` = '".$input_array['sms']."', `extrakosten` = '".$input_array['kosten']."', `prijs` = '".$input_array['prijs']."',
            `afbeelding` = '".$input_array['afbeelding']."'
            WHERE `".$this->getProductTableName()."`.`id` = ".$input_array['id'].";");


            /**
             * Update Dump bestand, uncomment om te zien hoe de SQL eruit ziet.
             */

//            var_dump("UPDATE `".$this->getProductTableName()."` SET `abonnement` = '".$input_array['abonnement']."',
//             `internetsnelheid` = '".$input_array['internetsnelheid']."', `gbinternet` = '".$input_array['gb']."', `belminuten` = '".$input_array['belminuten']."',
//            `sms` = '".$input_array['sms']."', `extrakosten` = '".$input_array['kosten']."', `prijs` = '".$input_array['prijs']."',
//            `afbeelding` = '".$input_array['afbeelding']."'
//            WHERE `".$this->getProductTableName()."`.`id` = ".$input_array['id'].";");



            // Indien een error, roept error gegevens op:
            if ( !empty($conn->last_error) ){
                $this->last_error = $conn->last_error;
                // Helaas, toon error bericht in register.php
                return FALSE;
            }
        } catch (Exception $exc) {


        }
        return TRUE;
    }

    /**
     * Functie die de producten verwijderd
     */
    public function delete($input_array){
        try {
            // Check input id
            if (!isset($input_array['id']) ) throw new Exception(__("Missing mandatory fields") );

            // Call database = $global wpdb in wordpress
            $conn = Database::getConnection();

            $conn->query("DELETE  FROM `" . $this->getProductTableName() . "` WHERE id = ".$input_array['id'].".");

        } catch (Exception $exc) {
            return FALSE;
        }
        return TRUE;
    }

    /*--------------------------------------------------------
    FUNCTIONS PRODUCT END
    */


    /*--------------------------------------------------------
    FUNCTIONS MOBIEL START
    */
    /**
     * @return array getMobielList (List of mobiel items)
     */
    public function getMobielList(){

        // Call database = $global wpdb in wordpress
        $conn = Database::getConnection();

        $return_array = array();

        $query = "SELECT * FROM `".$this->getMobielTableName()."` ORDER BY mobiel_id";
        $result = $conn->query($query);

        // For all database results:
        foreach ($result as $idx => $array){
            // New object
            $mobiel = new classProduct();
            // Set all info
            $mobiel->setMobielId($array['mobiel_id']);
            $mobiel->setMobiel($array['mobiel']);
            
            // Add new object to return array.
            $return_array[] = $mobiel;
        }
        return $return_array;
    }

    /*--------------------------------------------------------
    FUNCTIONS MOBIEL END
    */

    /*--------------------------------------------------------
    Product tabel sets START
    */

    /**
     * @param Set $id
     */
    public function setProductId( $id ){
        if ( is_int(intval($id) ) ){
            $this->id = $id;
        }
    }


    /**
     * @param Set $abonnement
     */
    public function setAbonnement($abonnement ){
        if ( is_string( $abonnement )){
            $this->abonnement = trim($abonnement);
        }
    }

    /**
     * @param Set $internetSnelheid
     */
    public function setInternetsnelheid($internetSnelheid ){
        if ( is_string( $internetSnelheid )){
            $this->internetSnelheid = trim($internetSnelheid);
        }
    }

    /**
     * @param Set $gb
     */
    public function setGbInternet($gb ){
        if ( is_string( $gb )){
            $this->gb = trim($gb);
        }
    }

    /**
     * @param Set $belminuten
     */
    public function setBelminuten($belminuten ){
        if ( is_string( $belminuten )){
            $this->belminuten = trim($belminuten);
        }
    }

    /**
     * @param Set $sms
     */
    public function setSms($sms ){
        if ( is_string( $sms )){
            $this->sms = trim($sms);
        }
    }

    /**
     * @param Set $kosten
     */
    public function setExtraKosten($kosten ){
        if ( is_string( $kosten )){
            $this->kosten = trim($kosten);
        }
    }

    /**
     * @param Set $prijs
     */
    public function setPrijs($prijs ){
        if ( is_string( $prijs )){
            $this->prijs = trim($prijs);
        }
    }

    /**
     * @param Set $afbeelding
     */
    public function setAfbeelding($afbeelding ){
        if ( is_string( $afbeelding )){
            $this->afbeelding = trim($afbeelding);
        }
    }

    /*--------------------------------------------------------
    Product tabel sets END
    */

    /*--------------------------------------------------------
    Mobiel tabel sets START
    */
    /**
     * @param Set $id
     */
    public function setMobielId( $mobielId ){
        if ( is_int(intval($mobielId) ) ){
            $this->mobielId = $mobielId;
        }
    }

    /**
     * @param Set $mobiel
     */
    public function setMobiel($mobiel ){
        if ( is_string( $mobiel )){
            $this->mobiel = trim($mobiel);
        }
    }

    /*--------------------------------------------------------
    Mobiel tabel sets END
    */

    /*--------------------------------------------------------
    Product tabel gets START
    */

    /**
     * @return get ProductId
     */
    public function getProductId(){
        return $this->id;
    }

    /**
     * @return get Abonnement
     */
    public function getAbonnement(){
        return $this->abonnement;
    }

    /**
     * @return get InternetSnelheid
     */
    public function getInternetSnelheid(){
        return $this->internetSnelheid;
    }

    /**
     * @return get GbInternet
     */
    public function getGbInternet(){
        return $this->gb;
    }

    /**
     * @return get Belminuten
     */
    public function getBelminuten(){
        return $this->belminuten;
    }

    /**
     * @return get Sms
     */
    public function getSms(){
        return $this->sms;
    }

    /**
     * @return get ExtraKosten
     */
    public function getExtraKosten(){
        return $this->kosten;
    }

    /**
     * @return get Prijs
     */
    public function getPrijs(){
        return $this->prijs;
    }

    /**
     * @return get Afbeelding
     */
    public function getAfbeelding(){
        return $this->afbeelding;
    }


    /*--------------------------------------------------------
    Product tabel gets END
    */


    /*--------------------------------------------------------
    Mobiel tabel gets START
    */
     /**
     * @return get MobielId
     */
    public function getMobielId(){
        return $this->mobielId;
    }

    /**
     * @return get Mobiel
     */
    public function getMobiel(){
        return $this->mobiel;
    }
    /*--------------------------------------------------------
    Product tabel gets END
    */
}