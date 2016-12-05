<?php
class Admin_Form_Import extends Lumia_Form
{
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();

		// Set the form's attributes
		$this->setName('importForm');
		$this->setMethod(self::METHOD_POST);
		$this->setAttrib('enctype', self::ENCTYPE_MULTIPART);
		
		// File source
		$targetFolder = LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR; // Relative to the root
		Lumia_Utility_Filesystem::makeDirectories($targetFolder);
		$file = new Zend_Form_Element_File('import_file');
		$file->setOptions(array(
				'label' => 'ImportForm:@File',
				'required' => true,
				'destination' => $targetFolder,
				'validators' => array(
						array('Count', false, 1),
						array('Size', false, Lumia_Utility_Filesystem::getFileUploadMaxSize()),
						array('Extension', false, 'xls, xlsx')
				),
				'decorators' => array(
					'File', 
					array(
						'ViewScript', 
						array(
				        	'viewScript' => 'import/form/file.phtml',
				        	'placement' => false,
			    		)
					)
				)
		));
		$this->addElement($file);
		
		// When uploaded success
		$whenUploadSucceeded = new Zend_Form_Element_Text('when_upload_succeeded');
		$whenUploadSucceeded->setOptions(array(
				'label' => 'ImportForm:@File',
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'disabled' => 'disabled',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($whenUploadSucceeded);

		// Ignore header
		$ignoreHeader = new Zend_Form_Element_Checkbox('import_ignore_header');
		$ignoreHeader->setOptions(array(
				'label' => 'ImportForm:@Ignore header',
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'value' => 1,
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($ignoreHeader);
		
		// Save button
		$submit = new Zend_Form_Element_Submit('btnSave');
		$submit->setOptions(array(
				'label' => 'Form:@Button save',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($submit);

		// Reset button
		$submit = new Zend_Form_Element_Button('btnReset');
		$submit->setOptions(array(
				'label' => 'Form:@Button reset',
				'type' => 'reset',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($submit);
		
		// Download button
		$submit = new Zend_Form_Element_Button('btnDownload');
		$submit->setOptions(array(
				'label' => 'ImportForm:@Download format',
				'type' => 'button',
				'onClick' => 'LumiaJS.admin.import.downloadFormat(); return false;',
				'decorators' => array('ViewHelper')
		));

		$this->addElement($submit);
	}
}
