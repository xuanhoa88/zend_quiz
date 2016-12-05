<?php

class Admin_DataGrid_Teacher extends Lumia_DataGrid
{
	protected $_viewScript = 'teacher/datagrid.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('teacher_id');
        
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
        $teacherDbTable = new Admin_Db_Table_Teacher();
        $this->setDataSource($teacherDbTable->dataGrid());
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('teacher_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Name
        $nameColumnBody = new Lumia_DataGrid_Body_Text('teacher_name');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('TeacherListView:@Name');
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Code
        $codeColumnBody = new Lumia_DataGrid_Body_Text('teacher_code');
        $codeColumnHeader = new Lumia_DataGrid_Header_Text('TeacherListView:@Code');
        $this->addColumn(new Lumia_DataGrid_Column($codeColumnBody, $codeColumnHeader));
        
        // Date of birth
        $dateColumnBody = new Lumia_DataGrid_Body_Date('teacher_birth');
        $dateColumnBody->setOptions(array('dateFormat' => 'dd/MM/yyyy'));
        $dateColumnHeader = new Lumia_DataGrid_Header_Text('TeacherListView:@Date of birth');
        $this->addColumn(new Lumia_DataGrid_Column($dateColumnBody, $dateColumnHeader));
        
        // Gender
        $genderColumnBody = new Admin_DataGrid_Teacher_Body_Gender('teacher_gender');
        $genderColumnHeader = new Lumia_DataGrid_Header_Text('TeacherListView:@Gender');
        $this->addColumn(new Lumia_DataGrid_Column($genderColumnBody, $genderColumnHeader));
        
        // Department
        $departmentColumnBody = new Lumia_DataGrid_Body_Text('department_name');
        $departmentColumnHeader = new Lumia_DataGrid_Header_Text('TeacherListView:@Department');
        $this->addColumn(new Lumia_DataGrid_Column($departmentColumnBody, $departmentColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_Teacher_Body_Status('user_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('TeacherListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Teacher_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}