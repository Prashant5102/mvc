<?php

class Controller_Customer extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try 
		{
			$query = "SELECT * FROM `customer` ORDER BY `customer_id` DESC;";
			$customers = Ccc::getModel('Customer_Row')->fetchAll($query);
			$this->getView()->setTemplate('customer/grid.phtml')->setData(['customers' => $customers]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try 
		{
			$customer =  Ccc::getModel('Customer_Row');
			$customerAddress =  Ccc::getModel('Customer_Row');
			$this->getView()->setTemplate('customer/edit.phtml')->setData(['customer' => $customer,'customerAddress' => $customerAddress]);
			$this->render();

		} 
		catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try 
		{
			if (!$id = (int)$this->getRequest()->getParam('id')) {
				throw new Exception("Invalid request.", 1);
			}

			if (!$customer = Ccc::getModel('Customer_Row')->load($id)) {
				throw new Exception("Invalid Id.", 1);	
			}

			$customerAddress = Ccc::getModel('Customer_Row');
			$customerAddress->getTable()->setTableName('customer_address');

			if (!$customerAddress->load($id)) {
				throw new Exception("Invalid Id.", 1);	
			}
			$this->getView()->setTemplate('customer/edit.phtml')->setData(['customer' => $customer,'customerAddress' => $customerAddress]);
			$this->render();
		} 
		catch (Exception $e) {
			
		}
	}

	public function saveAction()
	{
		try 
		{
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($postData = $this->getRequest()->getPost('customer'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				if (!($customer =  Ccc::getModel('Customer_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$customer->updated_at = date("y-m-d H:i:s");
			}
			else {
				$customer =  Ccc::getModel('Customer_Row');
				$customer->created_at = date("y-m-d H:i:s");
			}

			if (!$customer->setData($postData)->save()) {
				throw new Exception("Unable to save.", 1);
			}

			$this->getMessage()->addMessage('Data saved successfully.');
			$this->redirect('grid', null, [], true);
		} 
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
		
	}

	public function deleteAction()
	{
		try 
		{
			if (!($id = (int) $this->getRequest()->getParam('id'))) {
				throw new Exception("Invalid request.", 1);
			}

			if (!($customer =  Ccc::getModel('Customer_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$customer->delete()) {
				throw new Exception("Unable to delete.", 1);
			}
			$this->getMessage()->addMessage('Data deleted successfully.');
			$this->redirect('grid', null, [], true);
		} 
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

	}

}
