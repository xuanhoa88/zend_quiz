<?php

class Lumia_NestedSet extends Lumia_Db_Table
{
    
    const NESTEDSET_FIRST_CHILD = 'firstChild';
    const NESTEDSET_LAST_CHILD = 'lastChild';
    const NESTEDSET_NEXT_SIBLING = 'nextSibling';
    const NESTEDSET_PREV_SIBLING = 'prevSibling';
    const NESTEDSET_RIGHT_TBL_ALIAS = 'parent';

    /**
     * In MySQL and PostgreSQL, 'left' and 'right' are reserved words
     * This represent the default table structure
     * 
     * @var array
     */
    protected $_structures = array(
    		'name' => 'name', 
    		'left' => 'lft', 
    		'right' => 'rgt'
    );
    
    /**
     * Valid objective node positions.
     *
     * @var array
     */
    protected $_validPositions = array(
    		self::NESTEDSET_FIRST_CHILD, 
    		self::NESTEDSET_LAST_CHILD, 
    		self::NESTEDSET_NEXT_SIBLING, 
    		self::NESTEDSET_PREV_SIBLING
    );
    
    /**
     * __construct() - For concrete implementation of Zend_Db_Table
     *
     * @param 	string|array $config string can reference a Zend_Registry key for a db adapter OR it can reference the name of a table
     * @param 	array|Zend_Db_Table_Definition $definition
     */
    public function __construct($config = array(), $definition = NULL)
    {
        parent::__construct($config, $definition);
        
        $this->_setupPrimaryKey();
        
        $this->_setupRequiredColumns();
    }
    
    /**
     * Defined by Zend_Db_Table_Abstract.
     *
     * @return 	void
     */
    protected function _setupPrimaryKey()
    {
        parent::_setupPrimaryKey();
        
        if (count($this->_primary) > 1) 
        {
            throw new Lumia_NestedSet_Exception('Tables with compound primary key are not currently supported.');
        }
    }    
    
    /**
     * Validating supplied "left", "right" columns.
     *
     * @return 	void
     */
    protected function _setupRequiredColumns()
    {
        if (!$this->_structures['left'] || !$this->_structures['right']) 
        {
            throw new Lumia_NestedSet_Exception('The "left", "right" column names must be supplied');
        }
        
        $this->_setupMetadata();
        
        if (count(array_intersect($this->_structures, array_keys($this->_metadata))) < count($this->_structures)) 
        {
            throw new Lumia_NestedSet_Exception('Supplied "left", "right" were not found');
        }
    }
    
    /**
     * Checks whether valid node position is supplied.
     *
     * @param 	string $position Position regarding on objective node.
     * @return 	bool
     */
    protected function _checkNodePosition($position)
    {
        if (!in_array($position, $this->_validPositions, true)) 
        {
            return false;
        }
        
        return true;
    }
    
    /**
     * Check row exist
     *
     * @param 	string $row 	Row name
     * @return 	string
     */
    protected function _checkKey($row)
    {
        if (!array_key_exists($row, $this->_metadata)) 
        {
            return false;
        }
        
        return true;
    }
    
