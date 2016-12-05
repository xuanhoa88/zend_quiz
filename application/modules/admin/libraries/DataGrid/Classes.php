<?php

class Admin_DataGrid_Classes extends Lumia_DataGrid
{
	protected $_viewScript = 'classes/datagrid.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('class_id');
        
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
        $classesDbTable = new Admin_Db_Table_Classes();
        $this->setDataSource($classesDbTable->dataGrid());
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('class_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Name
        $nameColumnBody = new Lumia_DataGrid_Body_Text('class_name');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('ClassListView:@Name');
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Code
        $codeColumnBody = new Lumia_DataGrid_Body_Text('class_code');
        $codeColumnHeader = new Lumia_DataGrid_Header_Text('ClassListView:@Code');
        $this->addColumn(new Lumia_DataGrid_Column($codeColumnBody, $codeColumnHeader));
        
        // Homeroom teacher
        $homeroomTeacherColumnBody = new Lumia_DataGrid_Body_Text('teacher_name');
        $homeroomTeacherColumnHeader = new Lumia_DataGrid_Header_Text('ClassListView:@Homeroom teacher');
        $this->addColumn(new Lumia_DataGrid_Column($homeroomTeacherColumnBody, $homeroomTeacherColumnHeader));
        
        // Department
        $departmentColumnBody = new Lumia_DataGrid_Body_Text('department_name');
        $departmentColumnHeader = new Lumia_DataGrid_Header_Text('ClassListView:@Department');
        $this->addColumn(new Lumia_DataGrid_Column($departmentColumnBody, $departmentColumnHeader));
        
        // Period
        $periodColumnBody = new Lumia_DataGrid_Body_Text('class_period');
        $periodColumnHeader = new Lumia_DataGrid_Header_Text('ClassListView:@Period');
        $this->addColumn(new Lumia_DataGrid_Column($periodColumnBody, $periodColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_Classes_Body_Status('class_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('ClassListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Classes_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}