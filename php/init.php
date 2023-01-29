<?php 
    require_once('function.php');
    spl_autoload_register('autoLoader');

    function autoLoader($className) {
        $path = "class/";
        $extension = ".php";
        $filename = $path . $className . $extension;

        if (!file_exists($filename)
        ) {
            return false;
        }

        require_once($path . $className . $extension);
    }
?>