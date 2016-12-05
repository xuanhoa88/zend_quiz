<?php

class Admin_DataGrid_Role extends Lumia_DataGrid
{
	protected $_viewScript = 'role/datagrid.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('role_id');
        $this->setOrder('role_name');
        
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
        $roleModel = new Admin_Model_Role();
        $this->setDataSource($roleModel->dataGrid());
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('role_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Name
        $nameColumnBody = new Lumia_DataGrid_Body_Text('role_name');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('RoleListView:@Name');
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Role
        $roleColumnBody = new Lumia_DataGrid_Body_Text('role_code');
        $roleColumnHeader = new Lumia_DataGrid_Header_Text('RoleListView:@Code');
        $this->addColumn(new Lumia_DataGrid_Column($roleColumnBody, $roleColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_Role_Body_Status('role_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('RoleListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Role_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}