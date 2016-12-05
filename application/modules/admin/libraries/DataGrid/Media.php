<?php

class Admin_DataGrid_Media extends Lumia_DataGrid
{
	/**
	 * View script
	 *
	 * @var string
	 */
	protected $_viewScript = 'media/datagrid.phtml';
	
	/**
	 * @var array
	 */
	protected $_options = array();
	
	/**
	 * Constructor
	 */
    public function __construct(array $options)
    {
    	$this->_options = $options;
    	
        $this->setPrimaryKey('media_id');
        $this->setSort(self::SORT_DESC);
        
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
        $mediaDbTable = new Admin_Db_Table_Media();
        $this->setDataSource($mediaDbTable->dataGrid($this->_options));
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('media_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Creator
        $subjectColumnBody = new Lumia_DataGrid_Body_Text('subject_creator');
        $subjectColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Subject');
        $this->addColumn(new Lumia_DataGrid_Column($subjectColumnBody, $subjectColumnHeader));
        
        // URL
        $chapterColumnBody = new Lumia_DataGrid_Body_Text('media_url');
        $chapterColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Chapter');
        $this->addColumn(new Lumia_DataGrid_Column($chapterColumnBody, $chapterColumnHeader));
        
        // Type
        $typeColumnBody = new Lumia_DataGrid_Body_Text('media_type');
        $typeColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Type');
        $this->addColumn(new Lumia_DataGrid_Column($typeColumnBody, $typeColumnHeader));
        
        // Date created
        $levelColumnBody = new Lumia_DataGrid_Body_Text('media_date_created');
        $levelColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Level');
        $this->addColumn(new Lumia_DataGrid_Column($levelColumnBody, $levelColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Media_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}