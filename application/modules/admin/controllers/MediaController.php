<?php

class Admin_MediaController extends Admin_Controller
{
	/**
	 * Image types
	 * 
	 * @var	array
	 */
	protected $_imageTypes = array(
		'gif', 
		'jpeg', 
		'jpg', 
		'png', 
		'bmp'
	);
	
	/**
	 * Media types
	 * 
	 * @var	array
	 */
	protected $_mediaTypes = array(
		'mp3', 
		'qt', 'mov', 
		'mpeg', 'mpg', 'mpe', 
		'wav', 
		'aiff', 'aif',
		'avi',
		'wmv'
	);
	
	/**
	 * Initialize object
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
	
		// Add js translate
		$this->view->jsTranslate(array(
				'Uploadify:@Title error',
				'Uploadify:@The number of files selected exceeds the queue size limit (%d)',
				'Uploadify:@Button cancel',
				'Uploadify:@Flash was not detected',
				'Uploadify:@Select files',
				'Uploadify:@Are you sure you want to remove this item ?',
				'Uploadify:@Button yes',
				'Uploadify:@Button no',
				'Uploadify:@Title warning',
				'Uploadify:@Are you sure you want to perform this action ?',
				'Uploadify:@Please wait a moment',
				'Uploadify:@Unknown error while uploading process'
		));
		
		$this->view->jsTranslate(array(
				'MediaForm:@Add new',
				'MediaForm:@Button upload'
		));
	}
	
	
	/**
	 * All media files
	 */
	public function indexAction()
	{
		// Get params
		$__fromWysiwyg = (string) $this->getRequest()->getParam('__fromWysiwyg');
		if ($fileTypeExts = (string) $this->getRequest()->getParam('fileTypeExts'))
		{
			$queryOptions = array();
			switch (strtolower($fileTypeExts))
			{
				case 'image':
					$queryOptions['media_type'] = $this->_imageTypes;
					break;
				case 'media':
					$queryOptions['media_type'] = $this->_mediaTypes;
					break;
			}
			
			// Assign into view
			$this->view->fileTypeExts = $fileTypeExts;
		}
		
		// Assign into view
		$this->view->imageType = $this->_imageTypes;
		
		// Init grid
		$mediaDataGrid = new Admin_DataGrid_Media(isset($queryOptions) ? $queryOptions : array());
		$this->view->grid = $mediaDataGrid->deploy(mb_strlen($__fromWysiwyg) > 0 ? 'media/wysiwyg/datagrid.phtml' : null);
	}
	
	/**
	 * Add new
	 */
	public function addAction()
	{
		// Get params
		$reloadPage = (int) $this->getRequest()->getParam('reloadPage');
		
		if ($fileTypeExts = (string) $this->getRequest()->getParam('fileTypeExts'))
		{
			switch (strtolower($fileTypeExts))
			{
				case 'image':
					$this->view->fileTypeExts = '*.' . implode(';*.', $this->_imageTypes);
					$this->view->fileTypeDesc = $this->view->translate('Uploadify:@File types %s', '(' . $this->view->fileTypeExts . ')');
					break;
				case 'media':
					$this->view->fileTypeExts = '*.' . implode(';*.', $this->_mediaTypes);
					$this->view->fileTypeDesc = $this->view->translate('Uploadify:@File types %s', '(' . $this->view->fileTypeExts . ')');
					break;
			}
		} else 
		{
			$this->view->fileTypeDesc = $this->view->translate('Uploadify:@File types %s', '(*.*)');
			$this->view->fileTypeExts = '*.*';
		}
		
		// Assign into view
		$this->view->fileSizeLimit = Lumia_Utility_Filesystem::getFileUploadMaxSize() . 'B';
		$this->view->form = new Admin_Form_Media();
		$this->view->reloadPage = $reloadPage;
	}

	/**
	 * Delete by id
	 */
	public function deleteAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setError();
    
