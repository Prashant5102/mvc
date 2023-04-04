<?php

class Controller_PaymentMethod extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try 
		{
			$query = "SELECT * FROM `payment_method` ORDER BY `payment_method_id` DESC;";
			$paymentMethods = Ccc::getModel('PaymentMethod_Row')->fetchAll($query);
			$this->getView()->setTemplate('paymentmethod/grid.phtml')->setData(['paymentMethods' => $paymentMethods]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try 
		{
			$paymentMethod =  Ccc::getModel('PaymentMethod_Row');
			$this->getView()->setTemplate('paymentmethod/edit.phtml')->setData(['paymentMethod' => $paymentMethod]);
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

			$paymentMethod = Ccc::getModel('PaymentMethod_Row')->load($id);

			if (!$paymentMethod) {
				throw new Exception("Invalid Id.", 1);	
			}
			$this->getView()->setTemplate('paymentmethod/edit.phtml')->setData(['paymentMethod' => $paymentMethod]);
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

			if (!($postData = $this->getRequest()->getPost('paymentMethod'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				if (!($paymentMethod =  Ccc::getModel('PaymentMethod_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$paymentMethod->updated_at = date("y-m-d H:i:s");
			}
			else {
				$paymentMethod =  Ccc::getModel('PaymentMethod_Row');
				$paymentMethod->created_at = date("y-m-d H:i:s");
			}

			if (!$paymentMethod->setData($postData)->save()) {
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

			if (!($paymentMethod =  Ccc::getModel('PaymentMethod_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$paymentMethod->delete()) {
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
