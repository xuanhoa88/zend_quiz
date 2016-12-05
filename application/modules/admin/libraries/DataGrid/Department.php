<?php

class Admin_DataGrid_Department extends Lumia_DataGrid
{
	protected $_viewScript = 'department/datagrid.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('department_id');
        
        parent::__construct();
    }

    /**
     * Prepare data source
     * 
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareDataSource()
     */
    protected function _prepareDataSource()
    {
        $departmentDbTable = new Admin_Db_Table_Department();
        $this->setDataSource($departmentDbTable->dataGrid());
    }
	
    /**
     * Prepare columns in data grid
     * 
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareColumns()
     */
    protected function _prepareColumns()
    {
    	// Checkbox
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('department_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Name
        $nameColumnBody = new Lumia_DataGrid_Body_Text('department_name');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('DepartmentListView:@Name');
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Code
        $codeColumnBody = new Lumia_DataGrid_Body_Text('department_code');
        $codeColumnHeader = new Lumia_DataGrid_Header_Text('DepartmentListView:@Code');
        $this->addColumn(new Lumia_DataGrid_Column($codeColumnBody, $codeColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_Department_Body_Status('department_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('DepartmentListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Department_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
    
    /**
     * Prepare filters in data grid
     *
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareFilters()
     */
    protected function _prepareFilters()
    {
    	$this->addFilterElement('departmentName')->setAttrib('placeholder', Lumia_Translator::get()->translate('DepartmentListView:@Enter your department name or department code'));
    	$this->getFilter()->setClauses(array(
    		'OR' => array(
	    		'department_name LIKE ?' => '%departmentName%',
	    		'department_code LIKE ?' => '%departmentName%'
    		)
    	));
    }
}