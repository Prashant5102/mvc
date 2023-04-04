<?php

class Controller_Admin extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try 
		{
			$query = "SELECT * FROM `admin` ORDER BY `admin_id` DESC;";
			$admins = Ccc::getModel('admin_row')->fetchAll($query);
			$this->getView()->setTemplate('Admin/grid.phtml')->setData(['admins' => $admins]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try 
		{
			$admin =  Ccc::getModel('admin_row');
			$this->getView()->setTemplate('Admin/edit.phtml')->setData(['admin' => $admin]);
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

			$admin = Ccc::getModel('admin_row')->load($id);

			if (!$admin) {
				throw new Exception("Invalid Id.", 1);	
			}
			$this->getView()->setTemplate('admin/edit.phtml')->setData(['admin' => $admin]);
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

			if (!($postData = $this->getRequest()->getPost('admin'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				if (!($admin =  Ccc::getModel('admin_row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$admin->updated_at = date("y-m-d H:i:s");
			}
			else {
				$admin =  Ccc::getModel('admin_row');
				$admin->created_at = date("y-m-d H:i:s");
			}

			if (!$admin->setData($postData)->save()) {
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

			if (!($admin =  Ccc::getModel('admin_row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$admin->delete()) {
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
