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
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_buy'] = $this->language->get('text_buy');
		$data['text_donate'] = $this->language->get('text_donate');
		$data['entry_id_shop'] = $this->language->get('entry_id_shop');
		$data['entry_pass_shop'] = $this->language->get('entry_pass_shop'); //пароль и ид шопа тут точно не уверен
		$data['entry_action'] = $this->language->get('entry_action');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_pay_way'] = $this->language->get('entry_pay_way');
		$data['entry_language'] = $this->language->get('entry_language');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['id_shop'])) {
			$data['error_id_shop'] = $this->error['id_shop'];
		} else {
			$data['error_id_shop'] = '';
		}
		if (isset($this->error['pass_shop'])) {
			$data['error_pass_shop'] = $this->error['pass_shop'];
		} else {
			$data['error_pass_shop'] = '';
		}

		if (isset($this->error['action'])) {
			$data['error_action'] = $this->error['action'];
		} else {
			$data['error_action'] = '';
		}

        $data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/privat_oplata', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('payment/privat_oplata', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['privat_oplata_id_shop'])) {
			$data['privat_oplata_id_shop'] = $this->request->post['privat_oplata_id_shop'];
		} else {
			$data['privat_oplata_id_shop'] = $this->config->get('privat_oplata_id_shop');
		}

		if (isset($this->request->post['privat_oplata_pass_shop'])) {
			$data['privat_oplata_pass_shop'] = $this->request->post['privat_oplata_pass_shop'];
		} else {
			$data['privat_oplata_pass_shop'] = $this->config->get('privat_oplata_pass_shop');
		}

		if (isset($this->request->post['privat_oplata_action'])) {
			$data['privat_oplata_action'] = $this->request->post['privat_oplata_action'];
		} else {
			$data['privat_oplata_action'] = $this->config->get('privat_oplata_action');
			if (empty($data['privat_oplata_action'])) {
				$data['privat_oplata_action'] = 'https://payparts2.privatbank.ua/ipp/v2/payment/create';
			}
		}

        if (isset($this->request->post['privat_oplata_total'])) {
			$data['privat_oplata_total'] = $this->request->post['privat_oplata_total'];
		} else {
			$data['privat_oplata_total'] = $this->config->get('privat_oplata_total');
		}

 		if (isset($this->request->post['privat_oplata_order_status_id'])) {
			$data['privat_oplata_order_status_id'] = $this->request->post['privat_oplata_order_status_id'];
		} else {
			$data['privat_oplata_order_status_id'] = $this->config->get('privat_oplata_order_status_id');
		} 
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['privat_oplata_geo_zone_id'])) {
			$data['privat_oplata_geo_zone_id'] = $this->request->post['privat_oplata_geo_zone_id'];
		} else {
			$data['privat_oplata_geo_zone_id'] = $this->config->get('privat_oplata_geo_zone_id');
		} 
		
		$this->load->model('localisation/geo_zone');						
		
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['privat_oplata_status'])) {
			$data['privat_oplata_status'] = $this->request->post['privat_oplata_status'];
		} else {
			$data['privat_oplata_status'] = $this->config->get('privat_oplata_status');
		}

		if (isset($this->request->post['privat_oplata_sort_order'])) {
			$data['privat_oplata_sort_order'] = $this->request->post['privat_oplata_sort_order'];
		} else {
			$data['privat_oplata_sort_order'] = $this->config->get('privat_oplata_sort_order');
		}

		if (isset($this->request->post['privat_oplata_pay_way'])) {
			$data['privat_oplata_pay_way'] = $this->request->post['privat_oplata_pay_way'];
		} else {
			$data['privat_oplata_pay_way'] = $this->config->get('privat_oplata_pay_way');
		}

		if (isset($this->request->post['privat_oplata_language'])) {
			$data['privat_oplata_language'] = $this->request->post['privat_oplata_language'];
		} else {
			$data['privat_oplata_language'] = $this->config->get('privat_oplata_language');
		}



		$this->template = 'payment/privat_oplata.tpl';

		//Тут надо переделывать под каждую версию опенкарта

		$data['heading_title'] = $this->language->get('heading_title');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('payment/privat_oplata.tpl', $data));


		/*
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->load->view('catalog/privat_oplata.tpl', $data);
				
	//	$this->response->setOutput($this->render());
		*/
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