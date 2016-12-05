<?php
class Admin_Form_Import_Student extends Admin_Form_Import
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'import/form/student.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->getView()->fileUploaded = false;
		$this->setAction($this->getView()->baseUrl('admin/import/student'));
		
		parent::init();
		
		// Format
		$format = new Zend_Form_Element_Select('import_format');
		$format->setOptions(array(
				'label' => 'ImportForm:@Format',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(null => 'Form:@Unselected'),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		$imexModel = new Admin_Model_Import();
		$imexRows = $imexModel->allActivate(strtoupper(Admin_Const::ROLE_CODE_STUDENT));
		if ($imexRows->count())
		{
			foreach ($imexRows as $imexRow)
			{
				$format->addMultiOption($imexRow->imex_id, $imexRow->imex_name);
			}
		}
		$this->addElement($format);
	}
	
	/**
     * Add more fields when upload success
     * 
     * @param	string $filePath
     * @return 	void
     */
    public function whenUploadSucceeded($filePath)
    {
    	// Set flag
    	$this->getView()->fileUploaded = true;
    	
    	// Set form enctype
    	$this->setAttrib('enctype', self::ENCTYPE_URLENCODED);
    	
    	// Set value
    	$this->getElement('when_upload_succeeded')->setValue($this->getTranslator()->translate('ImportForm:@The file are uploaded success'));
    	
    	// Processing data button
		$submit = new Zend_Form_Element_Button('btnProcess');
		$submit->setOptions(array(
				'label' => 'Form:@Button continue',
				'type' => 'button',
				'onClick' => 'LumiaJS.admin.import.processingStudent(\'' . $filePath . '\'); return false;',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($submit);
    }
}
