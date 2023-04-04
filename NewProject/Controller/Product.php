<?php

class Controller_Product extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try 
		{
			$query = "SELECT * FROM `product` ORDER BY `product_id` DESC;";
			$products = Ccc::getModel('product_row')->fetchAll($query);
			$this->getView()->setTemplate('product/grid.phtml')->setData(['products' => $products]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try 
		{
			$product =  Ccc::getModel('Product_Row');
			$this->getView()->setTemplate('product/edit.phtml')->setData(['product' => $product]);
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

			$product = Ccc::getModel('product_row')->load($id);

			if (!$product) {
				throw new Exception("Invalid Id.", 1);	
			}
			$this->getView()->setTemplate('product/edit.phtml')->setData(['product' => $product]);
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

			if (!($postData = $this->getRequest()->getPost('product'))) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				if (!($product =  Ccc::getModel('Product_Row')->load($id))) {
					throw new Exception("Invalid Id.", 1);
				}

				$product->updated_at = date("y-m-d H:i:s");
			}
			else {
				$product =  Ccc::getModel('Product_Row');
				$product->created_at = date("y-m-d H:i:s");
			}

			if (!$product->setData($postData)->save()) {
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

			if (!($product =  Ccc::getModel('Product_Row')->load($id))) {
				throw new Exception("Invalid Id.", 1);
			}

			if (!$product->delete()) {
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
