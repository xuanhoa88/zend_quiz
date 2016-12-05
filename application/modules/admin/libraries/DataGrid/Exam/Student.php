<?php

class Admin_DataGrid_Exam_Student extends Admin_DataGrid_Student
{
	/**
	 * @var string
	 */
	protected $_viewScript = 'exam/get-students-by-classes/datagrid.phtml';

	/**
	 * @var Zend_Config
	 */
	protected $_options;
	
	/**
	 * Constructor
	 */
    public function __construct(array $options = array())
    {
    	$this->_options = new Zend_Config($options);
    	
        parent::__construct();
        
        $this->getPaginator()->setItemCountPerPage(1000);
    }

    /**
     * Prepare data source
     * 
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareDataSource()
     */
    protected function _prepareDataSource()
    {
        $studentDbTable = new Admin_Db_Table_Student();
        $this->setDataSource($studentDbTable->getByClasses(array($this->_options->classesId)));
    }
	
    /**
     * Prepare columns in data grid
     * 
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareColumns()
     */
    protected function _prepareColumns()
    {
    	parent::_prepareColumns();
    	unset($this->_columns['actionColumn']);
    }
}