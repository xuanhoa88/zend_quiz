<?php

class Admin_DataGrid_Question extends Lumia_DataGrid
{
	/**
	 * View script
	 *
	 * @var string
	 */
	protected $_viewScript = 'question/datagrid.phtml';
	
	/**
	 * Constructor
	 */
    public function __construct()
    {
        $this->setPrimaryKey('question_id');
        
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
        $questionDbTable = new Admin_Db_Table_Question();
        $this->setDataSource($questionDbTable->dataGridByCreator(Admin_Auth::getInstance()->getUser()->user_id));
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
    	$checkboxColumnBody = new Lumia_DataGrid_Body_Checkbox('question_id');
    	$checkboxColumnHeader = new Lumia_DataGrid_Header_Checkbox();
        $this->addColumn(new Lumia_DataGrid_Column($checkboxColumnBody, $checkboxColumnHeader));
        
        // Content
        $nameColumnBody = new Admin_DataGrid_Question_Body_Content('question_content');
        $nameColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Name', array('id' => 'table-header-question-content'));
        $this->addColumn(new Lumia_DataGrid_Column($nameColumnBody, $nameColumnHeader));
        
        // Subject
        $subjectColumnBody = new Lumia_DataGrid_Body_Text('subject_name');
        $subjectColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Subject');
        $this->addColumn(new Lumia_DataGrid_Column($subjectColumnBody, $subjectColumnHeader));
        
        // Chapter
        $chapterColumnBody = new Lumia_DataGrid_Body_Text('chapter_name');
        $chapterColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Chapter');
        $this->addColumn(new Lumia_DataGrid_Column($chapterColumnBody, $chapterColumnHeader));
        
        // Type
        $typeColumnBody = new Admin_DataGrid_Question_Body_Type('question_type');
        $typeColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Type');
        $this->addColumn(new Lumia_DataGrid_Column($typeColumnBody, $typeColumnHeader));
        
        // Level
        $levelColumnBody = new Lumia_DataGrid_Body_Text('question_level_name');
        $levelColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Level');
        $this->addColumn(new Lumia_DataGrid_Column($levelColumnBody, $levelColumnHeader));
        
        // Status
        $statusColumnBody = new Admin_DataGrid_Question_Body_Status('question_status');
        $statusColumnHeader = new Lumia_DataGrid_Header_Text('QuestionListView:@Status');
        $this->addColumn(new Lumia_DataGrid_Column($statusColumnBody, $statusColumnHeader));
        
        // Action
        $actionColumnBody = new Admin_DataGrid_Question_Body_Action();
        $actionColumnHeader = new Lumia_DataGrid_Header_Text();
        $this->addColumn(new Lumia_DataGrid_Column($actionColumnBody, $actionColumnHeader));
    }
}