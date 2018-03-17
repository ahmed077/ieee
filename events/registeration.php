<?php
ob_start();
session_start();
require_once('../vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
/*
 * Edit Success Page    : Line 58
 * Edit Mail Message    : Line 69
 * Edit Sending Email   : Line 74
 * Edit Email Subject   : Line 78
 * */
require_once '../includes/connect.php';
$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
$mobile = filter_var(intval($_POST['mobile']),FILTER_SANITIZE_NUMBER_INT);
$nationalid =filter_var($_POST['nationalid'],FILTER_SANITIZE_STRING);
$university = filter_var($_POST['university'],FILTER_SANITIZE_STRING);
$a_status = filter_var($_POST['a_status'],FILTER_SANITIZE_STRING);
$ieeemember = filter_var($_POST['ieeemember'],FILTER_SANITIZE_STRING);
$dateReg = date('Y-m-d',strtotime(filter_var($_POST['date'],FILTER_SANITIZE_STRING)));
$membershipID = filter_var($_POST['membership'], FILTER_SANITIZE_NUMBER_INT);

if ($con) {

    function generateSerial() {
        $chars = range('A','Z');
        $nums = range(0,9);
        $serial = $chars[array_rand($chars,1)] . $nums[array_rand($nums,1)] . $nums[array_rand($nums,1)] . $nums[array_rand($nums,1)];
        return $serial;
    }

    $national_query = "SELECT national_id FROM registeration WHERE national_id=?";
    $national_temp = $con->prepare($national_query);
    $national_temp->execute(array($nationalid));
        if($national_temp->rowCount() === 0){
            do {
                $code = generateSerial();
                $codeCheck = $con->prepare("SELECT id FROM `registeration` WHERE code=?");
                $codeCheck->execute(array($code));
            } while ($codeCheck->rowCount() > 0);

            $tempquery = "SELECT Number FROM codetemp WHERE Id=0";
            $temp = $con->prepare($tempquery);
            $temp->execute(array());
            $row = $temp->fetchAll(PDO::FETCH_ASSOC)[0];
            $tempid = $row['Number'];
            $exc = $con->prepare("INSERT INTO `registeration`(`name`, `email`, `mobile`, `national_id`, `university`, `a_status`, `ieee_member`, `code`,`date`,`membershipId`)  VALUES (?,?,?,?,?,?,?,?,?,?)");
            $exc->execute(array($name,$email,$mobile,$nationalid,$university,$a_status,$ieeemember,$code,$dateReg,$membershipID));
            if($exc->rowCount() > 0) {
                $msg = file_get_contents('../ieeemail.html');
                $mssg = str_replace("##NAME##", ucfirst($name),$msg);
                $message = str_replace("##CODE##", ucfirst($code),$mssg);
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Recipients
                    $mail->setFrom('no-reply@ieeepuasb.org');
                    $mail->addAddress($email);     // Add a recipient
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Mega Event Confirmation';
                    $mail->Body    = $message;
                    $mail->AltBody = $message;
                    $mail->send();
                    $request = "success";
                } catch (Exception $e) {
                    $request = "successEmailError";
                }
            } else {
            $request = "error";
        }
    } else {
        $request = "duplicated";
    }
    /*
     * success : full success
     * successEmailError : success but email failed to send
     * error : Error Registeration
     * duplicated : National ID exists
     * unavailable : Problem Connecting to server
     * */
} else {
    $request = "unavailable";
}
    $_SESSION['req']=$request;
    header("Location:MBB.php");
    exit();
} else {
    header("Location:MBB.php");
    exit();
}
ob_end_flush();
?>