<?php
class Admin_Form_Question extends Lumia_Form
{
	/**
	 * @var	Zend_Form_SubForm
	 */
	protected $_answersForm;
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
		
		// Set the form's attributes
		$this->setName('questionForm');
		$this->setMethod(self::METHOD_POST);
		
		// Id
		$id = new Zend_Form_Element_Hidden('question_id');
		$id->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($id);

		// Content
		$content = new Zend_Form_Element_Textarea('question_content');
		$content->setOptions(array(
				'label' => 'QuestionForm:@Content',
				'required' => true,
				'filters' => array(
					'StringTrim',
					'XSSClean'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'data-wysiwyg' => 'summernote'
		));
		$this->addElement($content);
		
		// Subject
		$subject = new Zend_Form_Element_Select('question_subject');
		$subject->setOptions(array(
				'label' => 'QuestionForm:@Subject',
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
		$subjectRows = $teacherSubjectModel->getByUser(array(Admin_Auth::getInstance()->getUser()->user_id));
		if ($subjectRows->count())
		{
			foreach ($subjectRows as $subjectRow)
			{
				$subject->addMultiOption($subjectRow->subject_id, $subjectRow->subject_name);
			}
		}
		
		$this->addElement($subject);
		
		// Chapter
		$chapter = new Zend_Form_Element_Select('question_chapter');
		$chapter->setOptions(array(
				'label' => 'QuestionForm:@Chapter',
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
		
		$this->addElement($chapter);
		
		// Level
		$level = new Zend_Form_Element_Radio('question_level');
		$level->setOptions(array(
				'label' => 'QuestionForm:@Level',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		$questionLevelModel = new Admin_Model_Question_Level();
		$questionLevelRows = $questionLevelModel->allActivate();
		if ($questionLevelRows->count())
		{
			foreach ($questionLevelRows as $levelRow)
			{
				$level->addMultiOption($levelRow->question_level_code, $this->getTranslator()->translate($levelRow->question_level_name));
			}
		}
		
		$this->addElement($level);
		
		// Status
		$status = new Zend_Form_Element_Radio('question_status');
		$status->setOptions(array(
				'label' => 'QuestionForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'QuestionForm:@Status active',
						0 => 'QuestionForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($status);
		
		// Generate form answers
		$this->_answersForm = new Zend_Form_SubForm();
		$this->addSubForm($this->_answersForm, 'dependencyAnswers');
		
		// Get answer form temporary
		$this->addNewAnswerForm('__tmp__', null);
		$tmpSubForm = $this->_answersForm->getSubForm('__tmp__');
		$this->_answersForm->removeSubForm('__tmp__');
		$tmpSubForm = $this->getView()->partial('form/per-answer.phtml', array('formElement' => $tmpSubForm));
		
		// Add to header javascript
		$this->getView()->headScript()->appendScript("LumiaJS.admin.question.tmpSubForm = " . Zend_Json::encode($tmpSubForm) . ";");
		$this->getView()->jsTranslate('Error:@An error occurred in process generate answer form');
		
		// Add new answer
		$addNewAnswer = new Zend_Form_Element_Button('btnAddNewAnswer');
		$addNewAnswer->setOptions(array(
				'label' => 'QuestionForm:@Add new answer',
				'onclick' => 'LumiaJS.admin.question.form.btnAddNewAnswer(this)',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($addNewAnswer);

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
	 * Add new answer form
	 * 
	 * @param	string $formName
	 * @param	int $answerOrder
	 * @return	void
	 */
	public function addNewAnswerForm($formName, $answerNo)
	{
		$answerForm = new Zend_Form_SubForm();
		$answerForm->setElementsBelongTo('answer[' . $formName . ']');
		$this->_answersForm->addSubForm($answerForm, $formName);
		
		// Answer content
		$answerContent = new Zend_Form_Element_Textarea('answer_content');
		$answerContent->setOptions(array(
				'label' => sprintf($this->getTranslator()->translate('QuestionForm:@Answer %s'), $answerNo),
				'required' => true,
				'filters' => array(
					'StringTrim',
					'XSSClean'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'data-wysiwyg' => 'summernote'
		));
		$answerForm->addElement($answerContent);
			
		// Is correct
		$isCorrect = new Zend_Form_Element_Checkbox('answer_is_correct');
		$isCorrect->setOptions(array(
				'label' => 'QuestionForm:@This answer is correct',
				'decorators' => array('ViewHelper')
		));
		$answerForm->addElement($isCorrect);
			
		// Remove answer
		$btnRemoveAnswer = new Zend_Form_Element_Button('btnRemovePerAnswer');
		$btnRemoveAnswer->setOptions(array(
				'label' => 'QuestionForm:@Remove answer',
				'onclick' => 'LumiaJS.admin.question.form.btnRemovePerAnswer(\'' . $answerForm->getName() . '\')',
				'decorators' => array('ViewHelper')
		));
		$answerForm->addElement($btnRemoveAnswer);
	}
	
	 /**
     * Populate form
     *
     * @param  array $data
     * @return boolean
     */
    public function populate(array $data)
    {
    	// Set form values
    	$populate = parent::populate($data);
    	
        // Get element subject
        $subject = $this->getElement('question_subject');
        
        // Get element chapter
        $chapter = $this->getElement('question_chapter');
        
        // Get all chapters by subject
        $chapterModel = new Admin_Model_Subject_Chapter();
        $chapterRows = $chapterModel->getBySubject(array($subject->getValue()));
        if ($chapterRows->count())
        {
        	foreach ($chapterRows as $chapterRow)
			{
				$chapter->addMultiOption($chapterRow->chapter_id, $chapterRow->chapter_name);
			}
        }
        $chapter->setValue($chapter->getValue());
        
        // Generate list of form answers
        $answersForm = isset($data['answer']) && is_array($data['answer']) ? $data['answer'] : array();
        $totalAnswers = count($answersForm);
        $invalid = ($totalAnswers > 0);
    	$answerNo = 'A';
		foreach ($answersForm as $answerFormName => $answerFormValues) 
		{
			$this->addNewAnswerForm($answerFormName, $answerNo++);
			$this->_answersForm->getSubForm($answerFormName)->populate($answerFormValues);
			$invalid && $invalid = empty($answerFormValues['answer_is_correct']);
		}
		
		// Validate for rule at least one answer must be checked
		if (isset($data['answer']))
		{
	        if ($invalid)
	        {
	        	$this->getElement('btnAddNewAnswer')->setErrors(array('QuestionForm:@Must have at least one answer tick is answer correct'));
	        	$this->markAsError();
	        } else 
	        {
	        	if ($totalAnswers < 2)
	        	{
	        		$this->getElement('btnAddNewAnswer')->setErrors(array('QuestionForm:@You must enter at least two answers'));
	        	}
	        }
		}
        
        return $populate;
    }
    
    /**
     * Validate the form
     *
     * @param  array $data
     * @return boolean
     */
    public function isValid($data)
    {
    	$this->populate($data);
    	return parent::isValid($data);
    }
}
