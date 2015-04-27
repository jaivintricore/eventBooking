<?php
class Event_Booking_OrderController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
    {
     $this->loadLayout();
     $this->renderLayout();
    }
    public function orderAction(){
		$id = $this->getRequest()->getParam('id');
        $resource = Mage::getSingleton('core/resource');
		$readConnection = $resource->getConnection('core_read');
		$table = "sales_flat_order_item";
		$tableName = Mage::getSingleton("core/resource")->getTableName($table); 
		$query = 'SELECT * FROM '.$tableName.' WHERE product_id ='.$id;
		$sku = $readConnection->fetchAll($query);
		$count = count($sku);
        
		$options1 = unserialize($sku[0]['product_options']);
		$header_options = $options1['options'];
		
		$count_options = count($options1['options']);
		// prepare CSV header
		$csv = '';
		for ($x = 0; $x < $count_options; $x++) {  
				$array[] = $header_options[$x]['label'];		
		} 
		$array[] = "Events";
		$array[] = "Order #";
		$array[] = "Status";
		$_columns = $array;
		$data = array();
		// prepare CSV header...
		foreach ($_columns as $column) {
			$data[] = '"'.$column.'"';
		}
		$csv .= implode('#', $data)."\n";
		foreach($sku as $id){
		$orderId = $id['order_id'];
		$order = Mage::getModel('sales/order')->load($orderId);
		$Incrementid = $order->getIncrementId();
		
		$orders = Mage::getModel('sales/order')->getCollection()->addAttributeToFilter('increment_id', $Incrementid);
		foreach($orders as $ord){
				$status =  $ord['status'];
				$created_at = $ord['created_at'];
				$increment_id = $ord['increment_id'];
			}
		$options = unserialize($id['product_options']);
		$got_options = $options['options'];	
		$data = array();
		for($x = 0; $x < $count_options; $x++) {  
			$data[] = $got_options[$x]['value'];
		} 
		$data[] = $created_at;
		$data[] = $increment_id;
		$data[] = $status;
		$csv .= implode('#', $data)."\n";
		}
		$this->_redirect('*/*/');
		$this->_prepareDownloadResponse('file.csv', $csv, 'text/csv');
	}
}
