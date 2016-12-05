<?php

abstract class Lumia_Model
{
	/**
	 * Singleton instance
	 *
	 * @var Application_Model_Configuration
	 */
	protected static $_instance;
	
	/**
	 * Database table class
	 * 
	 * @var Zend_Db_Table_Abstract
	 */
	protected $_dbTable;
	
	/**
	 * View class
	 *
	 * @var Zend_View_Abstract
	 */
	protected $_view;
	
	/**
	 * Constructor.
	 *
	 * @param  mixed $options Array of user-specified config options, or just the Db Adapter.
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		if (isset($options['dbTable']))
		{
			$dbTable = $options['dbTable'];
			unset($options['dbTable']);
		}
		
		if (!empty($dbTable))
		{
			$this->setDbTable($dbTable, $options);
		}
	}

    /**
     * Returns an instance of Application_Model_Configuration
     *
     * Singleton pattern implementation
     *
     * @return Application_Model_Configuration
     */
    public static function getInstance()
    {
        if (null === static::$_instance) 
        {
            static::$_instance = new static();
        }

        return static::$_instance;
    }
	
	/**
	 * Invoking inaccessible methods in database table class
	 *  
	 * @param string $methodName
	 * @param mixed $args
	 * @throws Zend_Exception
	 * @return mixed
	 */
	public function __call($methodName, $args)
	{
		if (method_exists($this->getDbTable(), $methodName))
		{
			return call_user_func_array(array($this->getDbTable(), $methodName), $args);
		}
		
		throw new Lumia_Exception('The method ' . $methodName . '() was not implemented in <i>' . get_class($this) . '</i>');
	}
	
	/**
	 * Set database table class
	 * 
	 * @param 	string|object $dbTable
	 * @param	array $options
	 * @throws 	Lumia_Exception
	 */
	public function setDbTable($dbTable, array $options = array())
	{
		if (is_string($dbTable))
		{
			$dbTable = new $dbTable();
		}
		
		if (!$dbTable instanceof Zend_Db_Table_Abstract)
		{
			throw new Lumia_Exception('Invalid table data gateway provided');
		}
		
		$this->_dbTable = $dbTable;
		$this->_dbTable->setOptions($options);

		// Get view
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		if (null === $viewRenderer->view)
		{
			$viewRenderer->initView();
		}
		
		$this->_view = $viewRenderer->view;
	}

	/**
	 * Get database table class
	 * 
	 * @throws Lumia_Exception
	 * @return Zend_Db_Table_Abstract
	 */
	public function getDbTable()
	{
		if (null === $this->_dbTable || !$this->_dbTable instanceof Zend_Db_Table_Abstract)
		{
			throw new Lumia_Exception('Invalid table data gateway provided');
		}
		
		return $this->_dbTable;
	}

	/**
	 * Get table primary key
	 *  
	 * @return Ambigous <array, multitype:, string, mixed>
	 */
	public function getDbPrimary()
	{
		$primaryKey = $this->getDbTable()->info(Zend_Db_Table_Abstract::PRIMARY);
		return $primaryKey[1];
	}
}