    	// Get params
    	$id = (int) $this->getRequest()->getParam('id', 0);
		$reloadPage = (int) $this->getRequest()->getParam('reloadPage');
		    	
    	if ($id)
    	{
    		$mediaModel = new Admin_Model_Media();
    		$mediaRows = $mediaModel->find($id);
    		if (($mediaRows->count() > 0) && $mediaModel->deleteSelectedRows(array($id)))
    		{
    			$mediaRow = $mediaRows->getRow(0);
    			$origPath = str_replace('/', DIRECTORY_SEPARATOR, LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'uploadify' . DIRECTORY_SEPARATOR . $mediaRow->media_url);
    			@unlink($origPath);
    			
    			$thumbPath = str_replace('/', DIRECTORY_SEPARATOR, LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $mediaRow->media_url);
    			@unlink($thumbPath);
    			
    			$messageHandler->setSuccess();
    			$this->_helper->messenger('danger')->addMessage($this->view->translate('Message:@The records that you selected has been deleted'));
    		} else
    		{
    			$this->_helper->messenger('danger')->addMessage($this->view->translate('Message:@An error occurred while deleting the records that you selected'));
    		}
    	} else
    	{
    		$this->_helper->messenger('danger')->addMessage($this->view->translate('Message:@You must select at least one record'));
    	}
    	
