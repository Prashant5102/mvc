<?php

class Controller_Category extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try 
		{
			$query = "SELECT * FROM `category` ORDER BY `category_id` DESC;";
			$categories = Ccc::getModel('category_row')->fetchAll($query);
			$this->getView()->setTemplate('category/grid.phtml')->setData(['categories' => $categories]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try 
		{
			$category =  Ccc::getModel('category_row');
			$this->getView()->setTemplate('category/edit.phtml')->setData(['category' => $category]);
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

			$category = Ccc::getModel('category_row')->load($id);

			if (!$category) {
				throw new Exception("Invalid Id.", 1);	
			}
			$this->getView()->setTemplate('category/edit.phtml')->setData(['category' => $category]);
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

			if (!($postData = $this->getRequest()->getPost('category'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				if (!($category =  Ccc::getModel('category_row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$category->updated_at = date("y-m-d H:i:s");
			}
			else {
				$category =  Ccc::getModel('category_row');
				$category->created_at = date("y-m-d H:i:s");
			}

			if (!$category->setData($postData)->save()) {
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

			if (!($category =  Ccc::getModel('category_row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$category->delete()) {
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
