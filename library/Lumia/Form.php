<?php

class Lumia_Form extends Zend_Form
{
	/**
	 * View script path
	 * 
	 * @var	string
	 */	
	protected $_viewScript;
	
	/**
     * Initialize form (used by extending classes)
     *
     * @return void
     */
	public function init()
	{
		$this->addElementPrefixPath('Lumia_Validate_', 'Lumia/Validate', 'validate');
		$this->addElementPrefixPath('Lumia_Filter_', 'Lumia/Filter', 'filter');
		$this->setDecorators(array(array('ViewScript', array('viewScript' => $this->_viewScript))));
	}
	
	/**
	 * Set the custom view script
	 *
	 * @param string $viewScript
	 * @return Lumia_Form
	 */
	public function setViewScript($viewScript)
	{
		$this->getDecorator('ViewScript')->setViewScript($viewScript);
	
		return $this;
	}
    
	/**
     * Render form
     *
     * @param  Zend_View_Interface $view
     * @return string
     */
    public function render(Zend_View_Interface $view = null)
    {
        $this->getView()->JQueryValidateForm($this);
        
        return parent::render($view);
    }
}
