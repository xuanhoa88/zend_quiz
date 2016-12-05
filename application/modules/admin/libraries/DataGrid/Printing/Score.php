<?php

class Admin_DataGrid_Printing_Score extends Lumia_DataGrid
{
	/**
	 * View script
	 *
	 * @var string
	 */
	protected $_viewScript = 'printing/datagrid/score.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('exam_id');
        
        parent::__construct();
        
        // Assign into view
        $configuration = Application_Model_Configuration::getInstance();
        $this->getView()->ministryBrand = $configuration->get('ministryBrand');
        $this->getView()->ministryBrand = 'BỘ CÔNG AN';
        $this->getView()->schoolName = $configuration->get('schoolName');
        $this->getView()->schoolName = 'CĐANND I';
        $this->getView()->nationalBrand = $configuration->get('nationalBrand');
        $this->getView()->nationalBrand = 'Cộng hòa xã hội chủ nghĩa Việt Nam';
        $this->getView()->nationalMotto = $configuration->get('nationalMotto');
        $this->getView()->nationalMotto = 'Độc lập - Tự do - Hạnh phúc';
    }
	
    /**
     * Prepare data source
     * 
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareDataSource()
     */
    protected function _prepareDataSource()
    {
    	// Get students according to exam
        $examStudentDbTable = new Admin_Db_Table_Exam_Score();
        $this->setDataSource($examStudentDbTable->getStudentsByExam(array($this->getOption('examID'))));
    }
	
    /**
     * Prepare columns in data grid
     * 
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareColumns()
     */
    protected function _prepareColumns()
    {
    	// Get exam
    	$examId = (int) $this->getOption('examID');
    	
    	// Init question class
    	$examQuestionModel = new Admin_Db_Table_Exam_Question();
    	$questionRows = $examQuestionModel->getByExam($examId);
    	
    	// The questions exist
    	if ($questionRows->count())
    	{
    		$numberOfQuestions = array();
    		foreach ($questionRows as $questionRow)
    		{
    			$numberOfQuestions[$questionRow->question_id] = false;
    		}
    		ksort($numberOfQuestions, SORT_NUMERIC);
    		 
    		// Get total answers corrected corresponding question id
    		$answerQuestionModel = new Admin_Db_Table_Question_Answer();
    		$correctAnswerData = $answerQuestionModel->getCorrectlyAnswers(array_keys($numberOfQuestions));
    		$listOfCorrectAnswers = array();
    		if ($correctAnswerData->count())
    		{
    			foreach ($correctAnswerData as $row)
    			{
    				$listOfCorrectAnswers[$row->answer_question][] = (int) $row->answer_id;
    			}
    		}
    		 
    		// Get answers marked group by student
    		$studentQuestionsMarked = array();
    		$examQuestionAnswerModel = new Admin_Db_Table_Exam_Question_Answer();
    		$questionMarkedRows = $examQuestionAnswerModel->getByExam($examId);
    		 
    		if ($questionMarkedRows->count())
    		{
    			foreach ($questionMarkedRows as $row)
    			{
    				if (!array_key_exists($row->exam_answer_student, $studentQuestionsMarked))
    				{
    					$studentQuestionsMarked[$row->exam_answer_student] = array();
    				}
    				 
    				$studentQuestionsMarked[$row->exam_answer_student][$row->exam_answer_question][] = (int) $row->exam_answer_answer;
    			}
    		}
    		 
    		$listOfCorrectQuestions = array();
    		$listOfCompleteQuestions = array();
    		if ($studentQuestionsMarked)
    		{
    			foreach ($studentQuestionsMarked as $studentId => $questionsMarked)
    			{
    				$listOfCorrectQuestions[$studentId] = array();
    				$listOfCompleteQuestions[$studentId] = array();
    				foreach ($questionsMarked as $questionId => &$answersBelongTo)
    				{
    					// Tick for question have been completed
    					$listOfCompleteQuestions[$studentId][$questionId] = true;
    					 
    					if (!$listOfCorrectAnswers
    							|| !array_key_exists($questionId, $listOfCorrectAnswers)
    							|| !$answersBelongTo
    							|| !is_array($answersBelongTo)
    							|| !is_array($listOfCorrectAnswers[$questionId])
    					)
    					{
    						continue;
    					}
    					 
    					sort($answersBelongTo, SORT_NUMERIC);
    					sort($listOfCorrectAnswers[$questionId], SORT_NUMERIC);
    					 
    					if ($listOfCorrectAnswers[$questionId] === $answersBelongTo)
    					{
    						$listOfCorrectQuestions[$studentId][$questionId] = $answersBelongTo;
    					}
    				}
    			}
    		}
    	}
    	
    	// Order
    	$orderColumnBody = new Admin_DataGrid_Printing_Body_Score_Order('student_order');
    	$orderColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Order');
    	$this->addColumn(new Lumia_DataGrid_Column($orderColumnBody, $orderColumnHeader));
    	
    	// Student name
        $studentNameColumnBody = new Lumia_DataGrid_Body_Text('student_name');
        $studentNameColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Student name');
        $this->addColumn(new Lumia_DataGrid_Column($studentNameColumnBody, $studentNameColumnHeader));
        
        // Student code
        $studentCodeColumnBody = new Lumia_DataGrid_Body_Text('student_code');
        $studentCodeColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Student code');
        $this->addColumn(new Lumia_DataGrid_Column($studentCodeColumnBody, $studentCodeColumnHeader));
        
        // Student birthday
        $studentBirthColumnBody = new Lumia_DataGrid_Body_Date('student_birth');
        $studentBirthColumnBody->setOptions(array('dateFormat' => 'dd/MM/yyyy'));
        $studentBirthColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Birthday');
        $this->addColumn(new Lumia_DataGrid_Column($studentBirthColumnBody, $studentBirthColumnHeader));
        
        // Student Identification
//         $identificationColumnBody = new Lumia_DataGrid_Body_Text('student_identification');
//         $identificationColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Identification');
//         $this->addColumn(new Lumia_DataGrid_Column($identificationColumnBody, $identificationColumnHeader));
        
        // Student gender
        $studentGenderColumnBody = new Admin_DataGrid_Student_Body_Gender('student_gender');
        $studentGenderColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Gender');
        $this->addColumn(new Lumia_DataGrid_Column($studentGenderColumnBody, $studentGenderColumnHeader));
        
        // Class and Department
        $classDepartmentColumnBody = new Lumia_DataGrid_Body_Text('combine_class_department');
        $classDepartmentColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Class / Department');
        $this->addColumn(new Lumia_DataGrid_Column($classDepartmentColumnBody, $classDepartmentColumnHeader));
        
        // Student address
//         $addressColumnBody = new Lumia_DataGrid_Body_Text('address_line');
//         $addressColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Address');
//         $this->addColumn(new Lumia_DataGrid_Column($addressColumnBody, $addressColumnHeader));
        
        // Test score
        $scoreColumnBody = new Admin_DataGrid_Printing_Body_Score_Score('exam_score');
        $scoreColumnBody->setOptions(array(
        	'listOfCorrectQuestions' => isset($listOfCorrectQuestions) ? $listOfCorrectQuestions : array(),
        	'numberOfQuestions' => isset($numberOfQuestions) ? $numberOfQuestions : 0
        ));
        $scoreColumnHeader = new Lumia_DataGrid_Header_Text('Score:@Score');
        $this->addColumn(new Lumia_DataGrid_Column($scoreColumnBody, $scoreColumnHeader));
    }
    
    public function deploy($viewScript = NULL)
    {
    	// Get exam id
    	$examID = (int) $this->getOption('examID', 0);
    	
    	// Init model
    	$examModel = new Admin_Model_Exam();
    	$examRow = $examModel->getById($examID);
    	
    	// Get subject name
    	$subjectModel = new Admin_Model_Subject();
    	$subjectRow = $subjectModel->getById(isset($examRow->exam_subject) ? (int) $examRow->exam_subject : 0);
    	$this->getView()->subjectName = isset($subjectRow->subject_name) ? (string) $subjectRow->subject_name : '';
    	
    	// Init model
    	$examManagementModel = new Admin_Model_Exam_Management();
    	$examManagementRow = $examManagementModel->getByExamId(isset($examRow->exam_id) ? (int) $examRow->exam_id : 0);
    	
    	// Get start date
    	$this->getView()->startDate = isset($examManagementRow->exam_management_start_time) ? Lumia_Utility_DateTime::getInstance($examManagementRow->exam_management_start_time, Zend_Date::ISO_8601)->toString('dd/MM/yyyy HH:mm') : '';
    	
    	// Get execution time
    	$this->getView()->executionTime = isset($examManagementRow->exam_management_execution_duration) ? $this->getView()->translate('Score:@%d minute(s)', $examManagementRow->exam_management_execution_duration) : '';
    	
    	// Get number of students
    	$examStudentModel = new Admin_Model_Exam_Student();
    	$this->getView()->numberOfStudents = $examStudentModel->getNumberOfStudentsByExamId(isset($examRow->exam_id) ? (int) $examRow->exam_id : 0);
    	
    	return parent::deploy($viewScript);
    }
}