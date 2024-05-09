<?php
require './lib/PHPMailer/src/Exception.php';
require './lib/PHPMailer/src/PHPMailer.php';
require './lib/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class BaseController
{
    protected $login__status;
    protected $login__user;
    public static $client = '/'; //sua dia chi client tai day, co dang /abc/def/
    public function __construct($param = "")
    {
        // setcookie("login__status", true, time() + 2147483647);
        if (empty($_SESSION['admin'])) {
            $this->View("Login");
            exit();
        }
    }
    public function Model($model)
    {
        require_once "./Models/$model.php";
        return new $model;
    }
    public function View($view, $data = [])
    {
        require_once "./Views/$view.php";
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

    public static function Base()
    {
        $root = str_replace('index.php', '', $_SERVER['PHP_SELF']);
        return "https://$_SERVER[SERVER_NAME]$root";
    }
    public static function Client()
    {
        return "https://$_SERVER[SERVER_NAME]" . static::$client;
    }
    public static function Detail()
    {
        return static::Client() . "Detail/";
    }
    public static function AbsolutePath()
    {
        return "$_SERVER[DOCUMENT_ROOT]/";
    }
    public function MoneyHandle($value = 0)
    { // add . in to thousand VND
        return number_format($value, 0, ',', '.') ?? false;
    }
    public function CPUHandle($value = 0)
    { // get chip ex:i3-4005u
        return preg_replace('/^(\w+\W+){2}/', '', $value) ?? false;
    }
    public function TitleHandle($value = 0, $type = 1)
    { // make whitespace to -
        if ($type)
            return preg_replace('/_+/', ' ', $value) ?? false;
        return preg_replace('/(\s+)/', '_', $value) ?? false;
    }
    public function PercentDiscount($a, $b)
    {
        return round((1 - ($a / $b)) * 100) ?? false;
    }
    public function Status($s)
    {
        $status = '';
        switch ($s) {
            case 0:
                $status = '<span class="badge bg-info">Chờ xử lý</span>';
                break;
            case 1:
                $status = '<span class="badge bg-warning">Đang vận chuyển</span>';
                break;
            case 2:
                $status = '<span class="badge bg-success">Đã hoàn thành</span>';
                break;
            case 200:
                $status = '<span class="badge bg-danger">Giao hàng thất bại</span>';
                break;
            case 100:
                $status = '<span class="badge bg-danger">Đã hủy	bởi người bán</span>';
                break;
            case -1:
                $status = '<span class="badge bg-danger">Đã hủy	bởi người dùng</span>';
                break;
        }
        return $status;
    }
    public function StatusProduct($number)
    {
        if ($number > 5)
            return '<span class="badge bg-success">Còn hàng</span>';
        else if ($number <= 5 && $number > 0)
            return '<span class="badge bg-warning">Sắp hết hàng</span>';
        else return '<span class="badge bg-danger">Hết hàng</span>';
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
