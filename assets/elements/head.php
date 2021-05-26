<!doctype html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/ico/logo-3d.png">
    <meta charset="utf-8">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/ico/logo-3d.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/logo-3d.png">
    <link rel="manifest" href="assets/ico/manifest.json">
    <link rel="mask-icon" href="assets/ico/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="assets/img/logo-3d.png">
    <meta name="msapplication-config" content="assets/ico/browserconfig.xml">
    <meta name="google-site-verification" content="zcN8Jr3o5nCjNgTm19XIqAbqnhnGYc38AmlHW7hWMfM" />
    <meta name="theme-color" content="#ffffff">
    <meta name="keywords" content="NORCOM, telecommunicatie, abonnementen">
    <meta name="description" content="NORCOM telecommunicatie website voor telefoon abonnementen">

    <?php
    // indexeert de pagina naam wanneer pagename defined is bij nav.
    if (!empty($_GET['pagename'])){
        // als de pagename gevonden is, koppel deze aan variabele $pagename.
        $pagename = $_GET['pagename'];
    }else{
        // als er geen pagename gevonden is, geef de pagename aan als Home.
        $pagename = 'Home';
    }
    // Vul de pagename bij de titel in
    ?>
    <title>NORCOM | <?= $pagename ?></title>
        
        

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/lightbox/css/lightbox.min.css">
    <link rel="stylesheet" href="assets/plugins/flickity/flickity.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- CSS Global -->
    <link rel="stylesheet" href="assets/css/theme.css">

</head>
<body>