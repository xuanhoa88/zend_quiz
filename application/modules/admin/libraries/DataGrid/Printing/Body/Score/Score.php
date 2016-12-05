<?php

class Admin_DataGrid_Printing_Body_Score_Score extends Lumia_DataGrid_Body_Action
{
	/**
	 * Render form element
	 *
	 * @return string
	 */
	public function render()
	{
		$rowData = $this->getData();
		$listOfCorrectQuestions = $this->getOption('listOfCorrectQuestions');
		$numberOfQuestions = $this->getOption('numberOfQuestions');
		$studentId = (isset($rowData['student_id']) ? $rowData['student_id'] : null);
		$numberOfCorrectQuestions = (isset($listOfCorrectQuestions[$studentId]) ? $listOfCorrectQuestions[$studentId] : null);
		
		return number_format((count($numberOfCorrectQuestions) / count($numberOfQuestions)) * $rowData['exam_mark'], 2, ',', '.') . '/' . $rowData['exam_mark'];
	}
}