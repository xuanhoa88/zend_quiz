<?php

abstract class Lumia_DataGrid_Abstract extends Lumia_DataGrid_Option
{
	/**
	 * Constants
	 */
	const SORT_ASC = 'ASC';
	const SORT_DESC = 'DESC';
	
	/**
	 * The "Late Static Binding" class name
	 */
	protected $_gridId;
	
	/**
	 * @var Zend_Controller_Request_Abstract
	 */
	protected $_request;

	/**
	 * @var Zend_Controller_Response_Abstract
	 */
	protected $_response;

	/**
	 * @var Lumia_DataGrid_Paginator
	 */
	protected $_paginator;

	/**
	 * @var Zend_View_Abstract
	 */
	protected $_view;

	/**
	 * @var Zend_Session
	 */
	protected $_session;

	/**
	 * @var string
	 */
	protected $_primary;

	/**
	 * Data source for data grid
	 * 
	 * @var mixed
	 */
	protected $_dataSource;
	
	/**
	 * Data source adapter
	 * 
	 * @var	Lumia_DataGrid_DataSource
	 */
	protected $_adapter;
	
	/**
	 * @var	string
	 */
    protected $_viewScript;

    /**
     * All columns in data grid
     *
     * @var Lumia_DataGrid_Column_ArrayAccess
     */
    protected $_columns = array();
    
    /**
     * Sort by ascending or descending
     *
     * @var string
    */
    protected $_sort;
    
    /**
     * Order by keyword
     *
     * @var string
     */
    protected $_order;
    
    /**
     * @var Lumia_DataGrid_Filter_Form
     */
    protected $_filter;
    
    /**
     * Default filter class
     * 
     * @var string
     */
    protected $_filterClass;
    
    /**
     * Url params
     *
     * @var array
     */
    protected $_urlParams = array();
    
	/**
	 * Constructor
	 */
	public function __construct($gridName = null)
	{
		// Init request
		$this->getRequest();

		// Set the grid id, to allow multiples instances per page
		if (is_null($gridName) || !is_string($gridName) || strlen($gridName) === 0)
		{
			$this->setGridId(get_class($this));
		}
		
		// Init view
		$this->getView();
		
		// Init session
		$this->getSession();
		
		// Init paginator
		$this->getPaginator();
		
		// Init column storage
		$this->_columns = new Lumia_DataGrid_Column_Registry();
		
		// Init filter
		$this->_filter = new Lumia_DataGrid_Filter_Form();
		$this->_filter->setName($this->getGridId());
		$this->_filter->setElementsBelongTo($this->getGridId() . '[filter]');
	}

	/**
	 * Sets the grid id, to allow multiples instances per page
	 *
	 * @param string $id Grid to be used in grid
	 * @return Lumia_DataGrid_Abstract
	 */
	public function setGridId($gridId)
	{
		$this->_gridId = preg_replace('/[^a-zA-Z0-9_\x7f-\xff]/', '-', (string) $gridId);
		
		return $this;
	}
	
	/**
	 * Returns the grid id.
	 *
	 * @param bool $forceId If we should force an id to be returned in case no one is set
	 * @return string
	 */
	public function getGridId()
	{
		return (string) $this->_gridId;
	}

	/**
	 * Set primary key.
	 *
	 * @param string $primary        	
	 * @return Lumia_DataGrid_Abstract
	 */
	public function setPrimaryKey($primary)
	{
		$this->_primary = (string) $primary;
		
		return $this;
	}

	/**
	 * Get primary key.
	 *
	 * @return string
	 */
	public function getPrimaryKey()
	{
		return (string) $this->_primary;
	}
	
	/**
	 * Defines request instance
	 *
	 * @param 	Zend_Controller_Request_Abstract $request
	 * @return 	Lumia_DataGrid_Abstract
	 */
	public function setRequest(Zend_Controller_Request_Abstract $request)
	{
		$this->_request = $request;
	
		return $this;
	}

	/**
	 * Get request
	 *
	 * @return Zend_Controller_Request_Abstract
	 */
	public function getRequest()
	{
		if ($this->_request === null)
		{
			$this->_request = Zend_Controller_Front::getInstance()->getRequest();
		}
		
		return $this->_request;
	}

	/**
	 * Defines response instance
	 *
	 * @param 	Zend_Controller_Response_Abstract $response
	 * @return 	Lumia_DataGrid_Abstract
	 */
	public function setResponse(Zend_Controller_Response_Abstract $response)
	{
		$this->_response = $response;
		
		return $this;
	}

	/**
	 * Get reponse
	 *
	 * @return Zend_Controller_Response_Abstract
	 */
	public function getResponse()
	{
		if ($this->_response === null) 
		{
			$this->_response = Zend_Controller_Front::getInstance()->getResponse();
		}
	
		return $this->_response;
	}