    	if ($reloadPage)
    	{
    		$this->_redirect('admin/media');
    	} else
    	{
    		$this->getResponse()->setBody($messageHandler);
    	}
	}

	/**
	 * Delete via row(s) selected
	 */
	public function deleteViaSelectedAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		
		// Get selected rows
		$selectRows = (array) $this->getRequest()->getParam('selected-rows', null);
		
		if ($selectRows)
		{
			$mediaModel = new Admin_Model_Media();
			$mediaRows = $mediaModel->find($selectRows);
			if (($mediaRows->count() > 0) && $mediaModel->deleteSelectedRows(array($selectRows)))
			{
				$messageHandler->setSuccess();
				foreach ($mediaRows as $row)
				{
					$origPath = str_replace('/', DIRECTORY_SEPARATOR, LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'uploadify' . DIRECTORY_SEPARATOR . $row->media_url);
	    			@unlink($origPath);
	    			
	    			$thumbPath = str_replace('/', DIRECTORY_SEPARATOR, LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $row->media_url);
	    			@unlink($thumbPath);
				}
				
				$messageHandler->appendMessage($this->view->translate('Message:@The records that you selected has been deleted'));
			} else
			{
				$messageHandler->setError();
				$messageHandler->appendMessage($this->view->translate('Message:@An error occurred while deleting the records that you selected'));
			}
		} else
		{
			$messageHandler->appendMessage($this->view->translate('Message:@You must select at least one record'));
		}
		
		$messageHandler->addContext($this->view->baseUrl('admin/media'), 'redirect');
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Upload files
	 */
	public function uploadAction()
	{
		// Disable layout
		$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
		
		// Disable view script
		$this->_helper->viewRenderer->setNoRender(true);
		
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setError();
		
		// Define a destination
		$subFolder = date('Y-m-d');
		
		$targetFolder = LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'uploadify' . DIRECTORY_SEPARATOR . $subFolder; // Relative to the root
		Lumia_Utility_Filesystem::makeDirectories($targetFolder);
		
		// Init file transfer
		$upload = new Zend_File_Transfer_Adapter_Http();
		$upload->setDestination($targetFolder);
		$upload->addPrefixPath('Lumia_Validate', 'Lumia/Validate', $upload::VALIDATE);
		$upload->addPrefixPath('Lumia_Validate_File', 'Lumia/Validate/File', $upload::VALIDATE);

		// Set a file size
		$upload->addValidator('Size', false, 4160411);
		
		// Set file count in one step
		$upload->addValidator('Count', false, array('min' => 1));
		
		if ($uploadIsValid = $upload->isValid())
		{
			// Get file name
			$fileName = uniqid($this->view->userSession()->user_id) . basename($upload->getFileName());
			
			// Get file type
			$fileType = explode('.', $fileName);
			if (count($fileType) > 1) 
			{
				$fileType = strtolower(end($fileType));
			} else 
			{
				$fileType = null;
			}
			
			// Get file path
			$filePath = $targetFolder . DIRECTORY_SEPARATOR . $fileName;
			
			// Add filters
			$upload->addFilter('Rename', $filePath);
		} else 
		{
			$messageHandler->setMessages($upload->getMessages());
		}
		
		try 
		{
			// Set error
			if (!$uploadIsValid || !$fileType || !in_array($fileType, array_merge($this->_imageTypes, $this->_mediaTypes)))
			{
				$messageHandler->setError();
			} else 
			{	
				// This takes care of the moving and making sure the file is there
				$upload->receive();
				$messageHandler->setError();
				
				if ($upload->isReceived())
				{
					$messageHandler->setSuccess();
					
					$fileInfo = $upload->getFileInfo();
					$contexts = array();
					foreach ($fileInfo as $row)
					{
						$contexts['name'] = $row['name'];
						$contexts['path'] = $this->view->baseUrl(basename(LUMIA_UPLOAD_DIR) . '/uploadify/' . $subFolder . '/' . $row['name']);
						$contexts['size'] = $row['size'];
						$contexts['type'] = $fileType;
					}
					
					// Create thumbnail
					if ($contexts)
					{
						if (in_array($fileType, $this->_imageTypes))
						{
							// Init thumb class
							$thumb = Lumia_Image::factory($filePath);
							
							// Get thumb width
							$width = (int) $this->getRequest()->getParam('w', 128);
							$height = (int) $this->getRequest()->getParam('h', 128);
	
							// Creat thumb folder
							$thumbSubFolder = LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $subFolder . DIRECTORY_SEPARATOR;
							Lumia_Utility_Filesystem::makeDirectories($thumbSubFolder);
							
							// Assign into view
							if ($width > 0 && $height > 0)
							{
								$thumb->adaptiveResize($width, $height)->save($thumbSubFolder . $fileName);
								$contexts['thumb'] = $this->view->baseUrl(basename(LUMIA_UPLOAD_DIR) . '/thumb/' . $subFolder . '/' . $fileName);
							}
						} else {
							$contexts['thumb'] = $this->view->baseUrl('/static/jquery-uploadify/no_media.png');
						}
					
						// Save into database
						$mediaModel = new Admin_Model_Media();
						$contexts['id'] = $mediaModel->save(Application_Const::FORM_SAVE_MODE_ADD, array(
							'media_url' => $subFolder . '/' . $fileName,
							'media_type' => $fileType
						));
					}
					
					$messageHandler->setContexts($contexts, 'FILE_INFO');
				}
			}
		} catch (Exception $e) 
		{
			$messageHandler->setError();
			$messageHandler->setContexts(array(
				'message' => $e->getMessage(),
				'trace' => $e->getTraceAsString()
			), 'EXCEPTION');
		}
		
		Zend_Session::regenerateId();
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Create temp image
	 */
	public function placeholderAction()
	{
		// Disable layout
		$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
		
		// Disable view script
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Get variables from $_GET
		$width           = (float) $this->getRequest()->getParam('w');
		$height          = (float) $this->getRequest()->getParam('h');
		$backgroundColor = (string) $this->getRequest()->getParam('bgColor');
		$textColor       = (string) $this->getRequest()->getParam('textColor');
		try 
		{
			$placeholder = new Lumia_Placeholder();
			$width && $placeholder->setWidth($width);
			$height && $placeholder->setHeight($height);
			$backgroundColor && $placeholder->setBackgroundColor($backgroundColor);
			$textColor && $placeholder->setTextColor($textColor);
			$placeholder->render();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}