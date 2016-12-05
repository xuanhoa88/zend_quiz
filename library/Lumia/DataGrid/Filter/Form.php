<?php

class Lumia_DataGrid_Filter_Form extends Lumia_Form
{
	/**
	 * @var array
	 */
	protected $_clauses;
	
	/**
	 * Sets filtering clauses
	 * 
	 * @param	mixed $clauses
	 * @return	Lumia_DataGrid_Filter_Form
	 */
	public function setClauses($clauses)
	{
		$this->_clauses = $clauses;
		
		return $this;
	}
	
	/**
	 * Gets filtering clauses
	 * 
	 * @return	mixed
	 */
	public function getClauses()
	{
		return $this->_clauses;
	}
}