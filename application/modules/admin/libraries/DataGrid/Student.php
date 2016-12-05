<?php

class Admin_DataGrid_Student extends Lumia_DataGrid
{
	protected $_viewScript = 'student/datagrid.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('student_id');
        
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
        $studentDbTable = new Admin_Db_Table_Student();
        $this->setDataSource($studentDbTable->dataGrid());
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('student_id[]');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Name
        $nameColumnBody = new Lumia_DataGrid_Body_Text('student_name');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('StudentListView:@Name');
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Code
        $codeColumnBody = new Lumia_DataGrid_Body_Text('student_code');
        $codeColumnHeader = new Lumia_DataGrid_Header_Text('StudentListView:@Code');
        $this->addColumn(new Lumia_DataGrid_Column($codeColumnBody, $codeColumnHeader));
        
        // Date of birth
        $dateColumnBody = new Lumia_DataGrid_Body_Date('student_birth');
        $dateColumnBody->setOptions(array('dateFormat' => 'dd/MM/yyyy'));
        $dateColumnHeader = new Lumia_DataGrid_Header_Text('StudentListView:@Date of birth');
        $this->addColumn(new Lumia_DataGrid_Column($dateColumnBody, $dateColumnHeader));
        
        // Gender
        $genderColumnBody = new Admin_DataGrid_Student_Body_Gender('student_gender');
        $genderColumnHeader = new Lumia_DataGrid_Header_Text('StudentListView:@Gender');
        $this->addColumn(new Lumia_DataGrid_Column($genderColumnBody, $genderColumnHeader));
        
        // Class
        $classColumnBody = new Lumia_DataGrid_Body_Text('class_department');
        $classColumnHeader = new Lumia_DataGrid_Header_Text('StudentListView:@Class/Department');
        $this->addColumn(new Lumia_DataGrid_Column($classColumnBody, $classColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_Student_Body_Status('user_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('StudentListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Student_Body_Action('actionColumn');
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}