	/**
	 * Defines paginator instance
	 *
	 * @param 	Lumia_DataGrid_Paginator $paginator
	 * @return 	Lumia_DataGrid_Abstract
	 */
	public function setPaginator(Lumia_DataGrid_Paginator $paginator)
	{
		$this->_paginator = $paginator;
		
		return $this;
	}

	/**
	 * Get paginator
	 *
	 * @return Lumia_DataGrid_Paginator
	 */
	public function getPaginator()
	{
		if ($this->_paginator === null)
		{
			$this->_paginator = new Lumia_DataGrid_Paginator();
		}
		
		return $this->_paginator;
	}

	/**
	 * Defines view instance
	 *
	 * @param 	Zend_View_Interface $view view object to use
	 * @return 	Lumia_DataGrid_Abstract
	 */
	public function setView(Zend_View_Interface $view)
	{
		$this->_view = $view;
		
		return $this;
	}

	/**
	 * Get view
	 *
	 * @return Zend_View_Abstract
	 */
	public function getView()
	{
		if ($this->_view === null)
		{
			$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
			if (null === $viewRenderer->view)
			{
				$viewRenderer->initView();
			}
			
			$view = clone $viewRenderer->view;
// 			$view->clearVars();
			$this->_view = $view;
		}
		
		return $this->_view;
	}

	/**
	 * Get session
	 *
	 * @return Zend_Session_Namespace
	 */
	public function getSession()
	{
		if ($this->_session === null)
		{
			$this->_session = new Zend_Session_Namespace($this->getGridId());
		}
		
		return $this->_session;
	}
	
	/**
	 * Get all columns
	 *
	 * @return array
	 */
	public function getColumns()
	{
		return $this->_columns;
	}
	
	/**
	 * Get sort by keyword
	 *
	 * @return string
	 */
	public function getSort()
	{
		return (null === $this->_sort ? ($this->getSession()->sortBy ? $this->getSession()->sortBy : '') : $this->_sort);
	}
	
	/**
	 * Get order by keyword
	 *
	 * @return string
	 */
	public function getOrder()
	{
		return (null === $this->_order ? ($this->getSession()->orderBy ? $this->getSession()->orderBy : '') : $this->_order);
	}
	
	/**
	 * Add column
	 *
	 * @param 	Lumia_DataGrid_Column $column
	 * @return	Lumia_DataGrid_Abstract
	 */
	public function addColumn(Lumia_DataGrid_Column $column)
	{
		$column->setView($this->getView());
		$this->_columns[$column->getBody()->getName()] = $column;
		
		return $this;
	}

    /**
     * Remove a column
     *
     * @param 	Lumia_DataGrid_Body|string $column
     * @return 	Lumia_DataGrid_Abstract
     */
    public function removeColumn($column)
    {
    	if ($column instanceof Lumia_DataGrid_Body)
    	{
    		$column = $column->getName();
    	}
    	
        unset($this->_columns[$column]);
        
        return $this;
    }
	
	/**
	 * Add filter element
	 *
	 * @param	string $name
	 * @param 	string $type
	 * @return	Zend_Form_Element
	 */
	public function addFilterElement($name, $type = 'text')
	{
		$form = $this->_filter->addElement($type, $name, array(
				'filters' => array('StringTrim', 'StripTags'),
				'decorators' => array('ViewHelper')
		));
		
		return $form->getElement($name);
	}
	
	/**
	 * Get filter form
	 *
	 * @return	Lumia_Form
	 */
	public function getFilter()
	{
		return $this->_filter;
	}
	
	/**
	 * Set sort by keyword
	 *
	 * @param 	string $sort
	 * @return	Lumia_DataGrid_Abstract
	 */
	public function setSort($sort)
	{
		$this->_sort = (string) $sort;
		
		return $this;
	}
	
	/**
	 * Set order by keyword
	 *
	 * @param 	string $order
	 * @return	Lumia_DataGrid_Abstract
	 */
	public function setOrder($order)
	{
		$this->_order = (string) $order;
		
		return $this;
	}
	
	/**
	 * Set data sources
	 * 
	 * @param mixed $dataSource
	 * @return	Lumia_DataGrid_Abstract
	 */
	public function setDataSource($dataSource)
	{
		$this->_dataSource = $dataSource;
		
		return $this;
	}
	
	/**
	 * Get data sources
	 *
	 * @return Lumia_DataGrid_DataSource
	 */
	public function getDataSource()
	{
		return $this->_dataSource;
	}

