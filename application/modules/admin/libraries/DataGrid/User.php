<?php

class Admin_DataGrid_User extends Lumia_DataGrid
{
	protected $_viewScript = 'user/datagrid.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('user_id');
        
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
        $userDbTable = new Admin_Db_Table_User();
        $this->setDataSource($userDbTable->dataGrid());
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('user_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Name
        $nameColumnBody = new Lumia_DataGrid_Body_Text('user_name');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('UserListView:@Name');
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Role
        $roleColumnBody = new Admin_DataGrid_User_Body_Role('role_name');
        $roleColumnHeader = new Lumia_DataGrid_Header_Text('UserListView:@Role');
        $this->addColumn(new Lumia_DataGrid_Column($roleColumnBody, $roleColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_User_Body_Status('user_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('UserListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_User_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}