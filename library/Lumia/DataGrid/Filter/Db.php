<?php

class Lumia_DataGrid_Filter_Db extends Lumia_DataGrid_Filter
{
	/**
	 * Database adapter
	 */
	protected $_dbAdapter;
	
	/**
	 * Constructor
	 *
	 * @param Lumia_DataGrid_Abstract $dataGrid
	 */
	public function __construct(Lumia_DataGrid_Abstract $dataGrid)
	{
		parent::__construct($dataGrid);
		
		// Gets database adapter from data grid
		$dataSource = $this->_dataGrid->getDataSource();
		switch (true)
		{
			case $dataSource instanceof Zend_Db_Table_Rowset_Abstract:
				$this->_dbAdapter = $dataSource->getTable()->getAdapter();
				break;
			case $dataSource instanceof Zend_Db_Table_Select:
				$this->_dbAdapter = $dataSource->getTable()->getAdapter();
				break;
		}
	}
	
    /**
     * Initialize filter (used by extending classes)
     *
     * @return void
     */
    public function init()
    {
    	// Call parent method
    	parent::init();
    	
    	// Build query
    	$this->_render();
    }

    /**
     * Handle query conditions
     *
     * @param array $clauses
     * @param string $conjunctor
     * @return string
     */
    protected function _joinClauses(array $clauses, $conjunctor)
    {
    	$wheres = array();
    	foreach ($clauses as $key => $value)
    	{
    		// Get type of value
    		$type = gettype($value);
    		
    		if (preg_match("/^(AND|OR)\s*#?/i", $key, $relationMatch) && $type == 'array')
    		{
    			if (0 !== count(array_diff_key($value, array_keys(array_keys($value)))))
    			{
    				$segment = $this->_joinClauses($value, ' ' . $relationMatch[1]);
    			} else
    			{
    				$segment = $this->_innerConjunct($value, ' ' . $relationMatch[1], $conjunctor);
    			}
    			
    			$segment && array_push($wheres, $segment);
    		} else
    		{
    			preg_match('/^(\w+)\s+(?P<expr>LIKE)\s+(.*)$/is', $key, $matches);
    			if (!empty($matches['expr']))
    			{
    				preg_match('/(?P<begin>\%?)(?P<keyword>[^%]*)(?P<end>\%?)/is', trim($value), $subject);
    				if (!array_key_exists($subject['keyword'], $this->_validDatas))
    				{
    					continue;
    				}
    				
    				$segment = $subject['begin'] . $this->_validDatas[$subject['keyword']] . $subject['end'];
    			} else
    			{
    				if (!array_key_exists($value, $this->_validDatas)) 
    				{
    					continue;
    				}
    				
    				$segment = $this->_validDatas[$value];
    			}
    			
    			$wheres[] = $this->_dbAdapter->quoteInto($key, $segment);
    		}
    	}
    	
    	return ($wheres ? '(' . implode($conjunctor . ' ', $wheres) . ')' : '');
    }
    
    /**
     * Handle deep query conditions
     * 
     * @param 	array $clauses
     * @param 	string $conjunctor
     * @param 	string $outerConjunctor
     * @return 	string
     */
    protected function _innerConjunct(array $clauses, $conjunctor, $outerConjunctor)
    {
    	$haystack = array();
    	foreach ($clauses as $value)
    	{
    		if (!is_array($value))
    		{
    			continue;
    		}

    		if ($wheres = $this->_joinClauses($value, $conjunctor))
    		{ 
    			$haystack[] = '(' . $wheres . ')';
    		}
    	}
    
    	return ($haystack ? implode($outerConjunctor . ' ', $haystack) : '');
    }
    
    /**
     * Processes query conditions
     *
     * @return	void
     */
    protected function _render()
    {
    	$filteringClause = $this->_dataGrid->getFilter()->getClauses();
    	if (isset($filteringClause['HAVING']))
    	{
    		$clause = $this->_joinClauses($filteringClause['HAVING'], ' AND');
    		($clause ? $this->_dataGrid->getDataSource()->having($clause) : $clause);
    	} else 
    	{    	
	    	$clause = '';
	    	if (is_array($filteringClause))
	    	{
	    		$keys = array_keys($filteringClause);
	    		$AND = preg_grep("/^AND\s*#?$/i", $keys);
	    		$OR = preg_grep("/^OR\s*#?$/i", $keys);
	    		$conditions = array_diff_key($filteringClause, array_flip(explode(' ', 'AND OR')));
	    		
	    		if ($conditions != array())
	    		{
	    			$clause = $this->_joinClauses($conditions, '');
	    		}
	    
	    		if (!empty($AND))
	    		{
	    			$value = array_values($AND);
	    			$clause = $this->_joinClauses($filteringClause[$value[0]], ' AND');
	    		}
	    
	    		if (!empty($OR))
	    		{
	    			$value = array_values($OR);
	    			$clause = $this->_joinClauses($filteringClause[$value[0]], ' OR');
	    		}
	    	}
	    	
	    	($clause ? $this->_dataGrid->getDataSource()->where($clause) : '');
    	}
    }
}