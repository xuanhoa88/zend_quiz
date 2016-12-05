<?php

class Default_QuizController extends Default_Controller
{

	/**
	 * Initialize object
	 * Called from {@link __construct()} as final step of object instantiation.
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
	
		// Inject translate into javascript
		$this->view->jsTranslate(array(
			'QuizForm:@Do you want finish this test ?',
			'QuizForm:@Button yes',
			'QuizForm:@Button no',
			'QuizForm:@Go to my exams',
			'QuizForm:@You are cheating to try to complete the test'
		));
	}
	
	/**
	 * Redirect to index controller
	 */
	public function indexAction()
	{
		$this->_redirect('/index');
	}

	/**
	 * Get exam by id
	 */
	public function examAction()
	{
		$this->view->quiz = new stdClass();
		
		// Get exam id
		$examId = (string) $this->getRequest()->getParam('id', '');
		$examIdDecrypt = $this->_helper->HashID()->decrypt($examId);
		
		// Get class id
		$classId = (int) $this->view->studentSession()->class_id;
		
		// Student id
		$studentId = (int) $this->view->studentSession()->student_id;
		
		// Init exam class
		$examManagementModel = new Default_Model_Exam_Management();
		
		// Get exam
		$examManagementRow = $examManagementModel->getByExam($examIdDecrypt);
		
		// Test whether exam exists?
		if (!$examManagementRow)
		{
			$this->getRequest()->setParam('message', $this->view->translate('QuizForm:@No record found'));
			return $this->_forward('error');
		}
		
		// Checks whether exam finished?
		if ($examManagementRow->exam_student_executed)
		{
			$this->getRequest()->setParam('message', $this->view->translate('QuizForm:@You have been completed this exam'));
			return $this->_forward('error');
		}
		
		// Set date format
		$dateFormat = 'yyyy-MM-dd HH:mm:ss';
		
		// Update time involved
		$dateValidate = new Zend_Validate_Date($dateFormat);
		if (!$dateValidate->isValid($examManagementRow->exam_student_involved_time))
		{
			$studentExamModel = new Default_Model_Exam_Student();
			$studentExamModel->update(array(
					'exam_student_involved_time' => Lumia_Utility_DateTime::getInstance()->toMysql()
			), array(
					'exam_student_id = ?' => $examManagementRow->exam_student_id
			));
		}
		
		$involvedTime = Lumia_Utility_DateTime::getInstance($examManagementRow->exam_student_involved_time, Zend_Date::ISO_8601);
		$examManagementRow->exam_student_involved_time = $involvedTime->toString('dd-MM-yyyy HH:mm');
		
		// Create countdown timer
		$this->view->countdownTimer = new stdClass();
		
		// Verify exam execution time
		$dateObject = Lumia_Utility_DateTime::getInstance();
		 
		// Get current time
		$currentTime = clone $dateObject;

		// Assign into view
		$this->view->countdownTimer->fromDate = $currentTime->now($dateFormat);
		
		// Set time start
		$dateObject->set($examManagementRow->exam_management_start_time, Zend_Date::ISO_8601);
		 
		// Get time start
		$startTime = clone $dateObject;
		
		// Assign into view
		$examManagementRow->exam_management_start_time = $startTime->toString('dd-MM-yyyy HH:mm');
		
		if ($startTime->getTimestamp() >= $currentTime->getTimestamp())
		{
			$numberOfSeconds = $startTime->sub($currentTime)->toValue();
			$minutes = floor($numberOfSeconds / 60);
			$seconds = $numberOfSeconds - $minutes * 60;
			$this->getRequest()->setParam('message', $this->view->translate('QuizForm:@You may be able to do the exam within %d minute(s) %d second(s)', $minutes, $seconds));
			return $this->_forward('error');
		}
		 
		// Set execution duration
		$dateObject->addMinute($examManagementRow->exam_management_execution_duration);
		 
		// Get time end
		$expiredTime = clone $dateObject;
		
		if ($expiredTime->getTimestamp() < $currentTime->getTimestamp())
		{
			$this->getRequest()->setParam('message', $this->view->translate('QuizForm:@The exam was locked'));
			return $this->_forward('error');
		}
		
		// Assign into view
		$this->view->countdownTimer->toDate = $expiredTime->toString($dateFormat);
		
		// Assign into view
		$this->view->examManagementRow = $examManagementRow;
		$this->view->examId = $examId;
		
		// Init question class
		$examQuestionModel = new Default_Model_Exam_Question();
		
		// Get exam's questions
		$questionRows = $examQuestionModel->getByExam($examIdDecrypt);
		
		// Questions is exist?
		if (!$questionRows->count())
		{
			$this->getRequest()->setParam('message', $this->view->translate('QuizForm:@Could not find the questions of this exam'));
			return $this->_forward('error');
		}
		
		// Get first question
		$this->view->firstQuestion = $questionRows->getRow(0);
		
		$viewQuestions = array();
		$questionIds = array();
		$questionNumber = 0;
		foreach ($questionRows as $qRow)
		{
			$questionIds[] = $qRow->question_id;
			
			$row = new stdClass();
			$row->MULTI_CHOICE = 0;
			$row->QUESTION = array();
			$row->QUESTION['NUMBER'] = ++$questionNumber;
			$row->QUESTION['ID'] = $this->_helper->HashID()->encrypt($qRow->question_id);
			$row->QUESTION['DESC'] = $qRow->question_content;
			$row->ANSWERS = array();
			
			$viewQuestions[$row->QUESTION['ID']] = $row;
		}
		
		// Init answer class
		$answerQuestionModel = new Default_Model_Question_Answer();
		$answerRows = $answerQuestionModel->getByQuestion($questionIds);
		if ($answerRows->count())
		{
			foreach ($answerRows as $aRow)
			{
				$row = array();
				$row['ID'] = $this->_helper->HashID()->encrypt($aRow->answer_id);
				$row['DESC'] = $aRow->answer_content;
				$row['IS_CORRECT'] = $aRow->answer_is_correct;
				
				$mapper = $this->_helper->HashID()->encrypt($aRow->answer_question);
				if ($aRow->answer_is_correct)
				{
					$viewQuestions[$mapper]->MULTI_CHOICE++;
				}
				
				$viewQuestions[$mapper]->ANSWERS[$row['ID']] = $row;
			}
		}

		// Fetch answers have been marked
		$examQuestionAnswerModel = new Default_Model_Exam_Question_Answer();
		$answerMarkedRows = $examQuestionAnswerModel->getMarked(array(
				'exam_answer_question IN (?)' => $questionIds,
				'exam_answer_student = ?' => $studentId,
				'exam_answer_exam = ?' => $examIdDecrypt
		));
		
		$collectAnswersWereMarked = array();
		if ($answerMarkedRows->count())
		{
			foreach ($answerMarkedRows as $marked)
			{
				$collectAnswersWereMarked[] = $this->_helper->HashID()->encrypt($marked->exam_answer_answer);
			}
		}
		
		// Convert multi choice option to boolean
		$quizTemplate = array();
		foreach ($viewQuestions as $_key => $vRow)
		{
			$vRow->MULTI_CHOICE = ($vRow->MULTI_CHOICE > 1 ? 1 : 0);
			$vRow->ANSWERS_MARKED = $collectAnswersWereMarked;
			$quizTemplate[$_key] = $this->view->partial('exam/question.phtml', $vRow);
		}
		
		$this->view->quiz->template = $quizTemplate;
	}
	
