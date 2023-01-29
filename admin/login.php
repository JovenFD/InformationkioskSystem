<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Form</title>
    <?php
        require_once('../class/Controller.php');
        require_once('../class/DynamicComponent.php');

        $logoBarObj = new DynamicComponent();

        $result = $logoBarObj->getLogoBar();

        if (is_array($result) || is_object($result)
        ) { 
            foreach ($result as $row) {
                echo '<link rel="icon" href=".'.$row['logo_img'].'" type="image/ico" />';
            }
        }
    ?>
    <link href="../assets/css/fontawesome.css" rel="stylesheet">
    <link href="../assets/css/tailwind.css" rel="stylesheet">
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-gray-300">
        <div class="container relative h-screen flex justify-center items-center">
        <div class="bg-white max-w-sm pb-10 rounded-3xl bg-white border-gray-400 border-2 p-9 -top-60">
        <div class="relative mx-auto w-32 h-32 rounded-full border-gray-400 border-1 -top-24">
        <img class="w-full h-full rounded-full" id="Flogo"/>
        </div>
        <div id="msg"></div>
        <form id="loginForm">
        <input name="username" aria-label="username" type="text" class="text-center h-12 rounded-xl w-full mb-8 border-gray-500 border-2" placeholder="Email" autofocus>

        <div class="relative"> 
            <input type="password" name="password" autocomplete="current-password" placeholder="Password" id="password" class="h-12 mb-8 rounded-xl text-center w-full border-gray-500 border-2">
            <div class="absolute top-3 right-3"> 
            <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="togglePassword"></i> 
        </div>

        <input type="submit" id="login" class="h-12 w-full hover:border-gray-600 hover:bg-gray-100 hover:text-gray-600 tracking-wide text-lg text-white bg-gray-400 px-9 py-2 rounded-3xl border-gray-500 border-2" value="LOGIN" />
        </form>
        </div>
        </div>
    </div>

    <script src="../assets/js/loginForm.js"></script>
    <script src="../assets/dynamic/adminLogo.js"></script>
</body>
</html>