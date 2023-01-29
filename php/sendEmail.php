<?php
    use PHPMailer\PHPMailer\PHPMailer;

    $name ='Information Kiosk System';
    $email = $_POST['email'];
    $subject = $data[1];
    $body = 'Hello ' 
    . $data[1] . ' '
    . $data[2] . ', '
    . $data[3] . ' '
    . 'Your pincode is '
    . $data[0];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    require_once "credential.php";

    $mail = new PHPMailer();

    //SMTP Settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL; //enter you email address
    $mail->Password = PASSWORD; //enter you email password
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress($email); //enter you email address
    $mail->Subject = ("$email ($subject)");
    $mail->Body = $body;

    if ($mail->send()) {
        echo json_encode(array(
            "message"  => "Email is sent!",
            "status"   => "success"
        ));
    } else {
        echo json_encode(array(
            "message" => "Something is wrong: ",
            "status"  => "error"
        ));
        $mail->ErrorInfo;
    }
    exit();
    
?>
