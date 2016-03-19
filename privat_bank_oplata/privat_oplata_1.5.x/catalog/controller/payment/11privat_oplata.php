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

        $id_shop = $this->config->get('privat_oplata_id_shop');
        $pass_shop = $this->config->get('privat_oplata_pass_shop');


        $order_info = $this->model_checkout_order->getOrder($order_id);

         $send_data=array( 'id_shop'=>$id_shop,
                          'pass_shop'=>$pass_shop,
                          'order_id'=>$order_id
                         );


       // $this->signature($send_data,$data_order,$order_id,$order_info);

        $this->answer_generate($send_data);
        $this->sendDataDeal($order_id,$data_order,$order_info,$id_shop);




    }


    

    public function  answer_generate($send_data){
        $this->load->model('checkout/order');
        $this->load->model('payment/privat_oplata');

        $merchantType="PP";
        $parts_cookie ="6";



        $signature = base64_encode(hex2bin(sha1($send_data['pass_shop'].
                                                $send_data['id_shop'].
                                                $send_data['order_id'].
                                                $merchantType.
                                              //  $send_data['message'].
                                                $send_data['pass_shop']))
                                    );
    return $signature;


    }


    //public function signature($send_data,$data_order,$order_id,$order_info){
    public function signature($requestArr){

        $partsCount = 6;
        $merchantType= "PP";

        $count = $this->data_order[0]['quantity'];
        $price = $this->data_order[0]['price'];
        $name = $this->data_order[0]['name'];

        $products_string = $name.$count.$price;


    $signatureStr=$this->send_data['pass_shop'].
                  $this->send_data['id_shop'].
                  $this->order_id.
                  $count.
                  $this->order_info['currency_code'].
                  $partsCount.
                  $merchantType.
                  $products_string.
                  $this->send_data['pass_shop'];




        $signature = base64_encode(hex2bin(SHA1($signatureStr)));

        return $signature;
    }


    в

    private function curlPost($url,$requestDial){
        try{

            $ch = curl_init($url);
            var_dump($url);
            var_dump($requestDial);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$requestDial);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array (
            'Accept: application/json',
            'Accept-Encoding: UTF-8',
            'Content-Type: application/json; charset=UTF-8'));
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response=curl_exec($ch);

            var_dump($response);






        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        $aInfo = @curl_getinfo($ch);

        curl_close($ch);

        if($curl_errno!=0){
            $this->log->write('PRIVATBANK_PAYMENTPARTS_PP :: CURL failed ' . $curl_error . '(' . $curl_errno . ')');
            return $this->language->get('error_curl');
        }
        if($aInfo['http_code']!='200'){
            $this->log->write('PRIVATBANK_PAYMENTPARTS_PP :: HTTP failed ' . $aInfo['http_code'] . '(' . $response . ')');
            return $this->language->get('error_curl');
        }

        return json_decode($response,true);

        }catch(Exception $e){
        return false;
        }
    }


    public function sendDataDeal($order_id,$data_order,$order_info,$id_shop){
        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if($order_info){
            $data_deal['storeId'] = $id_shop;
            $data_deal['orderId'] = "$order_id";
            $data_deal['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
            $data_deal['currency'] = $order_info['currency_code'];
            $data_deal['partsCount'] = "6";
            $data_deal['merchantType'] = 'PP';
            $data_deal['products'] = array(
                                            'name' => $data_order[0]['name'],
                                            'count' => $data_order[0]['quantity'],
                                            'price' => $this->currency->format($this->data_order[0]['price'], $order_info['currency_code'], $order_info['currency_value'], false)
                                           );
            $data_deal['responseUrl'] = $this->url->link('payment/privat_oplata/callback', '', 'SSL');
            $data_deal['redirectUrl'] = $this->url->link('checkout/checkout', '', 'SSL');
            $data_deal['signature'] = $this->signature($data_deal);

         }
        $requestDial = json_encode($data_deal);
        $url = 'https://payparts2.privatbank.ua/ipp/v2/payment/create';
        $responseResDeal = $this->curlPost($url,$requestDial);



        if(is_array($responseResDeal)){
            if(strcmp($responseResDeal['state'], 'FAIL') == 0){
                $this->log->write('PRIVATBANK_PAYMENTPARTS_PP :: DATA DEAL failed: ' . json_encode($responseResDeal));
            }
            echo  json_encode($responseResDeal);
        } else {
            echo json_encode(array('state'=>'sys_error','message'=>$responseResDeal));
        }

    }

    public function callback() {
    $requestPostRaw = file_get_contents('php://input');
    $requestArr = json_decode(trim($requestPostRaw),true);
    $this->load->model('checkout/order');


    $orderIdArr = explode('_',$requestArr['orderId']);
    $order_id = $orderIdArr[1];
    $comment = $requestArr['message'];
    $localAnswerSignature = $this->signature ($requestArr);
    $order_info = $this->model_checkout_order->getOrder($order_id);
        var_dump($requestArr['paymentState']);

    }


}
