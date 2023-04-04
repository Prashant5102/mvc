<?php

class Controller_ShippingMethod extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try 
		{
			$query = "SELECT * FROM `shipping_method` ORDER BY `shipping_method_id` DESC;";
			$shippingMethods = Ccc::getModel('ShippingMethod_Row')->fetchAll($query);
			$this->getView()->setTemplate('shippingmethod/grid.phtml')->setData(['shippingMethods' => $shippingMethods]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try 
		{
			$shippingMethod =  Ccc::getModel('ShippingMethod_Row');
			$this->getView()->setTemplate('shippingmethod/edit.phtml')->setData(['shippingMethod' => $shippingMethod]);
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

			$shippingMethod = Ccc::getModel('ShippingMethod_Row')->load($id);

			if (!$shippingMethod) {
				throw new Exception("Invalid Id.", 1);	
			}
			$this->getView()->setTemplate('shippingmethod/edit.phtml')->setData(['shippingMethod' => $shippingMethod]);
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

			if (!($postData = $this->getRequest()->getPost('shippingMethod'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				if (!($shippingMethod =  Ccc::getModel('ShippingMethod_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$shippingMethod->updated_at = date("y-m-d H:i:s");
			}
			else {
				$shippingMethod =  Ccc::getModel('ShippingMethod_Row');
				$shippingMethod->created_at = date("y-m-d H:i:s");
			}

			if (!$shippingMethod->setData($postData)->save()) {
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

			if (!($shippingMethod =  Ccc::getModel('ShippingMethod_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$shippingMethod->delete()) {
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
