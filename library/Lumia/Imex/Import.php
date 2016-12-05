<?php

abstract class Lumia_Imex_Import extends Lumia_Imex_Abstract
{
	/**
	 * @var string
	 */
	protected $_errorFile;
	
	/**
	 * Process file data
	 */
	protected function _fileHandler()
	{
		try 
		{
			// Enable detection of line endings (CR, RT or both)
			ini_set('auto_detect_line_endings', true);
			
			// Error directory
			$errorDir =  LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR . 'error' . DIRECTORY_SEPARATOR;
			
			// Create error dir if its not exists
			Lumia_Utility_Filesystem::makeDirectories($errorDir);
			
			// Generate error file path
			$this->_errorFile = $errorDir . 'error_userID' . Admin_Auth::getInstance()->getUser()->user_id . '_date' . date('dmYHis') . '.log';
			
			// Remove existing error file
			if (is_file($this->_errorFile))
			{
				@unlink($this->_errorFile);
			}
			
			// Init error file object
			$errorObj = new SplFileObject($this->_errorFile, 'wb+');
			$errorObj->flock(LOCK_EX);
			
			// Create a new Reader
			$objReader = PHPExcel_IOFactory::createReaderForFile($this->_filePath);
			$objPHPExcel = $objReader->load($this->_filePath);
			
			// Advise the Reader that we only want to load cell data
			$objReader->setReadDataOnly(true);
			
		 	// Set first sheet as active
			$activeSheetObj = $objPHPExcel->setActiveSheetIndex(0); 
			
			// Skip first line of file
			$ignoreHeader = $this->getOption('ignoreHeader');
			
			// Get number of fields
			$numFields = count($this->_fields);
			if ($numFields === 0)
			{
				throw new Lumia_Imex_Exception(Lumia_Translator::get()->translate('ImportForm:@The import template were not found in database'));
			}
			
			// Set errors
			$this->_errors = array(
				'total' => 0,
				'order' => array(),
				'message' => array()
			);
			
			// Get sheet data
			$sheetData = $activeSheetObj->toArray(null, true, true, true);
			
			// Skip first line
			if ($ignoreHeader && $sheetData)
			{
				array_shift($sheetData);
			}
			
			// Iterate over contents like over an array
			$this->_preProcessingData();
			$j = 0;
			foreach ($sheetData as $rowData)
			{
				$isValid = $this->_processRow($rowData, $numFields, $j, $errorObj);
				if (!$this->_isError)
				{
					$this->_isError = !$isValid;
				}
				$j++;
			}
			$this->_postProcessingData();
			
			$errorObj->flock(LOCK_UN);
			unset($errorObj);
			
			if ($this->_isError)
			{
				$this->_errors['recordsNotFound'] = ($this->_errors['total'] == $j);
				$this->_errors['log'] = $this->_errorFile;
			} else 
			{
				// Delete error file
				unlink($this->_errorFile);
			}
			
			// Delete import file
			@unlink($this->_filePath);
		} catch (Exception $e)
		{
			$this->_whenThrowException();
			throw $e;
		}
	}
	
	/**
	 * Process each row of file's content
	 * 
	 * @param	array $rowData
	 * @param	int $numFields
	 * @param	int $lineNumber
	 * @param	SplFileObject $errorObj
	 * @return	bool
	 */
	protected function _processRow(array $rowData, $numFields, $lineNumber, $errorObj)
	{
		$this->_errors['message'][$lineNumber] = array();
		$dataInput = array();
		if (count($rowData) < $numFields)
		{
			$this->_errors['total']++;
			$this->_errors['order'][$lineNumber] = $lineNumber;
			$this->_errors['message'][$lineNumber][] = array(
				'message' => Lumia_Translator::get()->translate('ImportForm:@The line number %s is not linked with the specific fields', $lineNumber),
				'line' => $lineNumber
			);
		} else 
		{
			$datumOrder = 'A';
			$this->_errors['message'][$lineNumber] = array();
			foreach ($this->_fields as $fieldName => $instance)
			{
				// Unescape enclosures
				$rowDatum = $rowData[$datumOrder];
				if (!$instance->isValid($rowDatum))
				{
					$this->_errors['total']++;
					$this->_errors['order'][$lineNumber] = $lineNumber;
					$this->_errors['message'][$lineNumber][] = array(
							'label' => $instance->getLabel(),
							'message' => $instance->getMessages(),
							'line' => $lineNumber
					);
				} else
				{
					$dataInput[$fieldName] = $rowDatum;
				}
				
				$datumOrder++;
			}
		}
		
		if ($this->_errors['message'][$lineNumber])
		{
			$errorObj->fwrite(Zend_Json::encode($this->_errors['message'][$lineNumber]));
		} else 
		{
			unset($this->_errors['message'][$lineNumber]);
			$this->_dbHander($dataInput);
		}
		
		return empty($this->_errors['message'][$lineNumber]);
	}
	
	/**
	 * Handle data into database
	 * 
	 * @param	array $rowData
	 */
	abstract protected function _dbHander(array $rowData);
	
    /**
     * Pre-processing data
     *
     * Called before iterate over contents
     *
     * @return void
     */
    protected function _preProcessingData()
    {
    }

    /**
     * Post-processing data
     *
     * Called after iterate over contents
     *
     * @return void
     */
    protected function _postProcessingData()
    {
    }
    
	/**
     * Called when make exception
     *
     * @return void
     */
    protected function _whenThrowException()
    {
    }
}