<?php
class Payment extends BaseController
{
    //momo
    protected $partnerCode = 'MOMO_ATM_DEV';
    protected $accessKey = 'w9gEg8bjA2AM2Cvr';
    protected $secretKey = 'mD9QAVi4cm9N844jh5Y2tqjWaaJoGVFM';
    public function __construct($param = "")
    {
        if (method_exists($this, $param)) {
            $this->$param();
        } else $this->View("Error");
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    
    public function Momo()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (!empty($_POST['allOrderID']) && !empty($_POST['requestType']) && !empty($_POST['redirectUrl'])) {
            //1_2-2_2
            $amount = 0;
            $allOrderID = explode("-", $_POST['allOrderID']);
            foreach ($allOrderID as $split) {
                $eachID = explode("_", $split);
                if (count($eachID) != 2)
                    return false;
                $quantity = $eachID[1];
                $price = $this->Model("Products")->getProductDetailID($eachID[0])->fetch_assoc()['price_out'];
                $amount += $price * $quantity;
            }

            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

            $orderInfo = "Thanh toán qua MoMo - Website bán laptop và linh kiện máy tính";
            $orderId = time();
            $redirectUrl = $_POST['redirectUrl'];
            $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
            $extraData = "";


            $requestId = time();
            $requestType = $_POST['requestType'];
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $this->accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $this->partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $this->secretKey);
            $data = array(
                'partnerCode' => $this->partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there
            if ($jsonResult['resultCode'] != 0)
                echo "<script>alert('❌ $jsonResult[message] ❌')
               history.back()</script>
                ";
                
            else
                header('Location: ' . $jsonResult['payUrl']);
        }
    }
}
