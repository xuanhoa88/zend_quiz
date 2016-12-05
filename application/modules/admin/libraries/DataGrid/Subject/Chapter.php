<?php

class Admin_DataGrid_Subject_Chapter extends Lumia_DataGrid
{
	/**
	 * View script
	 * 
	 * @var string
	 */
	protected $_viewScript = 'chapter/datagrid.phtml';
	
	/**
	 * Controller options
	 */
	protected $_options;
	
	/**
	 * Constructor
	 */
    public function __construct(array $options = array())
    {
    	$this->_options = new Zend_Config($options);
        $this->setPrimaryKey('chapter_id');
        
        parent::__construct();
    }

    /**
     * Prepare data source
     * 
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareDataSource()
     */
    protected function _prepareDataSource()
    {
        $subjectDbTable = new Admin_Db_Table_Subject_Chapter();
        $this->setDataSource($subjectDbTable->dataGridBySubject(array($this->_options->subjectId)));
    }
	
    /**
     * Prepare columns in data grid
     * 
     * (non-PHPdoc)
     * @see Lumia_DataGrid::_prepareColumns()
     */
    protected function _prepareColumns()
    {
    	// Checkbox
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('chapter_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Name
        $nameColumnBody = new Lumia_DataGrid_Body_Text('chapter_name');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('ChapterListView:@Name');
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Order
        $orderColumnBody = new Admin_DataGrid_Subject_Chapter_Body_Order('chapter_order[]');
        $orderColumnHeader = new Lumia_DataGrid_Header_Text('ChapterListView:@Order');
        $this->addColumn(new Lumia_DataGrid_Column($orderColumnBody, $orderColumnHeader));
        
        // Subject
        $subjectColumnBody = new Lumia_DataGrid_Body_Text('subject_name');
        $subjectColumnHeader = new Lumia_DataGrid_Header_Text('ChapterListView:@Subject');
        $this->addColumn(new Lumia_DataGrid_Column($subjectColumnBody, $subjectColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_Subject_Chapter_Body_Status('chapter_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('ChapterListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Subject_Chapter_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}