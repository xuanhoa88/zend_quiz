<?php

class Admin_DataGrid_Exam extends Lumia_DataGrid
{
	/**
	 * View script
	 *
	 * @var string
	 */
	protected $_viewScript = 'exam/datagrid.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('exam_id');
        
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
        $examDbTable = new Admin_Db_Table_Exam();
        $select = $examDbTable->dataGridByCreator(Admin_Auth::getInstance()->getUser()->user_id);
        $select->columns(array('allowedPrinting' => new Zend_Db_Expr('IF(DATE_ADD(exam_management_start_time, INTERVAL exam_management_execution_duration MINUTE) >= NOW(), 1, 0)')));
        $select->having('allowedPrinting = ?', 1);
        
        $this->setDataSource($select);
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('exam_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Code
        $codeColumnBody = new Lumia_DataGrid_Body_Text('exam_code');
        $codeColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Code');
        $this->addColumn(new Lumia_DataGrid_Column($codeColumnBody, $codeColumnHeader));
        
        // Subject
        $subjectColumnBody = new Lumia_DataGrid_Body_Text('subject_name');
        $subjectColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Subject');
        $this->addColumn(new Lumia_DataGrid_Column($subjectColumnBody, $subjectColumnHeader));
        
        // Start time
        $startTimeColumnBody = new Lumia_DataGrid_Body_Date('exam_management_start_time');
        $startTimeColumnBody->setOptions(array('dateFormat' => 'dd/MM/yyyy HH:mm'));
        $startTimeColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Start time');
        $this->addColumn(new Lumia_DataGrid_Column($startTimeColumnBody, $startTimeColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_Exam_Body_Status('exam_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Exam_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}