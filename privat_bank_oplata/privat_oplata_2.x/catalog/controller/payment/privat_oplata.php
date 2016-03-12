<?php
class ControllerPaymentprivatoplata extends Controller {
	/**
     * Index action
     *
     * @return void
     */
    protected function index()
    {
        $this->load->model('checkout/order');
        $this->load->model('payment/privat_oplata');

        $order_id = $this->session->data['order_id'];

        $order_info = $this->model_checkout_order->getOrder($order_id);

        $description = 'Order #'.$order_id;

        $order_id .= '#'.time();
        $result_url = $this->url->link('checkout/success', '', 'SSL');
        $server_url = $this->url->link('payment/privat_oplata/server', '', 'SSL');

        $id_shop = $this->config->get('privat_oplata_id_shop');
        $pass_shop = $this->config->get('privat_oplata_pass_shop');
        $type = 'buy';
        $currency = $order_info['currency_code'];
        $currency = '980';
        $amount = $this->currency->format(
            $order_info['total'],
            $order_info['currency_code'],
            $order_info['currency_value'],
            false
        );
        $version  = '3';
        	

        $parts_cookie = $_COOKIE['cookie_select'];

        if ($parts_cookie != null){
        $parts_cookie = $_COOKIE['cookie_select'];
 		 }else{
 		  $parts_cookie ="6";

 		 }

 		 $merchantType="PP";

        //$language = $this->language->get('code');

        //$language = $language == 'ru' ? 'ru' : 'en';
        /*
        $pay_way  = $this->config->get('liqpay_pay_way');
        $language = $this->config->get('liqpay_language');
        */

      //  $count = $this->cart->countProducts();
        $data_order = $this->model_privat_oplata->order_product_privat_oplata($order_id);
        $count = $data_order['count'];
        $price = $data_order['price'];
        $name = $data_order['name'];


        $send_data = array('storeId'    => $id_shop,
        				          'orderId'     => $order_id,
                          'amount'      => $amount,
                          'currency'    => $currency,
                          'partsCount'  => $parts_cookie,
                          'merchantType'=> $merchantType,
                          'redirectUrl'  => $result_url,
                        // 'responseUrl'  => $server_url,
                          'products'=>array(
              							'name' => $name,
              							'count'=> $count,
              							'price'=> $price
              							)
                          );
                          
        $data = base64_encode(json_encode($send_data));
        $products_string = "";
        //узнать переменные  имя, количество и цены
        $products_string = $products_string.($name.$count.$price);

        $signature = base64_encode(hex2bin(sha1($pass_shop.$id_shop.$order_id.$amount.$currency.$parts_cookie.$merchantType.$result_url.$products_string.$pass_shop)));

        $this->data['action']         = $this->config->get('privat_oplata_action');
        $this->data['signature']      = $signature;
        $this->data['data']           = $data;
        $this->data['button_confirm'] = 'Оплатить';
        $this->data['url_confirm']    = $this->url->link('payment/privat_oplata/confirm');
        
        $this->template = $this->config->get('config_template').'/template/payment/privat_oplata.tpl';

        if (!file_exists(DIR_TEMPLATE.$this->template)) {
            $this->template = 'default/template/payment/privat_opata.tpl';
        }

        $this->render();
    }


    /**
     * Confirm action
     *
     * @return void
     */
    public function confirm()
    {
        $this->load->model('checkout/order'); echo $this->session->data['order_id'];
        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('config_order_status_id'), 'unpaid');
    }


    /**
     * Check and return posts data
     *
     * @return array
     */
    private function getPosts()
    {
        $success =
            isset($_POST['data']) &&
            isset($_POST['signature']);

        if ($success) {
            return array(
                $_POST['data'],
                $_POST['signature'],
            );
        }
        return array();
    }


    /**
     * get real order ID
     *
     * @return string
     */
    public function getRealOrderID($order_id)
    {
        $real_order_id = explode('#', $order_id);
        return $real_order_id[0];
    }


    /**
     * Server action
     *
     * @return void
     */
    public function server()
    {
        if (!$posts = $this->getPosts()) { die('Posts error'); }

        list(
            $data,
            $signature
        ) = $posts;
        
        if(!$data || !$signature) {die("No data or signature");}

        $parsed_data = json_decode(base64_decode($data), true);

        $id_shop  			     = $parsed_data['id_shop'];
        $order_id            = $parsed_data['order_id'];
        $status              = $parsed_data['status'];
        $sender_phone        = $parsed_data['sender_phone'];
        $amount              = $parsed_data['amount'];
        $currency            = $parsed_data['currency'];
        $transaction_id      = $parsed_data['transaction_id'];

        $real_order_id = $this->getRealOrderID($order_id);

        if ($real_order_id <= 0) { die("Order_id real_order_id < 0"); }

        $this->load->model('checkout/order');
        if (!$this->model_checkout_order->getOrder($real_order_id)) { die("Order_id fail");}

        $id_shop = $this->config->get('id_shop');
        $pass_shop  = $this->config->get('pass_shop');

        $signature = base64_encode(hex2bin(sha1($pass_shop.$id_shop.$order_id.$amount.$currency.$parts_cookie.$merchantType.$result_url.$products_string.$pass_shop)));

        if ($signature  != $generated_signature) { die("Signature secure fail"); }
        if ($id_shop != $id_shop) { die("id_shop secure fail"); }

        if ($status == 'success') {
            $this->model_checkout_order->update($real_order_id, $this->config->get('privat_oplata_order_status_id'),'paid');
        } else{
            $this->confirm();
        } 

       
    }
}