	/**
	 * Get question by id
	 */
	public function questionAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Create interface response
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setError();
		
		// Get question id
		$questionId = (string) $this->getRequest()->getParam('id', '');
		$questionIdDecrypt = $this->_helper->HashID()->decrypt($questionId);
		
		// Get exam id
		$examId = (string) $this->getRequest()->getParam('exam-id', '');
		$examIdDecrypt = $this->_helper->HashID()->decrypt($examId);
		
		// Get answer id
		$answers = (array) $this->getRequest()->getParam('answer', array());
		$answersDecode = array();
		foreach ($answers as $answer)
		{
			$answersDecode[] = $this->_helper->HashID()->decrypt($answer);
		}
		
		// Student id
		$studentId = (int) $this->view->studentSession()->student_id;
		
		// Init exam class
		$examManagementModel = new Default_Model_Exam_Management();
		
		// Get exam
		$examManagementRow = $examManagementModel->getByExam($examIdDecrypt);
		
		// Exam is exist?
		if (!$examManagementRow)
		{
			$messageHandler->appendMessage($this->view->translate('QuizForm:@No record found'));
		} else 
		{
			// Checks whether exam finished?
			if ($examManagementRow->exam_student_executed)
			{
				$messageHandler->appendMessage($this->view->translate('QuizForm:@You have been completed this exam'));
			} else 
			{
				// Init question class
				$examQuestionModel = new Default_Model_Exam_Question();
				
				// Get exam's questions
				$questionRow = $examQuestionModel->getById($questionIdDecrypt);
				
				// Question is exist?
				if (!$questionRow)
				{
					$messageHandler->appendMessage($this->view->translate('QuizForm:@Question does not exists'));
				} else 
				{
					// Init answer student
					$examQuestionAnswerModel = new Default_Model_Exam_Question_Answer();
					
					// Remove all student answer for request question
					$examQuestionAnswerModel->delete(array(
							'exam_answer_student = ?' => $studentId,
							'exam_answer_exam = ?' => $examIdDecrypt,
							'exam_answer_question = ?' => $questionIdDecrypt
					));
					
					// Insert new
					foreach ($answersDecode as $answerId)
					{
						$examQuestionAnswerModel->insert(array(
							'exam_answer_student' => $studentId,
							'exam_answer_exam' => $examIdDecrypt,
							'exam_answer_question' => $questionIdDecrypt,
							'exam_answer_answer' => $answerId
						));
					}
					
					$viewQuestions = new stdClass();
					$viewQuestions->MULTI_CHOICE = (count($answersDecode) > 1 ? 1 : 0);
					$viewQuestions->QUESTION = array();
					$viewQuestions->QUESTION['ID'] = $this->_helper->HashID()->encrypt($questionRow->question_id);
					$viewQuestions->QUESTION['DESC'] = $questionRow->question_content;
					$viewQuestions->ANSWERS_MARKED = $answers;
					$viewQuestions->ANSWERS = array();
					
					// Init answer class
					$answerQuestionModel = new Default_Model_Question_Answer();
					$answerRows = $answerQuestionModel->getByQuestion(array($questionIdDecrypt));
					if ($answerRows->count())
					{
						$messageHandler->setSuccess();
						foreach ($answerRows as $aRow)
						{
							$row = array();
							$row['ID'] = $this->_helper->HashID()->encrypt($aRow->answer_id);
							$row['DESC'] = $aRow->answer_content;
							$row['IS_CORRECT'] = $aRow->answer_is_correct;
							$mapper = $this->_helper->HashID()->encrypt($aRow->answer_question);
							$viewQuestions->ANSWERS[$row['ID']] = $row;
						}
						
						$messageHandler->addContext($questionId, 'QUESTION_ID');
						$messageHandler->addContext($this->view->partial('exam/question.phtml', $viewQuestions), 'TEMPLATE');
					}
				}
			}
		}
		
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Get question by id
	 */
	public function finishAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Init response class
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->setError();
	
