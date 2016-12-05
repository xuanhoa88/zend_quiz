<?php
class Admin_Form_Media extends Lumia_Form
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'media/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
		
		// Set the form's attributes
		$this->setName('mediaForm');
		$this->setAction($this->getView()->baseUrl('admin/media/upload'));
		$this->setMethod(self::METHOD_POST);
		$this->setAttrib('enctype', self::ENCTYPE_MULTIPART);
		
		// Token
		$token = new Zend_Form_Element_Hash('media_hash');
		$token->setOptions(array(
				'required' => false,
				'value' => uniqid(md5(__CLASS__)),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($token);
		
		// Id
		$id = new Zend_Form_Element_Hidden('media_id');
		$id->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'ValueDisabled' => true,
				'decorators' => array('ViewHelper')
		));
		$this->addElement($id);
		
		// Define a destination
		$targetFolder = realpath(APPLICATION_PATH . '/../uploads'); // Relative to the root
		
		// File
		$file = new Zend_Form_Element_File('media_url');
		$file->setOptions(array(
				'label' => 'MediaForm:@Media files',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiple' => 'true',
				'validators' => array(array('Count', false, 1)),
				'decorators' => array('File')
		));
		$file->setValueDisabled(true);
        $this->addElement($file);
        
        // Upload button
        $submit = new Zend_Form_Element_Button('btnUpload');
        $submit->setOptions(array(
        		'label' => 'Uploadify:@Button upload',
        		'type' => 'button',
        		'onclick' => 'LumiaJS.admin.media.upload(this)',
        		'decorators' => array('ViewHelper')
        ));
        $this->addElement($submit);
        
        // Cancel button
        $submit = new Zend_Form_Element_Button('btnCancel');
        $submit->setOptions(array(
        		'label' => 'Uploadify:@Button cancel',
        		'type' => 'button',
//         		'onclick' => 'LumiaJS.admin.media.cancel(this)',
        		'decorators' => array('ViewHelper')
        ));
        $this->addElement($submit);
        
        // Stop button
        $submit = new Zend_Form_Element_Button('btnStop');
        $submit->setOptions(array(
        		'label' => 'Uploadify:@Button stop',
        		'type' => 'button',
        		'onclick' => 'LumiaJS.admin.media.stop(this)',
        		'decorators' => array('ViewHelper')
        ));
        $this->addElement($submit);
	}
}
