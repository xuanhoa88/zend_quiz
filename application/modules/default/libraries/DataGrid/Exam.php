<?php

class Default_DataGrid_Exam extends Lumia_DataGrid
{
	protected $_viewScript = 'index/datagrid.phtml';
	
    public function __construct()
    {
        $this->setPrimaryKey('exam_id');
        
        parent::__construct();
    }

    protected function _prepareDataSource()
    {
        $examStudentDbTable = new Default_Model_Exam_Student();
        $this->setDataSource($examStudentDbTable->dataGrid(array($this->getView()->studentSession()->student_id)));
    }

    protected function _prepareColumns()
    {
    	// Code
    	$codeColumnBody = new Lumia_DataGrid_Body_Text('exam_code');
    	$codeColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Code');
        $this->addColumn(new Lumia_DataGrid_Column($codeColumnBody, $codeColumnHeader));
        
        // Start time
        $startTimeColumnBody = new Lumia_DataGrid_Body_Date('exam_management_start_time');
        $startTimeColumnBody->setOptions(array('dateFormat' => 'dd/MM/yyyy HH:mm'));
        $startTimeColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Start time');
        $this->addColumn(new Lumia_DataGrid_Column($startTimeColumnBody, $startTimeColumnHeader));
        
        // Subject
        $subjectColumnBody = new Lumia_DataGrid_Body_Text('subject_name');
        $subjectColumnHeader = new Lumia_DataGrid_Header_Text('ExamListView:@Subject');
        $this->addColumn(new Lumia_DataGrid_Column($subjectColumnBody, $subjectColumnHeader));
        
        // Action column
        $actionColumnBody = new Default_DataGrid_Exam_Body_Action('gridAction');
        $actionColumnBody->addHook(array($this, 'actionColumn'));
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
	
    /**
     * Generate action column
     * 
     * @param 	array $row
     * @param	Zend_View_Interface $view
     * @return 	void
     */
    public function actionColumn($row, Zend_View_Interface $view)
    {
    	// Create object for javascript countdown
    	$row['jsCountDown'] = array();
    	
    	// Init DateTime class
    	$dateObject = Lumia_Utility_DateTime::getInstance();
    	
    	// Set date format
    	$dateFormat = 'yyyy-MM-dd HH:mm:ss';
    	
    	// Get current time
    	$currentTime = $dateObject->now($dateFormat);
    	$row['currentTime'] = $dateObject->toString('dd-MM-yyyy HH:mm');
    	$row['jsCountDown']['currentTime'] = $currentTime;
    	
    	// Set time start
    	$dateObject->set($row['exam_management_start_time'], Zend_Date::ISO_8601);
    	
    	// Get time start
    	$startTime = $dateObject->toString($dateFormat);
    	
    	// Exam invalid
    	$dateValidate = new Zend_Validate_Date($dateFormat);
    	$row['examInvalid'] = !$dateValidate->isValid($row['exam_management_start_time']);
    	
    	$row['startTime'] = $dateObject->toString('dd-MM-yyyy HH:mm');
    	$row['jsCountDown']['startTime'] = $startTime;
    	
    	// Set execution duration
    	$dateObject->addMinute($row['exam_management_execution_duration']);
    	
    	// Get time end
    	$expiredTime = $dateObject->toString($dateFormat);
    	$row['expiredTime'] = $dateObject->toString('dd-MM-yyyy HH:mm');
    	$row['jsCountDown']['expiredTime'] = $expiredTime;

    	// Fewer time allowed
    	$row['fewerTimeAllowed'] = ($startTime > $currentTime);

    	// Over time allowed
    	$row['overTimeAllowed'] = ($currentTime > $expiredTime);
    	
    	// Test whether the student have access join current exam
    	$row['allowedParticipate'] = !$row['fewerTimeAllowed'] && !$row['overTimeAllowed'];
    	
    	// Time involved
    	$dateValidate = new Zend_Validate_Date($dateFormat);
    	if (isset($row['exam_student_involved_time']) && $dateValidate->isValid($row['exam_student_involved_time']))
    	{
    		$involvedTime = Lumia_Utility_DateTime::getInstance($row['exam_student_involved_time'], Zend_Date::ISO_8601);
    		$row['involvedTime'] = $involvedTime->toString('dd-MM-yyyy HH:mm');
    		
    		// Time finished
    		$endTime = Lumia_Utility_DateTime::getInstance($row['exam_student_end_time'], Zend_Date::ISO_8601);
    		$numberOfSeconds = $endTime->sub($involvedTime)->toValue();
    		$minutes = floor($numberOfSeconds / 60);
    		$row['spentTime'] = array(
    			'minute' => $minutes,
    			'second' => $numberOfSeconds - $minutes * 60
    		);
    	}
    	
    	// Assign into view
    	$view->assign($row);
    }
    
}