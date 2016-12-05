<?php

class Admin_Model_Exam extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Exam');
	}
	
	/**
	 * Delete selected rows
	 * 
	 * @param 	array $selectRows
	 * @return  int
	 */
	public function deleteSelectedRows(array $selectRows)
	{
		if (empty($selectRows)) 
		{
			return 0;	
		}
		
		$this->getAdapter()->beginTransaction();
		try 
		{
			// Init class
			$examManagementModel = new Admin_Model_Exam_Management();
			$examQuestionModel = new Admin_Model_Exam_Question();
			$examStudentModel = new Admin_Model_Exam_Student();
			
			// Delete students allowed
			$examStudentModel->delete(array(
				'exam_student_exam_management IN (?)' => $examManagementModel->select(Zend_Db_Table_Abstract::SELECT_WITH_FROM_PART)
					->setIntegrityCheck(false)->reset(Zend_Db_Select::COLUMNS)
					->columns('exam_management_id')
					->where('exam_management_exam IN (?)', $selectRows) 		
			));
			
			// Delete exam
			$examManagementModel->delete(array(
					'exam_management_exam IN (?)' => $selectRows
			));
			
			// Delete questions
			$examQuestionModel->delete(array(
					'exam_question_exam IN (?)' => $selectRows
			));
			
			$deleteRows = $this->delete(array($this->getDbPrimary() . ' IN (?)' => $selectRows));
			
			$this->getAdapter()->commit();
			
			return $deleteRows;
		} catch (Zend_Db_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
	}
	
	/**
	 * Update status
	 * 
	 * @param 	array $selectRows
	 * @param	int $status
	 * @return  int
	 */
	public function updateStatus(array $selectRows, $status)
	{
		if (empty($selectRows)) 
		{
			return 0;	
		}
		
		return $this->update(
				array('exam_status' => (int) $status),
				array($this->getDbPrimary() . ' IN (?)' => $selectRows)
		);
	}
	
	/**
	 * Save data
	 * 
	 * @param	string $type
	 * @param	array $formValues
	 * @return	mixed
	 */
	public function save($type, array $formValues)
	{
		switch ($type)
		{
			case Application_Const::FORM_SAVE_MODE_ADD:
				return $this->_add($formValues);
			case Application_Const::FORM_SAVE_MODE_EDIT:
				return $this->_edit($formValues);
			default:
				throw new Application_Exception('Your action have not been defined');
					
		}
	}
	
	/**
	 * Insert data
	 * 
	 * @param	array $formValues
	 */
	protected function _add(array $formValues)
	{
		$this->getAdapter()->beginTransaction();
		try 
		{
			$examId = $this->insert(array(
	            'exam_code' => $formValues['exam_code'],
	            'exam_subject' => $formValues['exam_subject'],
	            'exam_creator' => Admin_Auth::getInstance()->getUser()->user_id,
	            'exam_status' => $formValues['exam_status'],
	            'exam_mark' => $formValues['exam_mark'],
	        	'exam_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
            ));
			
			// Exam management
			$examManagementModel = new Admin_Model_Exam_Management();
			$examManagementId = $examManagementModel->insert(array(
					'exam_management_exam' => $examId,
					'exam_management_execution_duration' => $formValues['exam_management_execution_duration'],
					'exam_management_start_time' => Lumia_Utility_DateTime::getInstance($formValues['exam_management_start_time'], 'dd-MM-yyyy HH:mm')->toString('yyyy-MM-dd HH:mm:ss')
			));
				
			// Exam students allowed
			$formStudentValues = (!empty($formValues['dependencyStudents']['exam_student']) && is_array($formValues['dependencyStudents']['exam_student']) ? $formValues['dependencyStudents']['exam_student'] : array());
			if (!$formStudentValues)
			{
				throw new Application_Exception($this->_view->translate('Error:@An error occurred in process insert new record into database'));
			}
			
			$examStudentModel = new Admin_Model_Exam_Student();
			foreach ($formStudentValues as $classId => $studentVals)
			{
				if (is_array($studentVals))
				{
					foreach ($studentVals as $studentId)
					{
						$examStudentModel->insert(array(
								'exam_student_exam_management' => $examManagementId,
								'exam_student_student' => $studentId,
								'exam_student_executed' => 0
						));
					}
				}
			}
			
			// Exam question
			$formQuestionValues = (!empty($formValues['validQuestions']) && is_array($formValues['validQuestions']) ? $formValues['validQuestions'] : array());
			if (!$formQuestionValues)
			{
				throw new Application_Exception($this->_view->translate('ExamForm:@The questions were not found within input corresponding conditions'));
			}
			
			$examQuestionModel = new Admin_Model_Exam_Question();
			foreach ($formQuestionValues as $questionId)
			{
				$examQuestionModel->insert(array(
					'exam_question_exam' => $examId,
					'exam_question_question' => (int) $questionId
				));
			}
			
// 			$formQuestionValues = (!empty($formValues['dependencyQuestions']['exam_question']) && is_array($formValues['dependencyQuestions']['exam_question']) ? $formValues['dependencyQuestions']['exam_question'] : array());
// 			if (!$formQuestionValues)
// 			{
// 				throw new Application_Exception($this->_view->translate('Error:@An error occurred in process insert new record into database'));
// 			}
			
// 			$questionModel = new Admin_Model_Question();
// 			$questionRows = $questionModel->getByChapters(array_keys($formQuestionValues));
// 			if (!$questionRows->count())
// 			{
// 				throw new Application_Exception($this->_view->translate('ExamForm:@The questions were not found within input corresponding conditions'));
// 			}
			
// 			$totalQuestions = 0;
// 			foreach($formQuestionValues as $chapterId => $questionLevels)
// 			{
// 				if (is_array($questionLevels))
// 				{
// 					foreach ($questionLevels as $questionLevel => $questionTypes)
// 					{
// 						$totalQuestions += array_sum($questionTypes);
// 					}
// 				}
// 			}
			
// 			if ($totalQuestions > $questionRows->count())
// 			{
// 				throw new Application_Exception($this->_view->translate('ExamForm:@Number of input questions greater than number of valid question in database corresponding within input conditions'));
// 			}
			
// 			$queries = array();
// 			foreach($formQuestionValues as $chapterId => $questionLevels)
// 			{
// 				if (is_array($questionLevels))
// 				{
// 					foreach ($questionLevels as $questionLevel => $questionTypes)
// 					{
// 						if (is_array($questionTypes))
// 						{
// 							foreach ($questionTypes as $questionType => $numberQuestions)
// 							{
// 								if ($numberQuestions)
// 								{
// 									$select = $questionModel->getValidQuestions();
// 									$select->where('question_subject = ?', (int) $formValues['exam_subject']);
// 									$select->where('question_chapter = ?', (int) $chapterId);
// 									$select->where('question_level = ?', (string) $questionLevel);
// 									$select->where('question_status = ?', 1);
// 									$select->where('question_type = ?', (string) $questionType);
// 									$select->limit($numberQuestions);
									
// 									$queries[] = $select;
// 								}
// 							}
// 						}
// 					}
// 				}
// 			}
			
// 			$examQuestionModel = new Admin_Model_Exam_Question();
// 			foreach ($queries as $query)
// 			{
// 					$rows = $questionModel->fetchAll($query);
// 					if ($rows->count())
// 					{
// 						foreach ($rows as $item)
// 						{
// 							$examQuestionModel->insert(array(
// 									'exam_question_exam' => $examId,
// 									'exam_question_question' => $item->question_id
// 							));
// 						}
// 					}
// 			}
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;	
		}
		
		return $examId;
	}
	
	/**
	 * Modify data
	 * 
	 * @param	array $formValues
	 */
	protected function _edit(array $formValues)
	{
		$this->getAdapter()->beginTransaction();
		try
		{
			$examId = isset($formValues['exam_id']) ? $formValues['exam_id'] : 0;
			if (!$examId)
			{
				throw new Application_Exception($this->_view->translate('Error:@An error occurred in process update existing record'));
			}
			
			$this->update(array(
	            'exam_code' => $formValues['exam_code'],
	            'exam_subject' => $formValues['exam_subject'],
	            'exam_creator' => Admin_Auth::getInstance()->getUser()->user_id,
	            'exam_status' => $formValues['exam_status'],
	            'exam_mark' => $formValues['exam_mark']
            ), array(
					'exam_id = ?' => $examId
			));
			
			// Init model
			$examManagementModel = new Admin_Model_Exam_Management();
			$examManagementRow = $examManagementModel->getByExamId($examId);
			if (empty($examManagementRow->exam_management_id))
			{
				$examManagementId = $examManagementModel->insert(array(
						'exam_management_exam' => $examId,
						'exam_management_execution_duration' => $formValues['exam_management_execution_duration'],
						'exam_management_start_time' => Lumia_Utility_DateTime::getInstance($formValues['exam_management_start_time'], 'dd-MM-yyyy HH:mm')->toString('yyyy-MM-dd HH:mm:ss')
				));
			} else 
			{
				$examManagementId = (int) $examManagementRow->exam_management_id;
				$examManagementModel->update(array(
						'exam_management_exam' => $examId,
						'exam_management_execution_duration' => $formValues['exam_management_execution_duration'],
						'exam_management_start_time' => Lumia_Utility_DateTime::getInstance($formValues['exam_management_start_time'], 'dd-MM-yyyy HH:mm')->toString('yyyy-MM-dd HH:mm:ss')
				), array(
					'exam_management_id = ?' => $examManagementId
				));
			}
			
			// Exam students allowed
			$formStudentValues = (!empty($formValues['dependencyStudents']['exam_student']) && is_array($formValues['dependencyStudents']['exam_student']) ? $formValues['dependencyStudents']['exam_student'] : array());
			if (!$formStudentValues)
			{
				throw new Application_Exception($this->_view->translate('Error:@An error occurred in process update existing record'));
			}
			
			// Init model
			$examStudentModel = new Admin_Model_Exam_Student();
			
			// Remove the students belong to this exam
			$examStudentModel->delete(array(
				'exam_student_exam_management = ?' => $examManagementId
			));
			
			// Insert new students
			foreach ($formStudentValues as $classId => $studentVals)
			{
				if (is_array($studentVals))
				{
					foreach ($studentVals as $studentId)
					{
						$examStudentModel->insert(array(
								'exam_student_exam_management' => $examManagementId,
								'exam_student_student' => $studentId,
								'exam_student_executed' => 0
						));
					}
				}
			}
				
			// Exam question
			$formQuestionValues = (!empty($formValues['validQuestions']) && is_array($formValues['validQuestions']) ? $formValues['validQuestions'] : array());
			if (!$formQuestionValues)
			{
				throw new Application_Exception($this->_view->translate('ExamForm:@The questions were not found within input corresponding conditions'));
			}
			
			// Init model
			$examQuestionModel = new Admin_Model_Exam_Question();
			
			// Remove the questions belong to this exam
			$examQuestionModel->delete(array(
				'exam_question_exam = ?' => $examId
			));
			
			// Insert new questions
			foreach ($formQuestionValues as $questionId)
			{
				$examQuestionModel->insert(array(
						'exam_question_exam' => $examId,
						'exam_question_question' => (int) $questionId
				));
			}
				
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $examId;
	}
}