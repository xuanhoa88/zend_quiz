<?php
class Admin_Form_Exam extends Lumia_Form
{
	/**
	 * @var	Zend_Form_SubForm
	 */
	protected $_questionForm;
	
	/**
	 * @var	Zend_Form_SubForm
	 */
	protected $_classesForm;
	
	/**
	 * @var	Zend_Form_SubForm
	 */
	protected $_studentForm;
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
		
		// Set the form's attributes
		$this->setName('examForm');
		$this->setMethod(self::METHOD_POST);
		
		// collection of questions
		$validQuestions = new Zend_Form_Element_Hidden('validQuestions[]');
		$this->addElement($validQuestions);
		
		// Id
		$id = new Zend_Form_Element_Hidden('exam_id');
		$id->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($id);
		
		// Code
		$code = new Zend_Form_Element_Text('exam_code');
		$code->setOptions(array(
				'label' => 'ExamForm:@Code',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($code);
		
		// Mark
		$mark = new Zend_Form_Element_Text('exam_mark');
		$mark->setOptions(array(
				'label' => 'ExamForm:@Mark',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						null => 'Form:@Unselected'
				),
				'validators' => array('NotEmpty', 'Int', array('GreaterThan', false, array('min' => 0))),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		
		$this->addElement($mark);
		
		// Subject
		$subject = new Zend_Form_Element_Select('exam_subject');
		$subject->setOptions(array(
				'label' => 'ExamForm:@Subject',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						null => 'Form:@Unselected'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		// Get all subjects which that current teacher have allow access teach
		$teacherSubjectModel = new Admin_Model_Teacher_Subject();
		$teacherSubjectRows = $teacherSubjectModel->getByUser(array(Admin_Auth::getInstance()->getUser()->user_id));
		if ($teacherSubjectRows->count())
		{
			foreach ($teacherSubjectRows as $subjectRow)
			{
				$subject->addMultiOption($subjectRow->subject_id, $subjectRow->subject_name);
			}
		}
		
		$this->addElement($subject);
		
		// Status
		$status = new Zend_Form_Element_Radio('exam_status');
		$status->setOptions(array(
				'label' => 'ExamForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'ExamForm:@Status active',
						0 => 'ExamForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($status);
		
		// Start time
		$startTime = new Zend_Form_Element_Text('exam_management_start_time');
		$startTime->setOptions(array(
				'label' => 'ExamForm:@Start time',
				'required' => true,
				'filters' => array('StringTrim', 'StripTags'),
				'validators' => array(
						'NotEmpty', 
						array('Date', false, array('format' => 'dd-MM-yyyy HH:mm')), 
						array('GreaterThan', false, array('min' => Lumia_Utility_DateTime::getInstance()->now('dd-MM-yyyy HH:mm')))
				),
				'readonly' => 'readonly',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($startTime);
		
		// Execution duration
		$startTime = new Zend_Form_Element_Text('exam_management_execution_duration');
		$startTime->setOptions(array(
				'label' => 'ExamForm:@Execution duration',
				'required' => true,
				'filters' => array('StringTrim', 'StripTags'),
				'validators' => array('NotEmpty', 'Int', array('GreaterThan', false, array('min' => 0))),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($startTime);
		
		// Create form students
		$this->_studentForm = new Zend_Form_SubForm();
		$this->addSubForm($this->_studentForm, 'dependencyStudents');
		
		// Create form classes
		$this->_classesForm = new Zend_Form_SubForm();
		$this->addSubForm($this->_classesForm, 'dependencyClasses');
		
		// Create form questions
		$this->_questionForm = new Zend_Form_SubForm();
		$this->addSubForm($this->_questionForm, 'dependencyQuestions');
		
		// Save button
		$submit = new Zend_Form_Element_Submit('btnSave');
		$submit->setOptions(array(
				'label' => 'Form:@Button save',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($submit);

		// Reset button
		$submit = new Zend_Form_Element_Button('btnReset');
		$submit->setOptions(array(
				'label' => 'Form:@Button reset',
				'type' => 'reset',
				'decorators' => array('ViewHelper')
		));

		$this->addElement($submit);
	}
	
	/**
	 * Create form questions
	 * 
	 * @param 	int $subjectId
	 * @return	void
	 */
	public function createFormQuestionsBySubject($subjectId)
	{
		$subjectId = (int) $subjectId;
		
		// Get chapters
		$chapterModel = new Admin_Model_Subject_Chapter();
		$chapterRows = $chapterModel->getBySubject(array($subjectId));
		
		if ($chapterRows->count())
		{
			// Get question levels
			$questionLevelModel = new Admin_Model_Question_Level();
			$questionLevelRows = $questionLevelModel->allActivate();
			
			// Set question types
			$questionTypeRows = array(
					array(
							'KEY' => Application_Const::QUESTION_TYPE_ESSAY,
							'TEXT' => $this->getView()->translate('ExamForm:@Essay')
					),
					array(
							'KEY' => Application_Const::QUESTION_TYPE_TEST,
							'TEXT' => $this->getView()->translate('ExamForm:@Test')
					)
			);
			$this->getView()->questionTypeRows = $questionTypeRows;
			
			$collectChapters = array();
			foreach ($chapterRows as $chapterRow)
			{
				$collectChapters[] = $chapterRow->chapter_id;
				
				if ($questionLevelRows->count())
				{
					$this->getView()->questionLevelRows = $questionLevelRows;
					foreach ($questionLevelRows as $questionLevelRow)
					{
						$questionLevelForm = new Zend_Form_SubForm();
						$questionLevelForm->setElementsBelongTo('exam_question[' . $chapterRow->chapter_id . '][' . $questionLevelRow->question_level_code . ']');
						$this->_questionForm->addSubForm($questionLevelForm, $chapterRow->chapter_id . $questionLevelRow->question_level_code);
						
						foreach ($questionTypeRows as $questionType)
						{
							// Total question
							$total = new Zend_Form_Element_Text($questionType['KEY']);
							$total->setOptions(array(
									'label' => $questionType['KEY'],
									'required' => false,
									'onChange' => 'LumiaJS.admin.exam.calcNumberInputQuestions(this, \'' . $questionLevelRow->question_level_code . '-' . $questionType['KEY'] . '\')',
									'onfocus' => 'this.select()',
									'filters' => array('StringTrim', 'StripTags', 'Int'),
									'validators' => array('NotEmpty', 'Int'),
									'decorators' => array('ViewHelper')
							));
							
							$questionLevelForm->addElement($total);
						}
					}
				}
			}
			
			$questionModel = new Admin_Model_Question();
			$questionRows = $questionModel->getByChapter($collectChapters);
			
			$calcNumberValidQuestions = array();
			if ($questionRows->count())
			{
				foreach ($questionRows as $questionRow)
				{
					if (!isset($calcNumberValidQuestions[$questionRow->question_level_code][$questionRow->question_type]))
					{
						$calcNumberValidQuestions[$questionRow->question_level_code][$questionRow->question_type] = 0;
					}
					
					$calcNumberValidQuestions[$questionRow->question_level_code][$questionRow->question_type]++;
				}
			}
			
			// Assign into view
			$this->getView()->calcNumberValidQuestions = $calcNumberValidQuestions;
			$this->getView()->numberQuestionsAvailable = $questionRows->count();
			$this->getView()->chapterRows = $chapterRows;
		}
	}
	
	/**
	 * Create form students
	 * 
	 * @var	array $students
	 * @return void
	 */
	public function createFormStudents(array $students)
	{
		$studentModel = new Admin_Model_Student();
		$studentRows = $studentModel->getByStudent($students);
		
		if ($studentRows->count())
		{
			$this->getView()->studentRows = $studentRows;
			$this->_studentForm->clearSubForms();
			
			foreach ($studentRows as $studentRow)
			{
				$studentForm = new Zend_Form_SubForm();
				$studentForm->setElementsBelongTo('exam_student[' . $studentRow->class_id . ']');
				$this->_studentForm->addSubForm($studentForm, $studentRow->student_id);
				
				// Total question
				$id = new Zend_Form_Element_Hidden($studentRow->student_id);
				$id->setOptions(array(
						'required' => true,
						'value' => $studentRow->student_id,
						'filters' => array('StringTrim', 'StripTags', 'Int'),
						'validators' => array('NotEmpty', 'Int', array('GreaterThan', false, array('min' => 0))),
						'decorators' => array('ViewHelper')
				));
				$studentForm->addElement($id);
			}
		}
	}
	
	/**
	 * Create form classes
	 * 
	 * @param 	int $subjectId
	 * @return	void
	 */
	public function createFormClassesBySubject($subjectId)
	{
		// Get classes
		$classesModel = new Admin_Model_Classes();
		$classesRows = $classesModel->getBySubject(array($subjectId));
		if ($classesRows->count())
		{
			$this->getView()->classesRows = $classesRows;
			
			$classesId = array();
			foreach ($classesRows as $classesRow)
			{
				$classesId[] = $classesRow->class_id;
				
				$classesForm = new Zend_Form_SubForm();
				$classesForm->setElementsBelongTo('exam_classes');
				$this->_classesForm->addSubForm($classesForm, $classesRow->class_id);
				
				$classes = new Zend_Form_Element_Checkbox($classesRow->class_id);
				$classes->setOptions(array(
						'label' => $classesRow->class_name,
						'required' => true,
						'checkedValue' => $classesRow->class_id,
						'onClick' => 'LumiaJS.admin.exam.injectStudentsAllowed(this)',
						'filters' => array('StringTrim', 'StripTags', 'Int'),
						'validators' => array('NotEmpty', 'Int'),
						'decorators' => array('ViewHelper')
				));
				$classesForm->addElement($classes);
				
				$btnViewStudents = new Zend_Form_Element_Button('btnViewStudents' . $classesRow->class_id);
				$btnViewStudents->setOptions(array(
						'label' => $this->getView()->translate('ExamForm:@View students'),
						'required' => false,
						'onClick' => 'LumiaJS.admin.exam.manageStudentsByClasses(' . $classesRow->class_id . ')',
						'decorators' => array('ViewHelper')
				));
				$classesForm->addElement($btnViewStudents);
			}
			
			// Get student
			$studentModel = new Admin_Model_Student();
			$studentRows = $studentModel->getByClasses($classesId);
			
			if ($studentRows->count())
			{
				$this->getView()->examStudentsByClasses = array();
				foreach ($studentRows as $studentRow)
				{
					$studentForm = new Zend_Form_SubForm();
					$studentForm->setElementsBelongTo('exam_student[' . $studentRow->class_id . ']');
					$this->_studentForm->addSubForm($studentForm, $studentRow->student_id);
					
					// Total questions
					$id = new Zend_Form_Element_Hidden($studentRow->student_id);
					$id->setOptions(array(
							'required' => true,
							'value' => $studentRow->student_id,
							'filters' => array('StringTrim', 'StripTags', 'Int'),
							'validators' => array('NotEmpty', 'Int', array('GreaterThan', false, array('min' => 0))),
							'decorators' => array('ViewHelper')
					));
					$studentForm->addElement($id);
					
					$this->getView()->examStudentsByClasses[$studentRow->class_id][$studentRow->student_id] = $id->render();
				}
				
				if (!Zend_Controller_Front::getInstance()->getRequest()->isXmlHttpRequest()) 
				{
					$this->getView()->headScript()->appendScript("LumiaJS.admin.exam.studentsByClasses = " . Zend_Json::encode($this->getView()->examStudentsByClasses) . ";");
				}
			}
		}
	}
	
	/**
	 * Populate form
	 *
	 * Proxies to {@link setDefaults()}
	 *
	 * @param  array $values
	 * @return Zend_Form
	 */
	public function populate(array $values)
	{
		// Set subject
		$values['exam_subject'] = isset($values['exam_subject']) ? (int) $values['exam_subject'] : 0;
		
		// Set students
		$values['exam_student'] = isset($values['exam_student']) && is_array($values['exam_student']) ? $values['exam_student'] : array();
		
		// Create form classes
		$this->createFormClassesBySubject($values['exam_subject']);
		
		// Create form questions
		$this->createFormQuestionsBySubject($values['exam_subject']);
		
		// Create form students
		if ($values['exam_student'])
		{
			$studentValues = new RecursiveIteratorIterator(new RecursiveArrayIterator($values['exam_student']));
			$this->createFormStudents(iterator_to_array($studentValues));
		}
		
		return parent::populate($values);
	}
	
	/**
	 * Calculate number of questions
	 * 
	 * @param	array $questions
	 * @return	void
	 */
	protected function _calNumberOfQuestion(array $questions)
	{
		
	}
    
    /**
     * Validate the form
     *
     * @param  array $data
     * @return boolean
     */
    public function isValid($data)
    {
    	$populate = $this->populate($data);
    	
    	// Get form classes values
    	$formClassesValues = $populate->getSubForm('dependencyClasses')->getValidValues($data, true);
    	$classValues = isset($formClassesValues['exam_classes']) && is_array($formClassesValues['exam_classes']) ? $formClassesValues['exam_classes'] : array();
    	
    	if ($classValues)
    	{
    		if (array_filter($classValues)) 
    		{
	    		// Get form student values
    			$formStudentValues = $populate->getSubForm('dependencyStudents')->getValidValues($data, true);
	    		$studentValues = isset($formStudentValues['exam_student']) && is_array($formStudentValues['exam_student']) ? $formStudentValues['exam_student'] : array();
	    		if ($studentValues)
	    		{
			    	// Validate form
			    	$isValid = parent::isValid($data);
	    		} else
	    		{
	    			// Validate form
	    			parent::isValid($data);
	    			
	    			$isValid = false;
	    			$this->_studentForm->addError($this->getView()->translate('ExamForm:@The students were not found in list classes selected'));
	    		}
    		} else
    		{
    			// Validate form
    			parent::isValid($data);
    			
    			$isValid = false;
    			$this->_studentForm->addError($this->getView()->translate('ExamForm:@You must select at least one class'));
    		}
    		
    		// Get form question values
    		$formQuestionValues = $populate->getSubForm('dependencyQuestions')->getValidValues($data, true);
    		$questionValues = isset($formQuestionValues['exam_question']) && is_array($formQuestionValues['exam_question']) ? $formQuestionValues['exam_question'] : array();
    		$totalQuestions = 0;
    		$calcNumberInputQuestions = array();
    		foreach ($questionValues as $chapterId => $questionLevels)
    		{
    			if (is_array($questionLevels))
    			{
    				foreach ($questionLevels as $questionLevel => $questionTypes)
    				{
    					if (is_array($questionTypes))
    					{
    						$totalQuestions += array_sum($questionTypes);
    						foreach ($questionTypes as $questionType => $numberQuestions)
    						{
    							if (!isset($calcNumberInputQuestions[$questionLevel][$questionType]))
    							{
    								$calcNumberInputQuestions[$questionLevel][$questionType] = 0;
    							}
    							
    							$calcNumberInputQuestions[$questionLevel][$questionType] += $numberQuestions;
    						}
    					}
    				}
    			}
    		}
    		
    		// Assign into view
    		$this->getView()->calcNumberInputQuestions = $calcNumberInputQuestions;
    		
    		// Add error message
    		if ($totalQuestions <= 0)
    		{
    			$isValid = false;
    			$this->_questionForm->addError($this->getView()->translate('ExamForm:@You must enter questions with valid values'));
    		} else
    		{
    			if ($totalQuestions > $this->getView()->numberQuestionsAvailable)
    			{
    				$isValid = false;
    				$this->_questionForm->addError($this->getView()->translate('ExamForm:@Number of input questions greater than number of valid question in database corresponding within input conditions'));
    			} else
    			{
    				$questionModel = new Admin_Model_Question();
    				$validQuestions = array();
    				foreach($questionValues as $chapterId => $questionLevels)
    				{
    					if (is_array($questionLevels))
    					{
    						foreach ($questionLevels as $questionLevel => $questionTypes)
    						{
    							if (is_array($questionTypes))
    							{
    								foreach ($questionTypes as $questionType => $numberQuestions)
    								{
    									if ($numberQuestions)
    									{
    										$select = $questionModel->getValidQuestions();
    										$select->where('question_subject = ?', (int) $this->getElement('exam_subject')->getValue());
    										$select->where('question_chapter = ?', (int) $chapterId);
    										$select->where('question_level = ?', (string) $questionLevel);
    										$select->where('question_status = ?', 1);
    										$select->where('question_type = ?', (string) $questionType);
    										$select->limit($numberQuestions);
    										
    										$rows = $questionModel->fetchAll($select);
    										if ($rows->count())
    										{
    											foreach ($rows as $item)
    											{
    												$validQuestions[] = $item->question_id;
    											}
    										}
    									}
    								}
    							}
    						}
    					}
    				}
    				
    				if ($validQuestions)
    				{
    					$isValid = $isValid && true;
    					$this->getElement('validQuestions')->setValue($validQuestions);
    				} else
    				{
    					$isValid = false;
    					$this->_questionForm->addError($this->getView()->translate('ExamForm:@The questions were not found within input corresponding conditions'));
    				}
    			}
    		}
    		
    	} else
    	{
    		// Validate form
    		parent::isValid($data);
    		
    		$isValid = false;
    		$this->_studentForm->addError($this->getView()->translate('ExamForm:@The classes were not found corresponding subject selected'));
    	}
    	
    	return $isValid;
    }
}
