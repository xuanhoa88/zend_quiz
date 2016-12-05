<?php

class Lumia_Db_Table extends Zend_Db_Table
{
	/**
	 * Holds the associated model class
	 *
	 * @var string
	 */
	protected $_rowClass = 'Lumia_Db_Table_Row';

    /**
     * Classname for rowset
     *
     * @var string
     */
    protected $_rowsetClass = 'Lumia_Db_Table_Rowset';

	/**
	 * Inserts multiple rows into the table using MySQL's
	 * INSERT ... ON DUPLICATE KEY syntax
	 *
	 * @param 	array $insertData
	 * @param 	array $updateData
	 * @return 	int affected rows
	 */
	public function bulkInsert(array $insertData, array $updateData = null)
	{
		$insertKeys = null;
		$insertValues = array();

		// Insert data
		foreach ($insertData as $data) 
		{
			if (null === $insertKeys) 
			{
				$insertKeys = array_keys($data);
			} else 
			{
				// Validate keys match
				$currentInsertKeys = array_keys($data);
				$diff = array_diff($insertKeys, $currentInsertKeys);
				if (!empty($diff)) 
				{
					require_once 'Zend/Db/Adapter/Exception.php';
					throw new Zend_Db_Adapter_Exception('Insert fields do not match for multiple insert/update.');
				}
			}
			
			$insertValues[] = "({$this->_db->quote($data)})";
		}

		// Update data
		if (empty($updateData)) 
		{
			// No update data specified, create update data based
			// on insert data. This means the insert data will be
			// used as the update data.
			$updateData = $insertKeys;
		}

		// Quote insert_key identifiers
		foreach ($insertKeys as $i => $key) 
		{
			$insertKeys[$i] = $this->_db->quoteIdentifier($key, true);
		}

		// Create SQL strings for update data
		$updates = array();
		foreach ($updateData as $key => $value) 
		{
			if (is_string($key)) 
			{
				// Specific update value was passed in for this column
				$update = $this->_db->quoteIdentifier($key, true) . ' = ' . $this->_db->quote($value);
			} else 
			{
				// Column should use value from insert data
				$update = $this->_db->quoteIdentifier($key, true) . ' = VALUES(' . $this->_db->quoteIdentifier($value, true) . ')';
			}
			
			$updates[] = $update;
		}
		
		// Batch this baby
		$affectedRows = 0;
		$total = count($insertValues);
		$tableSpec = $this->_db->quoteIdentifier(($this->_schema ? $this->_schema . '.' : '') . $this->_name, true);
		for ($i = 0; $i < $total; $i += 50)
		{
			$affectedRows += $this->_createInsertQuery($tableSpec, $insertKeys, array_slice($insertValues, $i, 50), $updates);
		}

		return $affectedRows;
	}
	
	/**
	 * Insert batch statement
	 *
	 * Generates a platform-specific batch insert string from the supplied data
	 *
	 * @param	string $tableSpec
	 * @param	array $values	Insert data
	 * @return 	int affected rows
	 */
	protected function _createInsertQuery($tableSpec, array $insertKeys, array $insertValues, array $onDuplicate)
	{
		// Build the insert statement
		$sql = "INSERT INTO " . $tableSpec
			. "\n(" . implode(", ", $insertKeys) . ")\nVALUES\n"
			. implode(",\n", $insertValues)
			. "\nON DUPLICATE KEY UPDATE\n"
			. implode(', ', $onDuplicate);
			
		// Execute the statement and return the number of affected rows
		$stmt = $this->_db->query($sql);
		return $stmt->rowCount();
	}
	
	/**
	 * Updates multiple rows into the table
	 *
	 * @param 	array $updateData 	An associative array of update values
	 * @param	mixed $where 		UPDATE WHERE clause(s).
	 * @return 	int affected rows
	 */
	public function bulkUpdate(array $updateData, $where = '')
	{
		$updates = array();
		foreach ($updateData as $subData)
		{
			if (empty($subData))
			{
				continue;
			}
			
			$clean = array();
			foreach ($subData as $key => $value)
			{
				$clean[$this->_db->quoteIdentifier($key, true)] = $this->_db->quote($value);
			}
			
			$updates[] = $clean;
		}
		
		$total = count($updates);
		if ($total === 0)
		{
			require_once 'Zend/Db/Adapter/Exception.php';
			throw new Zend_Db_Adapter_Exception('Update fields do not match for multiple update.');
		}
		
		// Batch this baby
		$affectedRows = 0;
		$tableSpec = $this->_db->quoteIdentifier(($this->_schema ? $this->_schema . '.' : '') . $this->_name, true);
		for ($i = 0; $i < $total; $i += 50)
		{
			$affectedRows += $this->_createUpdateQuery($tableSpec, array_slice($updates, $i, 50), $where);
		}
		
		return $affectedRows;
	}
	
	/**
	 * Update_Batch statement
	 *
	 * Generates a platform-specific batch update string from the supplied data
	 *
	 * @param	string	$table	Table name
	 * @param	array	$values	Update data
	 * @param	string	$where	WHERE key
	 * @return	string
	 */
	protected function _createUpdateQuery($table, array $values, $where)
	{
		$ids = array();
		$final = array();
		foreach ($values as $key => $val)
		{
			$ids[] = $val[$where];
			foreach (array_keys($val) as $field)
			{
				if ($field !== $where)
				{
					$final[$field][] = 'WHEN ' . $where . ' = ' . $val[$where] . ' THEN ' . $val[$field];
				}
			}
		}
		
		$cases = '';
		foreach ($final as $k => $v)
		{
			$cases .= $k . " = CASE \n" . implode("\n", $v) . "\n" . 'ELSE ' . $k . ' END, ';
		}
		
		$this->where($where.' IN('.implode(',', $ids).')', NULL, FALSE);
		
		// Build the update statement
		$sql = 'UPDATE ' . $table . ' SET ' . substr($cases, 0, -2) . $this->_whereExpr($where);
		
		// Execute the statement and return the number of affected rows
		$stmt = $this->_db->query($sql);
		return $stmt->rowCount();
	}

    /**
     * Convert an array, string, or Zend_Db_Expr object
     * into a string to put in a WHERE clause.
     *
     * @param 	mixed $where
     * @return 	string
     */
    protected function _whereExpr($where)
    {
        if (empty($where)) 
        {
            return $where;
        }
        
        if (!is_array($where)) 
        {
            $where = array($where);
        }
        
        foreach ($where as $cond => &$term) 
        {
            // is $cond an int? (i.e. Not a condition)
            if (is_int($cond)) 
            {
                // $term is the full condition
                if ($term instanceof Zend_Db_Expr) 
                {
                    $term = $term->__toString();
                }
            } else 
            {
                // $cond is the condition with placeholder,
                // and $term is quoted into the condition
                $term = $this->_db->quoteInto($cond, $term);
            }
            
            $term = '(' . $term . ')';
        }

        return implode(' AND ', $where);
    }
}
