<?php
    require_once('./class/Controller.php');
    require_once('./class/DynamicComponent.php');

    $logoBarObj = new DynamicComponent();

    $result = $logoBarObj->getLogoBar();

    if (is_array($result) || is_object($result)
    ) { 
        foreach ($result as $row) {
            echo '<link rel="icon" href="'.$row['logo_img'].'" type="image/ico" />';
        }
    }
?>
<link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">  
<link href="./assets/main/icofont/icofont.min.css" rel="stylesheet">
<link href="./assets/vendors/nprogress/nprogress.css" rel="stylesheet">
<link href="./assets/main/css/style.css" rel="stylesheet">
<link href="./assets/css/tailwind.css" rel="stylesheet">
<link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./assets/css/slideShow.css">

<link href="./assets/css/fontawesome.css" rel="stylesheet">
<script type="text/javascript" src="./assets/qr/adapter.min.js"></script>
<script type="text/javascript" src="./assets/qr/vue.min.js"></script> 
<script type="text/javascript" src="./assets/qr/instascan.min.js"></script>

<link rel="stylesheet" href="./assets/calendar/fullcalendar.css" />
<script type="text/javascript" src="./assets/calendar/jquery.min.js"></script>
<script type="text/javascript" src="./assets/calendar/jquery-ui.min.js"></script>
<script type="text/javascript" src="./assets/calendar/moment.min.js"></script>
<script type="text/javascript" src="./assets/calendar/fullcalendar.min.js"></script>