		// Get exam id
		$examId = (string) $this->getRequest()->getParam('exam-id', '');
		$examIdDecrypt = $this->_helper->HashID()->decrypt($examId);
	
		// Init exam class
		$examManagementModel = new Default_Model_Exam_Management();

		// Get exam by id
		$examManagementRow = $examManagementModel->getByExam($examIdDecrypt);
	
		// Exam already exist?
		if (!$examManagementRow)
		{
			$messageHandler->appendMessage($this->view->translate('QuizForm:@No record found'));
		} else 
		{
			// Checks whether exam finished?
			if ($examManagementRow->exam_student_executed)
			{
				$messageHandler->appendMessage($this->view->translate('QuizForm:@You have been completed this exam'));
			} else 
			{
				// Update time involved
				$dateValidate = new Zend_Validate_Date('yyyy-MM-dd HH:mm:ss');
				if (!$dateValidate->isValid($examManagementRow->exam_student_involved_time))
				{
					$messageHandler->appendMessage($this->view->translate('QuizForm:@You are cheating to try to complete the test'));
				} else
				{
					$messageHandler->setSuccess();
				
					// Assign into view
					$messageHandler->addContext($examId, 'EXAM_ID');
					
					// Execution done
					$studentExamModel = new Default_Model_Exam_Student();
					$studentExamModel->finishExam(array('examId' => $examIdDecrypt));
				}
			}
		}
		
