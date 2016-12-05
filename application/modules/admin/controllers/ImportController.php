<?php
class Admin_ImportController extends Admin_Controller
{
	protected $_fileName;
	
	/**
	 * Crypt object
	 */
	protected $_crypt;
	
	/**
	 * Initialize object
	 */
	public function init()
	{
		parent::init();
		
		// Init crypt object
		$this->_crypt = Lumia_Cryptography::factory('HashString');
		$this->_crypt->setPrivateKey($this->view->userSession()->user_id);
		
		// Inject js translate
		$this->view->jsTranslate(array(
			'ImportForm:@Browser file', 
			'ImportForm:@The file are downloaded success',
			'ImportForm:@An error occurred in processing download file'
		));
	}
	
	/**
	 * Import student
	 */
	public function studentAction()
	{
		// Get form for this action
		$form = new Admin_Form_Import_Student();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				try 
				{
					// Init class
					$transferAdapter = $form->getElement('import_file')->getTransferAdapter();
					
					// Add plugin prefix
					$transferAdapter->addPrefixPath('Lumia_Validate', 'Lumia/Validate', $transferAdapter::VALIDATE);
					$transferAdapter->addPrefixPath('Lumia_Validate_File', 'Lumia/Validate/File', $transferAdapter::VALIDATE);

					// Returns information about a file path
					$pathInfo = pathinfo($transferAdapter->getFileName());
					
					// Upload directory path
					$uploadDir = $transferAdapter->getDestination();
					
					// Generate file name
					$fileName = uniqid('USER_' . md5($this->view->userSession()->user_id . time()) . '_') . $pathInfo['filename'] . '.' . $pathInfo['extension'];
					
					// Add filter rename file
					$transferAdapter->addFilter('Rename', $fileName);
					
					// This takes care of the moving and making sure the file is there
					$transferAdapter->receive();
					
					// If success
					if ($transferAdapter->isReceived())
					{
						$form->whenUploadSucceeded($this->_crypt->encrypt($uploadDir . DIRECTORY_SEPARATOR . $fileName));
					}
				} catch (Zend_File_Transfer_Exception $e) 
				{
					throw $e;
				}
			}
		}
		
		$this->view->form = $form;
	}
	
	/**
	 * Process import student file
	 */
	public function processingStudentAction()
	{
		// Init message handler
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setSuccess();
		
		// Disable view script
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Auto disable layout
		$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
		
		// Get params
		$filePath = (string) $this->getRequest()->getParam('filePath');
		$filePath = $this->_crypt->decrypt($filePath);
		$ignoreHeader = (bool) $this->getRequest()->getParam('import_ignore_header');
		$importFormat = (int) $this->getRequest()->getParam('import_format');
		
		// Check existing import template
		$importModel = new Admin_Model_Import();
		if (!($importRow = $importModel->getById($importFormat)))
		{
			$messageHandler->setMessages(array($this->view->translate('ImportForm:@The import template were not found in database')));
			$messageHandler->setError();
		} else 
		{
			try 
			{
				$instance = new Admin_Imex_Import_Student(array(
					'fileFormat' => $importRow->imex_template,
					'filePath' => $filePath,
					'ignoreHeader' => $ignoreHeader
				));
				$instance->process();
				
				if ($instance->hasErrors())
				{
					$errors = $instance->getErrors();
					if (!empty($errors['recordsNotFound']))
					{
						$messageHandler->setMessages(array($this->view->translate('ImportForm:@Sorry, no records added')));
					} else 
					{
						$messageHandler->setMessages(array(
							$this->view->translate('ImportForm:@There are some records are not added'),
							$this->view->translate('ImportForm:@Click %shere%s to download error file', '<a href="javascript:LumiaJS.admin.import.downloadError(\'' . $this->_crypt->encrypt($errors['log']) . '\');">', '</a>')
						));	
					}
				} else 
				{
					$messageHandler->setMessages(array($this->view->translate('ImportForm:@The file\'s records that you selected has been added')));
				}
			} catch (Exception $e)
			{
				$messageHandler->setError();
				$messageHandler->setMessages(array($e->getMessage()));
			}
		}
		
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Import teacher
	 */
	public function teacherAction()
	{
		// Get form for this action
		$form = new Admin_Form_Import_Teacher();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				try 
				{
					// Init class
					$transferAdapter = $form->getElement('import_file')->getTransferAdapter();
					
					// Add plugin prefix
					$transferAdapter->addPrefixPath('Lumia_Validate', 'Lumia/Validate', $transferAdapter::VALIDATE);
					$transferAdapter->addPrefixPath('Lumia_Validate_File', 'Lumia/Validate/File', $transferAdapter::VALIDATE);

					// Returns information about a file path
					$pathInfo = pathinfo($transferAdapter->getFileName());
					
					// Upload directory path
					$uploadDir = $transferAdapter->getDestination();
					
					// Generate file name
					$fileName = uniqid('USER_' . md5($this->view->userSession()->user_id . time()) . '_') . $pathInfo['filename'] . '.' . $pathInfo['extension'];
					
					// Add filter rename file
					$transferAdapter->addFilter('Rename', $fileName);
					
					// This takes care of the moving and making sure the file is there
					$transferAdapter->receive();
					
					// If success
					if ($transferAdapter->isReceived())
					{
						$form->whenUploadSucceeded($this->_crypt->encrypt($uploadDir . DIRECTORY_SEPARATOR . $fileName));
					}
				} catch (Zend_File_Transfer_Exception $e) 
				{
					throw $e;
				}
			}
		}
		
		$this->view->form = $form;
	}
	
	/**
	 * Process import teacher file
	 */
	public function processingTeacherAction()
	{
		// Init message handler
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setSuccess();
		
		// Disable view script
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Auto disable layout
		$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
		
		// Get params
		$filePath = (string) $this->getRequest()->getParam('filePath');
		$filePath = $this->_crypt->decrypt($filePath);
		$ignoreHeader = (bool) $this->getRequest()->getParam('import_ignore_header');
		$importFormat = (int) $this->getRequest()->getParam('import_format');
		
		// Check existing import template
		$importModel = new Admin_Model_Import();
		if (!($importRow = $importModel->getById($importFormat)))
		{
			$messageHandler->setMessages(array($this->view->translate('ImportForm:@The import template were not found in database')));
			$messageHandler->setError();
		} else 
		{
			try 
			{
				$instance = new Admin_Imex_Import_Teacher(array(
					'fileFormat' => $importRow->imex_template,
					'filePath' => $filePath,
					'ignoreHeader' => $ignoreHeader
				));
				$instance->process();
				
				if ($instance->hasErrors())
				{
					$errors = $instance->getErrors();
					if (!empty($errors['recordsNotFound']))
					{
						$messageHandler->setMessages(array($this->view->translate('ImportForm:@Sorry, no records added')));
					} else 
					{
						$messageHandler->setMessages(array(
							$this->view->translate('ImportForm:@There are some records are not added'),
							$this->view->translate('ImportForm:@Click %shere%s to download error file', '<a href="javascript:LumiaJS.admin.import.downloadError(\'' . $this->_crypt->encrypt($errors['log']) . '\');">', '</a>')
						));	
					}
				} else 
				{
					$messageHandler->setMessages(array($this->view->translate('ImportForm:@The file\'s records that you selected has been added')));
				}
			} catch (Exception $e)
			{
				$messageHandler->setError();
				$messageHandler->setMessages(array($e->getMessage()));
			}
		}
		
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Generate file format
	 */
	public function generateFormatAction()
	{
		// Init message handler
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setSuccess();
		
		// Disable view script
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Auto disable layout
		$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
		
		// Get params
		$formatID = (int) $this->getRequest()->getParam('formatID', 0);
		
		// Check existing import template
		$exportModel = new Admin_Model_Export();
		if (!($exportRow = $exportModel->getById($formatID)))
		{
			$messageHandler->setMessages(array($this->view->translate('ImportForm:@The import template were not found in database')));
			$messageHandler->setError();
		} else 
		{
			// Error directory
			$exportDir =  LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'export' . DIRECTORY_SEPARATOR;
			
			// Create error dir if its not exists
			Lumia_Utility_Filesystem::makeDirectories($exportDir);
			
			// Generate file path
			$filePath = $exportDir . 'formatID' . $formatID . time() . '.xlsx';
			
			// If file exist
			if (is_file($filePath) && file_exists($filePath))
			{
				$messageHandler->addContext($this->_crypt->encrypt(basename($filePath)), 'fileName');
			} else
			{
				try 
				{
					// Init export object
					$instance = new Admin_Imex_Export(array(
						'fileFormat' => $exportRow->imex_template,
						'filePath' => $filePath
					));
					$instance->process();
						
					if ($instance->hasErrors())
					{
						$messageHandler->setError();
						$messageHandler->setMessages($instance->getErrors());
					} else
					{
						$messageHandler->addContext($this->_crypt->encrypt(basename($instance->getFilePath())), 'fileName');
					}
				} catch (Exception $e)
				{
					$messageHandler->setError();
					$messageHandler->setMessages(array($e->getMessage()));
				}
			}
		}
		
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Download format file
	 */
	public function downloadFormatAction()
	{
		// Init message handler
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setSuccess();
		
		// Auto disable layout
		$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
			
		// Disable view script
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Get params
		$fileName = (string) $this->getRequest()->getParam('fileName', '');
		$fileName = $this->_crypt->decrypt($fileName);
		
		// Export directory
		$exportDir =  LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'export' . DIRECTORY_SEPARATOR;
		
		if (is_file($exportDir . $fileName) && file_exists($exportDir . $fileName))
		{
			try 
			{
				// response the file
				$this->getResponse()->setHeader('Cache-Control', 'no-cache, must-revalidate');
				$this->getResponse()->setHeader('Expires', 0);
				$this->getResponse()->setHeader('Pragma', 'no-cache');
				$this->getResponse()->setHeader('Content-Description', 'File Transfer');
				$this->getResponse()->setHeader('Content-Type', 'application/octet-stream; charset=UTF-8');
				$this->getResponse()->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"');
				$this->getResponse()->setHeader('Content-Length', filesize($exportDir . $fileName));
				$this->getResponse()->setHeader('Content-Transfer-Encoding', 'binary'); 
				readfile($exportDir . $fileName);
//				echo "\xEF\xBB\xBF"; // UTF-8 BOM
			} catch (Exception $e)
			{
				$messageHandler->setError();
				$messageHandler->appendMessage($e->getMessage());
			}
		} else 
		{
			$messageHandler->setError();
			$messageHandler->appendMessage($this->view->translate('ImportForm:@File not found'));
			$this->getResponse()->setBody($messageHandler);
		}
	}

	/**
	 * Download errors
	 */
	public function downloadErrorsAction()
	{
		// Init message handler
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setSuccess();
		
		// Auto disable layout
		$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
			
		// Disable view script
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Get params
		$filePath = (string) $this->getRequest()->getParam('filePath', '');
		$filePath = $this->_crypt->decrypt($filePath);
		
		if (is_file($filePath) && file_exists($filePath))
		{
			try 
			{
				// response the file
				ob_end_clean();
				$this->getResponse()->setHeader('Cache-Control', 'no-cache, must-revalidate');
				$this->getResponse()->setHeader('Expires', 0);
				$this->getResponse()->setHeader('Pragma', 'public');
				$this->getResponse()->setHeader('Content-Description', 'File Transfer');
				$this->getResponse()->setHeader('Content-Type', 'application/text; charset=UTF-8');
				$this->getResponse()->setHeader('Content-Disposition', 'attachment; filename="' . basename($filePath) . '"');
				$this->getResponse()->setHeader('Content-Length', filesize($filePath));
				$this->getResponse()->setHeader('Content-Transfer-Encoding', 'binary'); 
				readfile($filePath);
			} catch (Exception $e)
			{
				$messageHandler->setError();
				$messageHandler->appendMessage($e->getMessage());
			}
		} else 
		{
			$messageHandler->setError();
			$messageHandler->appendMessage($this->view->translate('ImportForm:@File not found'));
			$this->getResponse()->setBody($messageHandler);
		}
	}
}