    /**
     * Generates left and right column value, based on id of a objective node.
     *
     * @param 	int|null $objectiveNodeId Id of a objective node.
     * @param 	string $position Position in tree.
     * @param 	int|null $id Id of a node for which left and right column values are being generated (optional).
     * @return 	array
     */
    protected function _getRequiredColumns($objectiveNodeId, $position, $id = NULL)
    {
        $primary = $this->getAdapter()->quoteIdentifier($this->_primary[1]);
        $leftCol = $this->getAdapter()->quoteIdentifier($this->_structures['left']);
        $rightCol = $this->getAdapter()->quoteIdentifier($this->_structures['right']);
        $left  = NULL;
        $right = NULL;
        $objectiveNodeId = (int) $objectiveNodeId;
        if ($objectiveNodeId) 
        {
            if ($result = $this->getElement($objectiveNodeId)) 
            {
                $left  = (int) $result[$this->_structures['left']];
                $right = (int) $result[$this->_structures['right']];
            }
        }
        
        $requiredColumns = array();
        if ($left !== null && $right !== null) 
        {
            switch ($position) 
            {
                case self::NESTEDSET_FIRST_CHILD:
                    $requiredColumns[$this->_structures['left']]  = $left + 1;
                    $requiredColumns[$this->_structures['right']] = $left + 2;
                    
                    parent::update(array(
                        $this->_structures['right'] => new Zend_Db_Expr("{$rightCol} + 2")
                    ), "{$rightCol} > {$left}");
                    
                    parent::update(array(
                        $this->_structures['left'] => new Zend_Db_Expr("{$leftCol} + 2")
                    ), "{$leftCol} > {$left}");
                    
                    break;
                
                case self::NESTEDSET_LAST_CHILD:
                    $requiredColumns[$this->_structures['left']]  = $right;
                    $requiredColumns[$this->_structures['right']] = $right + 1;
                    
                    parent::update(array(
                        $this->_structures['right'] => new Zend_Db_Expr("{$rightCol} + 2")
                    ), "{$rightCol} >= {$right}");
                    
                    parent::update(array(
                        $this->_structures['left'] => new Zend_Db_Expr("{$leftCol} + 2")
                    ), "{$leftCol} > {$right}");
                    
                    break;
                
                case self::NESTEDSET_NEXT_SIBLING:
                    $requiredColumns[$this->_structures['left']]  = $right + 1;
                    $requiredColumns[$this->_structures['right']] = $right + 2;
                    
                    parent::update(array(
                        $this->_structures['right'] => new Zend_Db_Expr("{$rightCol} + 2")
                    ), "{$rightCol} > {$right}");
                    
                    parent::update(array(
                        $this->_structures['left'] => new Zend_Db_Expr("{$leftCol} + 2")
                    ), "{$leftCol} > {$right}");
                    
                    break;
                
                case self::NESTEDSET_PREV_SIBLING:
                    $requiredColumns[$this->_structures['left']]  = $left;
                    $requiredColumns[$this->_structures['right']] = $left + 1;
                    
                    parent::update(array(
                        $this->_structures['right'] => new Zend_Db_Expr("{$rightCol} + 2")
                    ), "{$rightCol} > {$left}");
                    
                    parent::update(array(
                        $this->_structures['left'] => new Zend_Db_Expr("{$leftCol} + 2")
                    ), "{$leftCol} >= {$left}");
                    
                    break;
            }
        } else 
        {
            $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
            $select->columns(array('max_rgt' => new Zend_Db_Expr("MAX({$rightCol})")));
            $select->where("{$this->_primary[1]} != ?", (int) $id);
            
            if ($row = parent::fetchRow($select)) 
            {
            	$result = $row->toArray();
                $requiredColumns[$this->_structures['left']] = (int) $result['max_rgt'] + 1;
            } else 
            {
                $requiredColumns[$this->_structures['left']] = 1;
            }
            
            $requiredColumns[$this->_structures['right']] = $requiredColumns[$this->_structures['left']] + 1;
        }
        
        return $requiredColumns;
    }
    
    /**
     * Gets id of some node's current objective node.
     *
     * @param 	mixed $nodeId Node id.
     * @param 	string $position Position in tree.
     * @return 	int|null
     */
    protected function _getCurrentObjectiveId($nodeId, $position)
    {
        $primary = $this->getAdapter()->quoteIdentifier($this->_primary[1]);
        $leftCol = $this->getAdapter()->quoteIdentifier($this->_structures['left']);
        $rightCol = $this->getAdapter()->quoteIdentifier($this->_structures['right']);
        
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner(array(self::NESTEDSET_RIGHT_TBL_ALIAS => $this->_name), null, null);
        $select->where(self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$primary} = ?", (int) $nodeId);
        
        switch ($position) 
        {
            case self::NESTEDSET_FIRST_CHILD:
                $select->where(self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$leftCol} BETWEEN {$this->_name}.{$leftCol}+1 AND {$this->_name}.{$rightCol} AND " . self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$leftCol} - {$this->_name}.{$leftCol} = 1");
                $select->order($this->_name . '.' . $this->_structures['left'] . ' DESC');
                
                break;
            case self::NESTEDSET_LAST_CHILD:
                $select->where(self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$leftCol} BETWEEN {$this->_name}.{$leftCol}+1 AND {$this->_name}.{$rightCol} AND {$this->_name}.{$rightCol} - " . self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$rightCol} = 1");
                $select->order($this->_name . '.' . $this->_structures['left'] . ' DESC');
                
