<?php 
class ControllerPaymentprivatoplata extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->load->language('payment/privat_oplata');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('privat_oplata', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_buy'] = $this->language->get('text_buy');
		$this->data['text_donate'] = $this->language->get('text_donate');
		$this->data['entry_id_shop'] = $this->language->get('entry_id_shop');
		$this->data['entry_pass_shop'] = $this->language->get('entry_pass_shop'); //пароль и ид шопа тут точно не уверен
		$this->data['entry_action'] = $this->language->get('entry_action');
		$this->data['entry_type'] = $this->language->get('entry_type');
		$this->data['entry_total'] = $this->language->get('entry_total');
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_pay_way'] = $this->language->get('entry_pay_way');
		$this->data['entry_language'] = $this->language->get('entry_language');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['id_shop'])) {
			$this->data['error_id_shop'] = $this->error['id_shop'];
		} else {
			$this->data['error_id_shop'] = '';
		}
		if (isset($this->error['pass_shop'])) {
			$this->data['error_pass_shop'] = $this->error['pass_shop'];
		} else {
			$this->data['error_pass_shop'] = '';
		}

		if (isset($this->error['action'])) {
			$this->data['error_action'] = $this->error['action'];
		} else {
			$this->data['error_action'] = '';
		}

        $this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/privat_oplata', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('payment/privat_oplata', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');	
		
		if (isset($this->request->post['privat_oplata_id_shop'])) {
			$this->data['privat_oplata_id_shop'] = $this->request->post['privat_oplata_id_shop'];
		} else {
			$this->data['privat_oplata_id_shop'] = $this->config->get('privat_oplata_id_shop'); 
		}

		if (isset($this->request->post['privat_oplata_pass_shop'])) {
			$this->data['privat_oplata_pass_shop'] = $this->request->post['privat_oplata_pass_shop'];
		} else {
			$this->data['privat_oplata_pass_shop'] = $this->config->get('privat_oplata_pass_shop');
		}

		if (isset($this->request->post['privat_oplata_action'])) {
			$this->data['privat_oplata_action'] = $this->request->post['privat_oplata_action'];
		} else {
			$this->data['privat_oplata_action'] = $this->config->get('privat_oplata_action');
			if (empty($this->data['privat_oplata_action'])) {
				$this->data['privat_oplata_action'] = 'https://payparts2.privatbank.ua/ipp/v2/payment/create';
			}
		}

        if (isset($this->request->post['privat_oplata_total'])) {
			$this->data['privat_oplata_total'] = $this->request->post['privat_oplata_total'];
		} else {
			$this->data['privat_oplata_total'] = $this->config->get('privat_oplata_total');
		}

 		if (isset($this->request->post['privat_oplata_order_status_id'])) {
			$this->data['privat_oplata_order_status_id'] = $this->request->post['privat_oplata_order_status_id'];
		} else {
			$this->data['privat_oplata_order_status_id'] = $this->config->get('privat_oplata_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['privat_oplata_geo_zone_id'])) {
			$this->data['privat_oplata_geo_zone_id'] = $this->request->post['privat_oplata_geo_zone_id'];
		} else {
			$this->data['privat_oplata_geo_zone_id'] = $this->config->get('privat_oplata_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');						
		
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['privat_oplata_status'])) {
			$this->data['privat_oplata_status'] = $this->request->post['privat_oplata_status'];
		} else {
			$this->data['privat_oplata_status'] = $this->config->get('privat_oplata_status');
		}
		
		if (isset($this->request->post['privat_oplata_sort_order'])) {
			$this->data['privat_oplata_sort_order'] = $this->request->post['privat_oplata_sort_order'];
		} else {
			$this->data['privat_oplata_sort_order'] = $this->config->get('privat_oplata_sort_order');
		}

		if (isset($this->request->post['privat_oplata_pay_way'])) {
			$this->data['privat_oplata_pay_way'] = $this->request->post['privat_oplata_pay_way'];
		} else {
			$this->data['privat_oplata_pay_way'] = $this->config->get('privat_oplata_pay_way');
		}

		if (isset($this->request->post['privat_oplata_language'])) {
			$this->data['privat_oplata_language'] = $this->request->post['privat_oplata_language'];
		} else {
			$this->data['privat_oplata_language'] = $this->config->get('privat_oplata_language');
		}



		$this->template = 'payment/privat_oplata.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	


	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/privat_oplata')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['privat_oplata_id_shop']) {
			$this->error['id_shop'] = $this->language->get('error_id_shop');
		}

		if (!$this->request->post['privat_oplata_pass_shop']) {
			$this->error['pass_shop'] = $this->language->get('error_pass_shop');
		}

		if (!$this->request->post['privat_oplata_action']) {
			$this->error['action'] = $this->language->get('error_action');
		}

		return !$this->error;
	}
}
?>