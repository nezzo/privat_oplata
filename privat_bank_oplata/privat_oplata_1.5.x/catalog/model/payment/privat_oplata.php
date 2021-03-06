<?php 
class ModelPaymentprivatoplata extends Model {
  	public function getMethod($address, $total) {
	
		$this->language->load('payment/privat_oplata');

		$tbl_zone_to_geo_zone = DB_PREFIX.'zone_to_geo_zone';
		$privat_oplata_geo_zone_id = (int)$this->config->get('privat_oplata_geo_zone_id');
		$country_id = (int)$address['country_id'];
		$zone_id = (int)$address['zone_id'];

		$sql = "
				SELECT *
				FROM {$tbl_zone_to_geo_zone}
				WHERE geo_zone_id = '{$privat_oplata_geo_zone_id}'
				AND country_id = '{$country_id}'
				AND (zone_id = '{$zone_id}' OR zone_id = '0')
		";

		$query = $this->db->query($sql);

		if ($this->config->get('privat_oplata_total') > 0 && $this->config->get('privat_oplata_total') > $total) {
			$status = false;
		} elseif (!$this->config->get('privat_oplata_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'       => 'privat_oplata',
				'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('privat_oplata_sort_order')
			);
		}

		return $method_data;
	}

	/*Получаем данные о товаре из таблице (при клике add cart которые заносятся) воможно нужен не price  a total*/
	public function order_product_privat_oplata($order_id){
		$sql_query = "
				SELECT product_id,name,price,quantity
				FROM oc_order_product
				WHERE order_id = '{$order_id}'";


		$query = $this->db->query($sql_query);

		$data_privat_oplata=array();

		foreach ($query->rows as $data_privat) {
			$data_privat_oplata[] = array(
				'name' => $data_privat['name'],
				'price'=> $data_privat['price'],
				'product_id'=> $data_privat['product_id'],
				'quantity'=> $data_privat['quantity']
			);
		}

		return $data_privat_oplata;

	}


}
