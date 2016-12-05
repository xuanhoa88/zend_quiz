<?php

class Admin_Model_Question extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Question');
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
		
		$answerModel = new Admin_Model_Question_Answer();
		$answerModel->delete(array(
				'answer_question IN (?)' => $selectRows
		));
		
		return $this->delete(array($this->getDbPrimary() . ' IN (?)' => $selectRows));
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
				array('question_status' => (int) $status),
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
			// Get list of answers
			$listAnswers = isset($formValues['dependencyAnswers']['answer']) && is_array($formValues['dependencyAnswers']['answer']) ? $formValues['dependencyAnswers']['answer'] : array();
			
			// Insert question
			$questionId = $this->insert(array(
					'question_content' => $formValues['question_content'],
					'question_subject' => $formValues['question_subject'],
					'question_chapter' => $formValues['question_chapter'],
					'question_level' => $formValues['question_level'],
					'question_type' => (count($listAnswers) > 0 ? Application_Const::QUESTION_TYPE_TEST : Application_Const::QUESTION_TYPE_ESSAY),
					'question_creator' => Admin_Auth::getInstance()->getUser()->user_id,
					'question_status' => $formValues['question_status'],
					'question_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			// Insert answer
			$answerModel = new Admin_Model_Question_Answer();
			foreach ($listAnswers as $answerItem)
			{
				$answerModel->insert(array(
						'answer_content' => $answerItem['answer_content'],
						'answer_question' => $questionId,
						'answer_is_correct' => $answerItem['answer_is_correct'],
						'answer_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
				));
			}
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;	
		}
		
		return $questionId;
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
			$questionId = isset($formValues['question_id']) ? $formValues['question_id'] : 0;
			
			// Get list of answers
			$listAnswers = isset($formValues['dependencyAnswers']['answer']) && is_array($formValues['dependencyAnswers']['answer']) ? $formValues['dependencyAnswers']['answer'] : array();
			
			// Insert question
			$this->update(array(
					'question_content' => $formValues['question_content'],
					'question_subject' => $formValues['question_subject'],
					'question_chapter' => $formValues['question_chapter'],
					'question_level' => $formValues['question_level'],
					'question_type' => (count($listAnswers) > 0 ? Application_Const::QUESTION_TYPE_TEST : Application_Const::QUESTION_TYPE_ESSAY),
					'question_editor' => Admin_Auth::getInstance()->getUser()->user_id,
					'question_status' => $formValues['question_status']
			), array(
				'question_id = ?' => $questionId
			));
			
			// Init model
			$answerModel = new Admin_Model_Question_Answer();
			
			// Delete old answer
			$answerModel->delete(array(
				'answer_question = ?' => $questionId
			));
			
			// Insert answer
			foreach ($listAnswers as $answerItem)
			{
				$answerModel->insert(array(
						'answer_content' => $answerItem['answer_content'],
						'answer_question' => $questionId,
						'answer_is_correct' => $answerItem['answer_is_correct'],
						'answer_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
				));
			}
				
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $questionId;
	}
}