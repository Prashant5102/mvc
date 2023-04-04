<?php

class Controller_Salesman extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try 
		{
			$query = "SELECT * FROM `salesman` ORDER BY `salesman_id` DESC;";
			$salesmen = Ccc::getModel('Salesman_Row')->fetchAll($query);
			$this->getView()->setTemplate('salesman/grid.phtml')->setData(['salesmen' => $salesmen]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try 
		{
			$salesman =  Ccc::getModel('Salesman_Row');
			$this->getView()->setTemplate('salesman/edit.phtml')->setData(['salesman' => $salesman]);
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

			$salesman = Ccc::getModel('Salesman_Row')->load($id);

			if (!$salesman) {
				throw new Exception("Invalid Id.", 1);	
			}
			$this->getView()->setTemplate('salesman/edit.phtml')->setData(['salesman' => $salesman]);
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

			if (!($postData = $this->getRequest()->getPost('salesman'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				if (!($salesman =  Ccc::getModel('Salesman_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$salesman->updated_at = date("y-m-d H:i:s");
			}
			else {
				$salesman =  Ccc::getModel('Salesman_Row');
				$salesman->created_at = date("y-m-d H:i:s");
			}

			if (!$salesman->setData($postData)->save()) {
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

			if (!($salesman =  Ccc::getModel('Salesman_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$salesman->delete()) {
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
