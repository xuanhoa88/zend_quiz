<?php

class Lumia_Form_Decorator_Period extends Zend_Form_Decorator_Abstract
{

    /**
     * Constructor
     *
     * @param  array|Zend_Config $options
     * @return void
     */
    public function __construct($options = null)
    {
        parent::__construct($options);
        
        if (!$this->getOption('attrs'))
        {
        	$view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
        	$this->setOption('attrs', array(
        			'begin' => array('placeholder' => $view->translate('Time begin')),
        			'end' => array('placeholder' => $view->translate('Time end'))
        	));
        }
    }

	/**
	 * Decorate content and/or element
	 *
	 * @param string $content        	
	 * @return string
	 * @throws Zend_Form_Decorator_Exception when unimplemented
	 */
	public function render($content)
	{
		$element = $this->getElement();
		if (! $element instanceof Lumia_Form_Element_Period)
		{
			// only want to render Date elements
			return $content;
		}
		
		$view = $element->getView();
		if (! $view instanceof Zend_View_Interface)
		{
			// using view helpers, so do nothing if no view present
			return $content;
		}
		
		$begin = $element->getBegin();
		$end = $element->getEnd();
		$name = $element->getFullyQualifiedName();
		$params = $this->getOption('attrs');
		
		if ($element->getTemplate())
		{
			$markup = '';
			foreach (array('begin', 'end') as $el)
			{
				$element->setAttribs($params[$el]);
				$markup .= str_replace('%input%', $view->formText($name . '[' . $el . ']', ${$el}, $element->getAttribs()), (string) $element->getTemplate());
			}
		} else 
		{
			$markup = $view->formText($name . '[begin]', $day, $params) . ' / '
					. $view->formText($name . '[end]', $year, $yearParams);
		}
		
		switch ($this->getPlacement())
		{
			case self::PREPEND:
				return $markup . $this->getSeparator() . $content;
			case self::APPEND:
			default:
				return $content . $this->getSeparator() . $markup;
		}
	}
}