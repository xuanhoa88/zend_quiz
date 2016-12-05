<?php

class Admin_DataGrid_Score extends Lumia_DataGrid
{
	/**
	 * View script
	 *
	 * @var string
	 */
	protected $_viewScript = 'score/datagrid.phtml';
	
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
        $select->columns(array('exam_management_expired_time' => new Zend_Db_Expr('DATE_ADD(exam_management_start_time, INTERVAL exam_management_execution_duration MINUTE)')));
        $select->having(new Zend_Db_Expr('exam_management_expired_time < NOW()'));
        $select->joinInner('core_department_subject', 'department_subject_subject = exam_subject', null);
        $select->joinInner('core_department', 'department_id = department_subject_department', array('department_name'));
        $select->joinInner('core_teacher_subject', 'teacher_subject_subject = subject_id', null);
        $select->joinInner('core_teacher', 'teacher_id = teacher_subject_teacher', array('teacher_name'));
       
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
    	// Code
        $codeColumnBody = new Lumia_DataGrid_Body_Text('exam_code');
        $codeColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Code');
        $this->addColumn(new Lumia_DataGrid_Column($codeColumnBody, $codeColumnHeader));
        
        // Subject
        $subjectColumnBody = new Lumia_DataGrid_Body_Text('subject_name');
        $subjectColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Subject');
        $this->addColumn(new Lumia_DataGrid_Column($subjectColumnBody, $subjectColumnHeader));
        
        // Department
        $departmentColumnBody = new Lumia_DataGrid_Body_Text('department_name');
        $departmentColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Department');
        $this->addColumn(new Lumia_DataGrid_Column($departmentColumnBody, $departmentColumnHeader));
        
        // Teacher
        $teacherColumnBody = new Lumia_DataGrid_Body_Text('teacher_name');
        $teacherColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Teacher');
        $this->addColumn(new Lumia_DataGrid_Column($teacherColumnBody, $teacherColumnHeader));
        
        // Time to expired
        $expiredTimeColumnBody = new Lumia_DataGrid_Body_Date('exam_management_expired_time');
        $expiredTimeColumnBody->setOptions(array('dateFormat' => 'dd/MM/yyyy HH:mm'));
        $expiredTimeColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Time to expired');
        $this->addColumn(new Lumia_DataGrid_Column($expiredTimeColumnBody, $expiredTimeColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Score_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}