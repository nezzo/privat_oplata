<?php
class ControllerPaymentprivatoplata extends Controller {
	/**
     * Index action
     *
     * @return void
     */
    public function index()
    {
        $this->load->model('checkout/order');
        $this->load->model('payment/privat_oplata');

        $order_id = $this->session->data['order_id'];
        $data_order = $this->model_payment_privat_oplata->order_product_privat_oplata($order_id);

        $data_deal = $this->signature($data_order);


        $order_info = $this->model_checkout_order->getOrder($order_id);
    }

    public function  answer_generate($data_answer){
        $this->load->model('checkout/order');
        $this->load->model('payment/privat_oplata');

        $merchantType="PP";
        $parts_cookie ="6";



        $signature = base64_encode(hex2bin(sha1($pass_shop.$id_shop.$order_id.$pass_shop)));


        /*
        $send_data = array(
            'storeId'    => $id_shop,
            'orderId'     => $order_id,
            'amount'      => $amount,
            //  'currency'    => $currency,
            'partsCount'  => "6", //количество частей на сколько делиться покупка
            'merchantType'=> "PP",//$merchantType,
            'redirectUrl'  => $result_url,
            // 'responseUrl'  => $server_url,
            'products'=>array(
                'name' => $name,
                'count'=> $count,
                'price'=> $price
            ),
            // "responseUrl"=> "http://shop.com/response", сюда отправиться результат сделки
            // "redirectUrl"=> "http://shop.com/redirect", сюда перекинет клиента после удачно совершенее сделки (или просто перекинет)
            "signature"=> $signature
        )
        */

    return $signature;


    }


    public function signature($data_order){
    $this->load->model('checkout/order');
    $this->load->model('payment/privat_oplata');
    $order_id = $this->session->data['order_id'];

        $partsCount = 6;
    $merchantType= "PP';

        $count = $data_order[0]['quantity'];
        $price = $data_order[0]['price'];
        $name = $data_order[0]['name'];

        $products_string = $name.$count.$price;


    $signatureStr=$pass_shop.
                  $id_shop.
                  $order_id.
                  $amount.
                  $order_info[currency_code].
                  $partsCount.
                  $merchantType.
                  $products_string.
                  $pass_shop;

        $signature = base64_encode(hex2bin(SHA1($signatureStr)));

        return $signature;
        }

        private function curlPost($url, $request){
        try{
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            'Accept: application/json',
            'Accept-Encoding: UTF-8',
            'Content-Type: application/json; charset=UTF-8'));

         $output=curl_exec($ch);


        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        $aInfo = @curl_getinfo($ch);

        curl_close($ch);

        if($curl_errno!=0){
            $this->log->write('PRIVATBANK_PAYMENTPARTS_PP :: CURL failed ' . $curl_error . '(' . $curl_errno . ')');
            return $this->language->get('error_curl');
        }
        if($aInfo[http_code]!='200'){
            $this->log->write('PRIVATBANK_PAYMENTPARTS_PP :: HTTP failed ' . $aInfo[http_code] . '(' . $response . ')');
            return $this->language->get('error_curl');
        }

        return json_decode($response,true);

        }catch(Exception $e){
        return false;
        }
    }


    public function sendDataDeal(){
    $this->load->model('checkout/order');
    $data_order = $this->model_payment_privat_oplata->order_product_privat_oplata($order_id);
    $products = array(
        'name'=>$data_order[0]['name'],
        'count'=>$data_order[0]['quantity'],
        'price'=>data_order[0]['price']);

    $requestDial = json_encode($products);
        $url = 'https://payparts2.privatbank.ua/ipp/v2/payment/create';

        $responseResDeal = $this->curlPost($url,$requestDial);


    }

    public function callback() {
    $requestPostRaw = file_get_contents('php://input');
    $requestArr = json_decode(trim($requestPostRaw),true);
    $this->load->model('checkout/order');
    $orderIdArr = explode('_',$requestArr[orderId]);
    $order_id = $orderIdArr[1];
        $comment = $requestArr[message];

    }


}
