<?php
require './lib/PHPMailer/src/Exception.php';
require './lib/PHPMailer/src/PHPMailer.php';
require './lib/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Create an instance; passing `true` enables exceptions

class BaseController
{
    protected $login__status;
    protected $login__user;
    public function __construct($param = "")
    {
        $session = $_SESSION['login__status'] ?? false;
        // if ($empty_cookie) {
        //     setcookie("login__status", false, 0, '/', '', false, true);
        //     setcookie("login__user", "", 0, '/', '', false, true);
        // }
        // setcookie("login__status", true, time() + 2147483647);
        // $this->login__status = $_COOKIE["login__status"] ?? false;
        // if (!$this->login__status) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if ($session) {
            $data = $this->Model("Users")->Login($_SESSION['login__user']);
            $verify =  password_verify($_SESSION['login__pw'] ?? "", $data['password'] ?? "");
            $this->login__status = ($verify) ? true : false;
        } else {
            $token = date("Ymd") . time();
            if (empty($_SESSION['login__user'])) {

                // setcookie("login__status", false, 0, '/', '', false, true);
                // setcookie("login__user", $token, time() + 180 * 86400, '/', '', false, true);
                // header("Refresh: 0");
                $_SESSION["login__status"] = false;
                $_SESSION['login__user'] = $token;
            }
            // $_SESSION["login__status"] = false;
            // $_SESSION['login__user'] = $token;
            $this->login__status = false;
        }
        $this->login__user = $_SESSION['login__user'] ?? $token;
        $this->Model("Usages")->IUsage($this->login__user);
    }
    public function Model($model)
    {
        require_once "./Models/$model.php";
        return new $model;
    }
    public function View($view, $data = [])
    {
        require_once "./Views/Shared/Master.php";
        require_once "./Views/$view.php";
        require_once "./Views/Shared/Footer.php";
    }
    public static function Base()
    {
        $root = str_replace("index.php", '', $_SERVER['PHP_SELF']);
        return "https://$_SERVER[SERVER_NAME]$root";
    }
    public function MoneyHandle($value = 0)
    { // add . in to thousand VND
        return number_format($value, 0, ',', '.') ?? false;
    }
    public function CPUHandle($value = 0)
    { // get chip ex:i3-4005u
        return preg_replace('/^(\w+\W+){2}/', '', trim($value)) ?? false;
    }
    public function TitleHandle($value = 0, $type = 1)
    { // make whitespace to -
        if ($type)
            return preg_replace('/_+/', ' ', $value) ?? false;
        return preg_replace('/(\s+)/', '_', $value) ?? false;
    }
    public function sendmail($to, $subject = "Test", $content = "Thu nghiem", $altcontent = "")
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'lrng159@gmail.com';                     //SMTP username
            $mail->Password   = 'hukfqqcpknkyszip';                               //SMTP password
            $mail->CharSet = "UTF-8";
            $mail->Encoding = 'base64';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->setLanguage('vi', '.lib/PHPMailer/language/phpmailer.lang-vi.php');
            //Recipients
            $mail->setFrom($mail->Username, 'Long Laptop');
            $mail->addAddress($to);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $content;
            $mail->AltBody = $altcontent;

            $mail->send();
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; show error
            return false;
        }
    }
    public function PercentDiscount($a, $b)
    {
        return round((1 - ($a / $b)) * 100) ?? false;
    }
    public function Status($s)
    {
        $status = "<span style='font-weight: bold;font-style: italic;";
        switch ($s) {
            case 0:
                $status .= "color: #283a46;'>Đang chờ duyệt";
                break;
            case 1:
                $status .= "color: yellowgreen;'> Đang giao hàng";
                break;
            case 2:
                $status .= "color: green;'> Đã hoàn thành";
                break;
            case 200:
                $status .= "color: #580d3e;'> Giao hàng thất bại";
                break;
            case 100:
                $status .= "color: #580d3e;'> Đã hủy bởi người bán";
                break;
            case -1:
                $status .= "color: #d65443;'> Bạn đã hủy mặt hàng này";
                break;
        }
        return $status . "</span>";
    }

    public function VndText($amount)
    {
        if ($amount <= 0) {
            return $textnumber = "Tiền phải là số nguyên dương lớn hơn số 0";
        }
        $Text = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua = array("", "nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($amount);

        for ($i = 0; $i < $length; $i++)
            $unread[$i] = 0;

        for ($i = 0; $i < $length; $i++) {
            $so = substr($amount, $length - $i - 1, 1);

            if (($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)) {
                for ($j = $i + 1; $j < $length; $j++) {
                    $so1 = substr($amount, $length - $j - 1, 1);
                    if ($so1 != 0)
                        break;
                }

                if (intval(($j - $i) / 3) > 0) {
                    for ($k = $i; $k < intval(($j - $i) / 3) * 3 + $i; $k++)
                        $unread[$k] = 1;
                }
            }
        }

        for ($i = 0; $i < $length; $i++) {
            $so = substr($amount, $length - $i - 1, 1);
            if ($unread[$i] == 1)
                continue;

            if (($i % 3 == 0) && ($i > 0))
                $textnumber = $TextLuythua[$i / 3] . " " . $textnumber;

            if ($i % 3 == 2)
                $textnumber = 'trăm ' . $textnumber;

            if ($i % 3 == 1)
                $textnumber = 'mươi ' . $textnumber;


            $textnumber = $Text[$so] . " " . $textnumber;
        }

        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);

        return ucfirst($textnumber . " đồng");
    }
}
