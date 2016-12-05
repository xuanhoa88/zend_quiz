<?php

class Admin_Imex_Import_Teacher extends Lumia_Imex_Import
{
	/**
	 * @var Lumia_Db_Table
	 */
	protected $_dbTable;
	
	/**
     * Pre-processing data
     *
     * Called before iterate over contents
     *
     * @return void
     */
    protected function _preProcessingData()
    {
    	$this->_dbTable = new Admin_Db_Table_Teacher();
    	$this->_dbTable->getAdapter()->beginTransaction();
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
    	if ($this->hasErrors())
    	{
    		$this->_dbTable->getAdapter()->rollBack();
    	} else
    	{
    		$this->_dbTable->getAdapter()->commit();
    	}
    }
    
	/**
     * Called when make exception
     *
     * @return void
     */
    protected function _whenThrowException()
    {
    	$this->_dbTable->getAdapter()->rollBack();
    }
	
	/**
	 * Handle data into database
	 *
	 * @param	array $rowData
	 */
	protected function _dbHander(array $formValues)
	{
		
	}
}