                break;
            case self::NESTEDSET_NEXT_SIBLING:
                $select->where(self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$leftCol} - {$this->_name}.{$rightCol} = 1");
                
                break;
            case self::NESTEDSET_PREV_SIBLING:
                $select->where("{$this->_name}.{$leftCol} - " . self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$rightCol} = 1");
                
                break;
        }
        
        if ($row = parent::fetchRow($select)) 
        {
        	$result = $row->toArray();
            return (int) $result[$this->_primary[1]];
        }
        
        return null;
    }
    
    /**
     * Overriding insert() method defined by Zend_Db_Table_Abstract.
     *
     * @param 	array $data Submitted data.
     * @param 	int|null $objectiveNodeId Objective node id (optional).
     * @param 	string $position Position regarding on objective node (optional). [firstChild | lastChild | nextSibling | prevSibling]
     * @return 	mixed
     */
    public function insert(array $data, $objectiveNodeId = NULL, $position = self::NESTEDSET_LAST_CHILD)
    {
        if (!$this->_checkNodePosition($position)) 
        {
            throw new Lumia_NestedSet_Exception('Invalid node position is supplied.');
        }
        
        $this->getAdapter()->beginTransaction();
        try 
        {
            $data   = array_merge($data, $this->_getRequiredColumns($objectiveNodeId, $position));
            $result = parent::insert($data);
            
            $this->getAdapter()->commit();
            
        } catch (Zend_Exception $e) 
        {
            $this->getAdapter()->rollBack();
            throw $e;
        }
        
        return $result;
    }
    
    /**
     * If recursive, delete children, else children move up in the tree
     *
     * @param	int $id               Id of the element to delete
     * @return 	int
     */
    public function delete($id)
    {
        // initialize required value from method call
        if (!$result = $this->getElement($id)) 
        {
            return false;
        }
        
        // get interval for recursive delete
        $left  = (int) $result[$this->_structures['left']];
        $right = (int) $result[$this->_structures['right']];
        $width = (int) $result['width'];
        
        $this->getAdapter()->beginTransaction();
        try 
        {
            $delete = parent::delete("{$this->_structures['left']} BETWEEN {$left} AND {$right}");
            
            // update right
            parent::update(array(
                $this->_structures['right'] => new Zend_Db_Expr("{$this->_structures['right']} - {$width}")
            ), array(
                "{$this->_structures['right']} > ?" => $right
            ));
            
            // update left
            parent::update(array(
                $this->_structures['left'] => new Zend_Db_Expr("{$this->_structures['left']} - {$width}")
            ), array(
                "{$this->_structures['left']} > ?" => $right
            ));
            
            $this->getAdapter()->commit();
            
        } catch (Zend_Exception $e) 
        {
            $this->getAdapter()->rollBack();
            throw $e;
        }
        
        return $delete;
    }
    
    /**
     * Updates info of some node.
     *
     * @param 	array $data Submitted data.
     * @param 	int $id Id of a node that is being updated.
     * @param 	int $parentNode Objective node id.
     * @param 	string $position Position regarding on objective node (optional). [firstChild | lastChild | nextSibling | prevSibling]
     * @return 	mixed
     */
    public function update(array $data, $id, $parentNode = 0, $position = self::NESTEDSET_LAST_CHILD)
    {
        $id = (int) $id;
        $parentNode = (int) $parentNode;
        
        if ($parentNode) 
        {
        	$this->move($id, $parentNode);
        }
        
        $this->getAdapter()->beginTransaction();
        try 
        {
            $result = parent::update($data, array(
                "{$this->_primary[1]} = ?" => $id
            ));
            
            $this->getAdapter()->commit();
            
        } catch (Zend_Exception $e) 
        {
            $this->getAdapter()->rollBack();
            throw $e;
        }
        
        return $result;
    }
    
    /**
	 * Move an element into another as its child.
	 *
     * @param 	int $elementId    Id of the element to move
     * @param 	int $referenceId  Id of the reference element
     * @return 	Lumia_NestedSet
     */
    public function move($elementId, $referenceId)
    {
        $reference = $this->getElement($referenceId);
        $element = $this->getElement($elementId);
        
        // error handling
        if (empty($element) || empty($reference)) 
        {
            return false;
        }
        
        // Check it can be moved into. XXX change when we'll get one level
        if (($element[$this->_structures['left']] < $reference[$this->_structures['left']]) && ($element[$this->_structures['right']] > $reference[$this->_structures['right']])) 
        {
            return false;
        }
        
        // Check it can be moved into. XXX change when we'll get one level
        if ($element[$this->_structures['left']] > $reference[$this->_structures['left']] &&
        	$element[$this->_structures['left']] < $reference[$this->_structures['right']]) {
        		return false;
        }
        
        $this->getAdapter()->beginTransaction();
        
        try 
        {
        	$unit = ($reference[$this->_structures['right']] < $element[$this->_structures['right']] ? 1 : 0);
            $elementWidth = $element['width'];
            
            // move right
            parent::update(array(
                $this->_structures['right'] => new Zend_Db_Expr("{$this->_structures['right']} + {$elementWidth}")
            ), array(
                "{$this->_structures['right']} >= ?" => $reference[$this->_structures['right']]
            ));
            
            // move left
            parent::update(array(
                $this->_structures['left'] => new Zend_Db_Expr("{$this->_structures['left']} + {$elementWidth}")
            ), array(
                "{$this->_structures['left']} >= ?" => $reference[$this->_structures['right']]
            ));
           
            // then move element (and it's children)
            $difference = ($reference[$this->_structures['right']] - $element[$this->_structures['left']]); 
            parent::update(array(
                $this->_structures['left'] => new Zend_Db_Expr("{$this->_structures['left']} + {$difference} - {$unit} * {$elementWidth}"),
                $this->_structures['right'] => new Zend_Db_Expr("{$this->_structures['right']} + {$difference} - {$unit} * {$elementWidth}")
            ), array(
                "{$this->_structures['left']} >= ?" => $element[$this->_structures['left']] + $unit * $elementWidth,
                "{$this->_structures['right']} <= ?" => $element[$this->_structures['right']] + $unit * $elementWidth
            ));
            
            // move what was on the right of the element
            parent::update(array(
                $this->_structures['left'] => new Zend_Db_Expr("{$this->_structures['left']} - {$elementWidth}")
            ), array(
                "{$this->_structures['left']} > ?" => $element[$this->_structures['left']] + $unit * $elementWidth
            ));
            
            parent::update(array(
                $this->_structures['right'] => new Zend_Db_Expr("{$this->_structures['right']} - {$elementWidth}")
            ), array(
                "{$this->_structures['right']} > ?" => $element[$this->_structures['left']] + $unit * $elementWidth
            ));
            
            $this->getAdapter()->commit();
            
        } catch (Zend_Exception $e) 
        {
            $this->getAdapter()->rollBack();
            throw $e;
        }
        
        return true;
    }
    
    /**
     * Get all nodes without children
     *
     * @param	mixed $columns
     * @return 	array
     */
    public function getLeafs()
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where("{$this->_structures['right']} = {$this->_structures['left']} + 1");
        
        return parent::fetchAll($select)->toArray();
    }
    
    /**
     * Get one element with its children.
     *
     * @param 	int $elementId    Element Id
     * @return 	array
     */
    public function getElement($elementId)
    {
        $primary  = $this->getAdapter()->quoteIdentifier($this->_primary[1]);
        $leftCol  = $this->getAdapter()->quoteIdentifier($this->_structures['left']);
        $rightCol = $this->getAdapter()->quoteIdentifier($this->_structures['right']);
        
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->columns(array('width' => new Zend_Db_Expr("{$rightCol} - {$leftCol} + 1")));
        $select->where("{$primary} = ?", (int) $elementId);
        
        return (($row = parent::fetchRow($select)) ? $row->toArray() : null);
    }
    
    /**
     * Get the parent of an element.
     *
     * @param 	int $elementId
     * @return 	array|false
     */
    public function getParent($elementId)
    {
        if (!$element = $this->getElement($elementId)) 
        {
            return null;
        }
        
        $leftCol  = $this->getAdapter()->quoteIdentifier($this->_structures['left']);
        $rightCol = $this->getAdapter()->quoteIdentifier($this->_structures['right']);
        
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->columns(array('width' => new Zend_Db_Expr("{$this->_name}.{$rightCol} - {$this->_name}.{$leftCol} + 1")));
        $select->where("{$this->_name}.{$this->_structures['left']} < ?", $element[$this->_structures['left']]);
        $select->where("{$this->_name}.{$this->_structures['right']} > ?", $element[$this->_structures['right']]);
        $select->order("({$element[$this->_structures['left']]} - {$this->_name}.{$this->_structures['left']})");
        $select->limit(1);
        
        return (($row = parent::fetchRow($select)) ? $row->toArray() : null);
    }
    
    /**
     * Get parent nodes, including informations.
     *
     * @param 	int $nodeId
     * @param 	bool $withCurrent (optional) return current nodeId too
     * @param 	string $order (optional) order using order table key.
     * @return 	array
     */
    public function getParents($nodeId, $withCurrent = NULL, $order = NULL)
    {
        $primary  = $this->getAdapter()->quoteIdentifier($this->_primary[1]);
        $leftCol  = $this->getAdapter()->quoteIdentifier($this->_structures['left']);
        $rightCol = $this->getAdapter()->quoteIdentifier($this->_structures['right']);
       
        // Create query
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner(array(self::NESTEDSET_RIGHT_TBL_ALIAS => $this->_name), null, new Zend_Db_Expr("COUNT(" . self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$this->_primary[1]}) - 1 AS depth"));
        $select->where($this->_name . '.' . $leftCol . ($withCurrent ? " <= " : " < ") . self::NESTEDSET_RIGHT_TBL_ALIAS . '.' . $leftCol);
        $select->where($this->_name . '.' . $rightCol . ($withCurrent ? " >= " : " > ") . self::NESTEDSET_RIGHT_TBL_ALIAS . '.' . $rightCol);
        $select->where(self::NESTEDSET_RIGHT_TBL_ALIAS . '.' . $this->_primary[1] . ' = ?', (int) $nodeId);
        
        // If order not null, define order
        if ($this->_checkKey($order)) 
        {
            $select->order($order);
        } else 
        {
            $select->order($this->_structures['left']);
        }
        
        return parent::fetchAll($select)->toArray();
    }
    
    /**
     * Gets brother nodes
     *
     * @param 	int $nodeId
     * @param 	bool $withCurrent (optional) return current nodeId too
     * @return 	null|array
     */
    public function getBrothers($nodeId, $withCurrent = NULL)
    {
        if (!($node = $this->getElement($nodeId))) 
        {
            return null;
        }
        
        $parentNode = $this->getParent($nodeId);
        if (empty($parentNode[$this->_primary[1]])) 
        {
            return $this->getTree();
        }
        
        return $this->getChildrens($parentNode[$this->_primary[1]], $withCurrent);
    }
    
    /**
     * Gets children nodes, including informations.
     *
     * @param 	int $nodeId
     * @param 	bool $withCurrent (optional) return current nodeId too
     * @param 	string $order (optional) order using order table key.
     * @return 	array
     */
    public function getChildrens($nodeId, $withCurrent = NULL, $order = NULL)
    {
        $primary  = $this->getAdapter()->quoteIdentifier($this->_primary[1]);
        $leftCol  = $this->getAdapter()->quoteIdentifier($this->_structures['left']);
        $rightCol = $this->getAdapter()->quoteIdentifier($this->_structures['right']);
        
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner(array(self::NESTEDSET_RIGHT_TBL_ALIAS => $this->_name), null, null);
        $select->where($this->_name . '.' . $leftCol . ($withCurrent ? " >= " : " > ") . self::NESTEDSET_RIGHT_TBL_ALIAS . '.' . $leftCol);
        $select->where($this->_name . '.' . $rightCol . ($withCurrent ? " <= " : " < ") . self::NESTEDSET_RIGHT_TBL_ALIAS . '.' . $rightCol);
        $select->where(self::NESTEDSET_RIGHT_TBL_ALIAS . '.' . $this->_primary[1] . ' = ?', (int) $nodeId);
        
        // If order not null, define order
        if ($this->_checkKey($order)) 
        {
            $select->order($order);
        } else 
        {
            $select->order($this->_structures['left']);
        }
        
        return parent::fetchAll($select)->toArray();
    }
    
    /**
     * Get all elements from nested set
     *
     * @param 	array $depth      Array of depth wanted. Default is all
     * @param 	string $order
     * @param 	int $count
     * @param	int $offset
     * @return 	array
     */
    public function getTree($wheres = NULL, $order = NULL, $count = NULL, $offset = NULL)
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner(array(self::NESTEDSET_RIGHT_TBL_ALIAS => $this->_name), null, new Zend_Db_Expr("COUNT(" . self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$this->_primary[1]}) - 1 AS depth"));
        $select->where("{$this->_name}.{$this->_structures['left']} BETWEEN " . self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$this->_structures['left']} AND " . self::NESTEDSET_RIGHT_TBL_ALIAS . ".{$this->_structures['right']}");
        $select->group("{$this->_name}.{$this->_primary[1]}");
        $select->group("{$this->_name}.{$this->_structures['name']}");
        $select->group("{$this->_name}.{$this->_structures['left']}");
        $select->group("{$this->_name}.{$this->_structures['right']}");
        $select->order("{$this->_name}.{$this->_structures['left']} ASC");
        
        switch (true)
        {
        	case is_array($wheres) :
	        	foreach ($wheres as $method => $where)
	        	{
	        		call_user_func_array(array($select, $method), $where);
	        	}
	        	break;
        	case is_string($wheres) :
        		$select->where($wheres);
        		break;
        }
        
        if ($order !== null)
        {
        	$select->order($order);
        }
        
        if ($count !== null || $offset !== null)
        {
        	$select->limit($count, $offset);
        }
       
        return parent::fetchAll($select)->toArray();
    }
    
    /**
     * Returns the number of descendant of an element.
     *
     * @params 	int $elementId   ID of the element
     * @return 	int
     */
    public function numberOfDescendant($elementId)
    {
        if (!($elementRow = $this->getElement($elementId))) 
        {
            throw new Lumia_NestedSet_Exception('Not defined node');
        }
        
        return ($elementRow['width'] - 2) / 2;
    }
    
    /**
     * Returns if the element is root.
     *
     * @param 	int $elementId
     * @return 	boolean
     */
    public function isRoot($elementId)
    {
    	$selectMin = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)->reset(self::COLUMNS)->columns(new Zend_Db_Expr("MIN({$this->_structures['left']})"));
    	$selectMax = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)->reset(self::COLUMNS)->columns(new Zend_Db_Expr("MAX({$this->_structures['right']})"));
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)->reset(self::COLUMNS)->columns(new Zend_Db_Expr($this->_primary[1]));
        $select->where("{$this->_primary[1]} = ?", (int) $elementId);
        $select->where("{$this->_structures['left']} = (?)", $selectMin);
        $select->where("{$this->_structures['right']} = (?)", $selectMax);
        
        return (boolean) parent::fetchRow($select);
    }
    
    /**
     * Convert a tree array (with depth) into a hierarchical array.
     *
     * @param 	array $nodes   Array with depth value.
     * @return 	array
     */
    public function toHierarchies(array $nodes = NULL)
    {
        if (empty($nodes)) 
        {
            $nodes = $this->getTree();
        } 
        
        $result = array();
        if (count($nodes) > 0) 
        {
            $stackLevel = 0;
            
            // Node Stack. Used to help building the hierarchy
            $stack = array();
            
            foreach ($nodes as $node) 
            {
                $node['pages'] = array();
                
                // Number of stack items
                $stackLevel = count($stack);
                
                // Check if we're dealing with different levels
                while ($stackLevel > 0 && $stack[$stackLevel - 1]['depth'] >= $node['depth']) 
                {
                    array_pop($stack);
                    $stackLevel--;
                }
                
                // Stack is empty (we are inspecting the root)
                if ($stackLevel == 0) 
                {
                    // Assigning the root node
                    $i = count($result);
                    $result[$i] = $node;
                    $stack[] =& $result[$i];
                } else 
                {
                    // Add node to parent
                    $i = count($stack[$stackLevel - 1]['pages']);
                    $stack[$stackLevel - 1]['pages'][$i] = $node;
                    $stack[] =& $stack[$stackLevel - 1]['pages'][$i];
                }
            }
        }
        
        return $result;
    }
    
    /**
     * Return nested set as JSON
     *
     * @params 	array $nodes          Original 'flat' nested tree
     * @return 	string
     */
    public function toJson(array $nodes = NULL)
    {
        return Zend_Json::encode($this->toHierarchies($nodes));
    }
    
    /**
     * Returns all elements as <ul>/<li> structure
     * Possible options:
     *  - list (simple <ul><li>)
     *
     * @param	array $nodes
     * @return 	string
     */
    public function toHtml(array $nodes = NULL)
    {
        if (empty($nodes)) 
        {
            $nodes = $this->getTree();
        }
        
        $html = '';
        
        // find deepest active
        $minDepth = 0;
        
        // iterate container
        $prevDepth = -1;
        
        foreach ($nodes as $node)
        {
        	if (!isset($node['depth']) || ($node['depth'] < $minDepth))
        	{
        		// page is below minDepth or not accepted by acl/visibilty
        		continue;
        	}
        	
        	// get depth of item
        	$depth = $node['depth'];
        		
        	// make sure indentation is correct
        	$depth -= $minDepth;
        		
        	if ($depth > $prevDepth)
        	{
        		// start new ul tag
        		$html .= '<ul>' . PHP_EOL;
        	} else if ($prevDepth > $depth)
        	{
        		// close li/ul tags until we're at current depth
        		for ($i = $prevDepth; $i > $depth; $i --)
        		{
        			$html .= '    </li>' . PHP_EOL;
        			$html .= '</ul>' . PHP_EOL;
        		}
        
        		// close previous li tag
        		$html .= '    </li>' . PHP_EOL;
			} else
        	{
        		// close previous li tag
        		$html .= '    </li>' . PHP_EOL;
			}
        							
        	// render li tag and page
			$html .= '    <li>' . PHP_EOL . '        ' . $node[$this->_structures['name']] . PHP_EOL;
        						
        	// store as previous depth for next iteration
        	$prevDepth = $depth;
        }
        
        if ($html)
        {
        	// done iterating container; close open ul/li tags
        	for ($i = $prevDepth + 1; $i > 0; $i --)
        	{
        		$html .= '    </li>' . PHP_EOL . '</ul>' . PHP_EOL;
        	}
        		
        	$html = rtrim( $html, PHP_EOL );
        }
        
        return $html;
    }

    /**
     * Convert a tree array (with depth) into a hierarchical XML string.
     *
     * @param 	array $nodes   Array with depth value.
     * @return 	string
     */
    public function toXml(array $nodes = NULL)
    {
    	if (empty($nodes))
    	{
    		$nodes = $this->getTree();
    	}
    	
        $xml = new DomDocument('1.0');
        $xml->preserveWhiteSpace = false;
        $root = $xml->createElement('root');
        $xml->appendChild($root);

        $depth = 0;
        $currentChildren = array();

        foreach ($nodes as $node) 
        {
            $element = $xml->createElement('element');
            $element->setAttribute('id', $node[$this->_primary[1]]);
            $element->setAttribute('name', $node[$this->_structures['name']]);
            $element->setAttribute('left', $node[$this->_structures['left']]);
            $element->setAttribute('right', $node[$this->_structures['right']]);

            $children = $xml->createElement('pages');
            $element->appendChild($children);

            if ($node['depth'] == 0) 
            {
                // Handle root
                $root->appendChild($element);
                $currentChildren[0] = $children;
            } elseif ($node['depth'] > $depth) 
            {
                // is a new sub level
                $currentChildren[$depth]->appendChild($element);
                $currentChildren[$node['depth']] = $children;
            } elseif ($node['depth'] == $depth || $node['depth'] < $depth) 
            {
                // is at the same level
                $currentChildren[$node['depth'] - 1]->appendChild($element);
            }

            $depth = $node['depth'];
        }

        return $xml->saveXML();
    }
}