		$this->getResponse()->setBody($messageHandler);
	}

	/**
	 * Display result quiz by question id
	 */
	public function resultAction()
	{
		// Get exam id
		$examId = (string) $this->getRequest()->getParam('exam-id', '');
		$examIdDecrypt = $this->_helper->HashID()->decrypt($examId);
		
		// Get class id
		$classId = (int) $this->view->studentSession()->class_id;
		
		// Student id
		$studentId = (int) $this->view->studentSession()->student_id;
		
		// Init exam class
		$examManagementModel = new Default_Model_Exam_Management();
		
		// Get exam
		$examManagementRow = $examManagementModel->getByExam($examIdDecrypt);
		
		// Test whether exam exists?
		if (!$examManagementRow)
		{
			$this->getRequest()->setParam('message', $this->view->translate('QuizForm:@No record found'));
			return $this->_forward('error');
		}
		
		// Checks whether exam finished?
		if (!$examManagementRow->exam_student_executed)
		{
			return $this->_redirect('/quiz/exam/id/' . $examId);
		}
		
		// Set date format
		$dateFormat = 'dd-MM-yyyy HH:mm:ss';
		
		// Time of start
		$startTime = Lumia_Utility_DateTime::getInstance($examManagementRow->exam_management_start_time, Zend_Date::ISO_8601);
		$examManagementRow->exam_management_start_time = $startTime->toString($dateFormat);
		
		// Time of participation
		$involvedTime = Lumia_Utility_DateTime::getInstance($examManagementRow->exam_student_involved_time, Zend_Date::ISO_8601);
		$examManagementRow->exam_student_involved_time = $involvedTime->toString($dateFormat);
		
		// Time of finish
		$endTime = Lumia_Utility_DateTime::getInstance($examManagementRow->exam_student_end_time, Zend_Date::ISO_8601);
		$examManagementRow->exam_student_end_time = $endTime->toString($dateFormat);
	
		// Assign into view
		$this->view->examManagementRow = $examManagementRow;
		
		// Time was involved
		$numberOfSeconds = $endTime->sub($involvedTime)->toValue();
		$minutes = floor($numberOfSeconds / 60);
		$this->view->spentTime = array(
				'minute' => $minutes,
				'second' => $numberOfSeconds - $minutes * 60
		);

		// Init question class
		$examQuestionModel = new Default_Model_Exam_Question();
		
		// Get exam's questions
		$questionRows = $examQuestionModel->getByExam($examIdDecrypt);

		// The questions do not exist
		if (!$questionRows->count())
		{
			$this->getRequest()->setParam('message', $this->view->translate('QuizForm:@Could not find the questions of this exam'));
			return $this->_forward('error');
		}
		
		$totalQuestions = array();
		foreach ($questionRows as $questionRow)
		{
			$totalQuestions[$questionRow->question_id] = false;
		}
		ksort($totalQuestions, SORT_NUMERIC);		
		
		// Get total answers corrected corresponding question id
		$answerQuestionModel = new Default_Model_Question_Answer();
		$correctAnswerData = $answerQuestionModel->getCorrectlyAnswers(array_keys($totalQuestions));
		$listOfCorrectAnswers = array();
		if ($correctAnswerData->count())
		{
			foreach ($correctAnswerData as $row)
			{
				$listOfCorrectAnswers[$row->answer_question][] = (int) $row->answer_id;
			}
		}
		
		// Get answers marked
		$markedQuestions = array();
		$examQuestionAnswerModel = new Default_Model_Exam_Question_Answer();
		$questionMarkedRows = $examQuestionAnswerModel->getByExam($examIdDecrypt);
		if ($questionMarkedRows->count())
		{
			foreach ($questionMarkedRows as $row)
			{
				$markedQuestions[$row->exam_answer_question][] = (int) $row->exam_answer_answer;
			}
		}
		
		$listOfCorrectQuestions = array();
		foreach ($markedQuestions as $questionId => &$answersBelongTo)
		{
			// Tick for question have been completed
			$totalQuestions[$questionId] = true;
			
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
				$listOfCorrectQuestions[$questionId] = $answersBelongTo;
			}
		}
		
		// Assign into view
		$this->view->markedQuestions = $markedQuestions;
		$this->view->correctlyQuestions = $listOfCorrectQuestions;
		$this->view->totalQuestions = $totalQuestions;
	}

	/**
	 * Error page with message
	 */
	public function errorAction()
	{
		$this->view->message = (string) $this->getRequest()->getParam('message', $this->view->translate('Error:@404 error'));
	}
}