<?php

class Controller_Vendor extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try 
		{
			$query = "SELECT * FROM `vendor` ORDER BY `vendor_id` DESC;";
			$vendors = Ccc::getModel('Vendor_Row')->fetchAll($query);
			$this->getView()->setTemplate('vendor/grid.phtml')->setData(['vendors' => $vendors]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try 
		{
			$vendor =  Ccc::getModel('Vendor_Row');
			$this->getView()->setTemplate('vendor/edit.phtml')->setData(['vendor' => $vendor]);
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

			$vendor = Ccc::getModel('Vendor_Row')->load($id);

			if (!$vendor) {
				throw new Exception("Invalid Id.", 1);	
			}
			$this->getView()->setTemplate('vendor/edit.phtml')->setData(['vendor' => $vendor]);
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

			if (!($postData = $this->getRequest()->getPost('vendor'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				if (!($vendor =  Ccc::getModel('Vendor_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$vendor->updated_at = date("y-m-d H:i:s");
			}
			else {
				$vendor =  Ccc::getModel('Vendor_Row');
				$vendor->created_at = date("y-m-d H:i:s");
			}

			if (!$vendor->setData($postData)->save()) {
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

			if (!($vendor =  Ccc::getModel('Vendor_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$vendor->delete()) {
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