    /**
     * Set the filter class to use
     *
     * @param  string $name
     * @return Lumia_DataGrid_Abstract
     */
    public function setFilterClass($name)
    {
        if (!class_exists($name)) 
        {
            Zend_Loader::loadClass($name);
        }

        $reflection = new ReflectionClass($name);
        if (!$reflection->isSubclassOf(new ReflectionClass('Lumia_DataGrid_Filter'))) 
        {
            throw new Lumia_DataGrid_Exception('Invalid Filter class specified');
        }

        $this->_filterClass = $name;
        
        return $this;
    }

    /**
     * Retrieve the container class
     *
     * @return string
     */
    public function getFilterClass()
    {
        return $this->_filterClass;
    }
	
	/**
	 * Prepare sort by keyword
	 * 
	 * @return Lumia_DataGrid_Abstract
	 */
	protected function _initSort()
	{
		$sort = $this->getRequest()->getParam('sort');
		if (!is_string($sort) || '' === $sort)
		{
			if ('' === ($sort = $this->getSort()))
			{
				$sort = self::SORT_ASC;
			}
		}

		$sort = strtoupper($sort);
		$this->setSort($sort);
		$this->_urlParams['sort'] = $sort;
		$this->getSession()->sortBy = $sort;
		
		return $this;
	}
	
	/**
	 * Prepare order by keyword
	 * 
	 * @return Lumia_DataGrid_Abstract
	 */
	protected function _initOrder()
	{
		$orderBy = $this->getRequest()->getParam('order');
		if (!is_string($orderBy) || '' === $orderBy)
		{
			if ('' === ($orderBy = $this->getOrder()))
			{
				$orderBy = $this->getPrimaryKey();
			}
		}
		
		$this->setOrder($orderBy);
		$this->_urlParams['order'] = $orderBy;
		$this->getSession()->orderBy = $orderBy;
		
		return $this;
	}
	
	/**
	 * Prepare pager
	 * 
	 * @return Lumia_DataGrid_Abstract
	 */
	protected function _initPager()
	{
		// Get current page number
		$currentPage = $this->getRequest()->getParam('page');
		if (!is_numeric($currentPage) || $currentPage === 0)
		{
			$currentPage = (is_numeric($this->getSession()->currentPageNumber) ? $this->getSession()->currentPageNumber : 1);
		} else
		{
			$this->_urlParams['page'] = $currentPage;
		}

		$this->getSession()->currentPageNumber = $currentPage;
		$this->getPaginator()->setCurrentPageNumber($currentPage);
		
		return $this;
	}
	
	/**
	 * Prepare data sources
	 * 
	 * @return	Lumia_DataGrid_Abstract
	 * @throws Lumia_DataGrid_Exception
	 */
	protected function _initDataSource()
	{
		if (is_array($this->_dataSource))
		{
			$adapterName = 'Lumia_DataGrid_DataSource_Array';
		} elseif ($this->_dataSource instanceof Zend_Db_Select)
		{
			$adapterName = 'Lumia_DataGrid_DataSource_Db_Select';
			$this->setFilterClass('Lumia_DataGrid_Filter_Db');
		} elseif ($this->_dataSource instanceof Zend_Db_Table_Select)
		{
			$adapterName = 'Lumia_DataGrid_DataSource_Db_Table_Select';
			$this->setFilterClass('Lumia_DataGrid_Filter_Db');
		} elseif ($this->_dataSource instanceof Zend_Db_Table_Rowset)
		{
			$adapterName = 'Lumia_DataGrid_DataSource_Rowset';
			$this->setFilterClass('Lumia_DataGrid_Filter_Db');
		} elseif ($this->_dataSource instanceof Iterator)
		{
			$adapterName = 'Lumia_DataGrid_DataSource_Iterator';
		} else
		{
			throw new Lumia_DataGrid_Exception('The data source provider: ' . get_class($this->_dataSource) . ' is not supported.');
		}

		// Init filtering & rebuild data source
		if (class_exists($filterClass = $this->getFilterClass()))
		{
			$instanceFilter = new $filterClass($this);
			$instanceFilter->init();
		}
		
		$this->_adapter = new $adapterName($this);
		if (!$this->_adapter instanceof Lumia_DataGrid_DataSource) 
		{
			throw new Lumia_DataGrid_Exception("Class '{$adapterName}' does not extend from 'Lumia_DataGrid_DataSource'");
		}
		
		return $this;
	}
	
