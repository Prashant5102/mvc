<?php
class Controller_Product_Media extends Controller_Core_Action
{
	public function gridAction()
	{
		try 
		{
			if (!($product_id = $this->getRequest()->getParam('id'))) {
				throw new Exception("Missing product id.", 1);
			}

			$query = "SELECT * FROM `product_media` WHERE `product_id` = {$product_id} ORDER BY `name` DESC;";
			$medias = Ccc::getModel('Product_Media_Row')->fetchAll($query);

			$this->getView()
				->setTemplate('product_media/grid.phtml')
				->setData(['medias' => $medias]);
			$this->render();
		} 
		catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}
	}

	public function addAction()
	{
		$this->getTemplate('product_media/add.phtml');
	}

	public function saveAction()
	{
		try 
		{
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			$file = $_FILES['file'];
			$file_name = $file['name'];
			$file_tmp = $file['tmp_name'];
			$file_error = $file['error'];
			$file_size = $file['size'];
			if ($file_error === 0) {
				$file_destination = './Images/'.$file_name;
				move_uploaded_file($file_tmp, $file_destination);
			}

			$mediaInsertId = $this->getMediaRow()->setData($this->getRequest()->getPost('media'))->addData('product_id', $this->getRequest()->getParam('id'))->addData('created_at', date("d-m-Y H:i:s"))->save();
			if (!$mediaInsertId) {
				throw new Exception("Unable to insert record.", 1);
			}

			$this->getMessage()->addMessage('Data inserted successfully.');
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, ['id' => $this->getRequest()->getParam('id')], true);
	}

	public function operationAction()
	{
		try 
		{
			if ($this->getRequest()->getPost('update')) {
				if (!$this->getRequest()->isPost()) {
					throw new Exception("Invalid request.", 1);
				}

				$result = $this->getMediaRow()->setData(['base' => 0, 'small' => 0, 'thumbnail' => 0, 'gallery' => 0])->setPrimaryKey('product_id')->addData('product_id', $this->getRequest()->getParam('product_id'))->save();
				$result = $this->getMediaRow()->setData(['base' => 1])->setPrimaryKey('media_id')->addData('media_id', $this->getRequest()->getPost('base'))->save();
				$result = $this->getMediaRow()->setData(['small' => 1])->addData('media_id', $this->getRequest()->getPost('small'))->save();
				$result = $this->getMediaRow()->setData(['thumbnail' => 1])->addData('media_id', $this->getRequest()->getPost('thumbnail'))->save();
				$result = $this->getMediaRow()->setData(['gallery' => 1])->addData('media_id', $this->getRequest()->getPost('gallerys'))->save();
				if (!$result) {
					throw new Exception("Unable to update record.", 1);
				}

				$this->getMessage()->addMessage('Data updated successfully.');
			}

			elseif ($this->getRequest()->getPost('deleted')) {
				
				$product_id = $this->getRequest()->getParam('product_id');

				if (!$product_id) {
					throw new Exception("Missing product id.", 1);
				}

				$deleted = $this->getMediaRow()->setData(['media_id' => $this->getRequest()->getPost('delete')])->delete();
				if (!$deleted) {
					throw new Exception("Unable to delete the record.", 1);
				}

				$this->getMessage()->addMessage('Data deleted successfully.');
			}
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::FAILURE);
		}

		$this->redirect('grid', null, ['id' => $this->getRequest()->getParam('id')], true);
	}

}

?>