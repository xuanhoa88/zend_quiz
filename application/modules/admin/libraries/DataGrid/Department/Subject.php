<?php

class Admin_DataGrid_Department_Subject extends Lumia_DataGrid
{
	protected $_viewScript = 'department/datagrid/manage-subjects.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('department_subject_id');
        
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
    	// Get department id
    	$department = (int) $this->getRequest()->getParam('id', 0);
    	
        $subjectDbTable = new Admin_Db_Table_Subject();
        $this->setDataSource($subjectDbTable->dataGridByDepartment($department));
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('subject_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Name
        $nameColumnBody = new Lumia_DataGrid_Body_Text('subject_name');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('SubjectListView:@Name');
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Department_Body_Action_Subject();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}