	/**
	 * Prepare filters
	 * 
	 * @return	Lumia_DataGrid_Abstract
	 */
	protected function _initFilter()
	{
		if ($this->_filter->count())
		{
			// Add filter views script if not define
			if (null === $this->_filter->getDecorator('ViewScript')->getViewScript())
			{
				$this->_filter->getDecorator('ViewScript')->setViewScript('datagrid/filter.phtml');
			}
			
			// Add button search
			$this->addFilterElement('btnFilter', 'button')->setLabel('Form:@Button filter')->setOptions(array(
					'onclick' => 'LumiaJS.dataTable.get(\'' . $this->getGridId() . '\').filterForm.perform();'
			));;
			
			// Add button reset
			$this->addFilterElement('btnReset', 'button')->setLabel('Form:@Button reset')->setOptions(array(
					'onclick' => 'LumiaJS.dataTable.get(\'' . $this->getGridId() . '\').filterForm.reset();'
			));
			
			// Add button clear
			$this->addFilterElement('btnClear', 'button')->setLabel('Form:@Button clear')->setOptions(array(
					'onclick' => 'LumiaJS.dataTable.get(\'' . $this->getGridId() . '\').filterForm.clear();'
			));
		}
		
		return $this;
	}
	
	/**
	 * Prepare view
	 * 
	 * @return	Lumia_DataGrid_Abstract
	 */
	protected function _initView()
	{
		// Init data grid view helper
		$viewHelper = new Lumia_DataGrid_ViewHelper($this->_urlParams);
		$viewHelper->setView($this->getView());
		$viewHelper->name = $this->getGridId();
		$viewHelper->dataSource = $this->_adapter->getDataSource();
		$viewHelper->columns = $this->getColumns();
		$viewHelper->currentUrl = $this->getRequest()->getServer('REQUEST_URI');
		$viewHelper->httpReferer = $this->getRequest()->getServer('HTTP_REFERER');
		$viewHelper->paginator = $this->getPaginator();
		$viewHelper->sortType = $this->getSort();
		$viewHelper->orderBy = $this->getOrder();
		$viewHelper->primaryKey = $this->getPrimaryKey();
		$viewHelper->filter = $this->getFilter();
		
		// Inject helper named 'dataGrid' into view
		$this->getView()->registerHelper($viewHelper, 'dataGrid');
		
		return $this;
	}
	
	/**
	 * Render the data grid
	 *
	 * @param	string $viewScript
	 * @return 	string
	 */
	public function deploy($viewScript = NULL)
	{
		if (!is_scalar($viewScript) || !(strlen($viewScript) > 0))
		{
			$viewScript = $this->_viewScript;
		}
		
		try
		{
			// Process data
			$refClass = new ReflectionClass($this);
			$methodNames = $refClass->getMethods(ReflectionMethod::IS_PROTECTED);
			foreach ($methodNames as $obj)
			{
				$method = $obj->getName();
				if ('_prepare' === substr($method, 0, 8))
				{
					$this->{$method}();
				}
			}
			
			$this->_initPager();
			$this->_initOrder();
			$this->_initSort();
			$this->_initFilter();
			$this->_initDataSource();
			$this->_initView();
			
			$content = (PHP_EOL . '<form name="' . $this->getGridId() . '" id="' . $this->getGridId() . '" method="post">' 
				. PHP_EOL . '<script type="text/javascript">'
				. PHP_EOL . '//<![CDATA['
				. PHP_EOL . 'jQuery(document).ready(function(){'
            	. PHP_EOL . '	LumiaJS.dataTable.set(\'' . $this->getGridId() . '\', \'' . addslashes($this->getView()->url($this->_urlParams)) . '\');'
       			. PHP_EOL . '});'
       			. PHP_EOL . '//]]>'
				. PHP_EOL . '</script>'
				. PHP_EOL . $this->getView()->render($viewScript)
				. PHP_EOL . '</form>' . PHP_EOL);
			
			if ($this->getRequest()->isXmlHttpRequest() || $this->getRequest()->getParam('requestType') === 'ajax')
			{
				// Disable layout
				if (null !== ($layout = Zend_Layout::getMvcInstance())) 
				{
					$layout->disableLayout();
				}
				
				// Disable view renderer
				Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->setNoRender(true);
				
				$this->getResponse()->clearBody();
				$this->getResponse()->setHttpResponseCode(200);
				$this->getResponse()->setBody($content);
				$this->getResponse()->sendHeaders();
				$this->getResponse()->sendResponse();
				die();
			}
			
			// Render view
			return $content;
			
		} catch (Exception $e)
		{
			$message = "Exception caught by grid: " . $e->getMessage() . "\nStack Trace:\n" . $e->getTraceAsString();
            trigger_error($message, E_USER_WARNING);
            return '';
		}
	}

    /**
     * Serialize as string
     *
     * Proxies to {@link deploy()}.
     *
     * @return string
     */
    public function __toString()
    {
    	return $this->deploy();
    }
	
	/**
	 * Prepare data source abstract function
	 */
	abstract protected function _prepareDataSource();
	
	/**
	 * Prepare columns abstract function
	 */
	abstract protected function _prepareColumns();
}