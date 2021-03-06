<?php

class Lumia_Form_Decorator_ExamStartTime extends Zend_Form_Decorator_Abstract
{
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
		if (! $element instanceof Lumia_Form_Element_ExamStartTime)
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
		
		$day = $element->getDay();
		$month = $element->getMonth();
		$year = $element->getYear();
		$hour = $element->getHour();
		$minute = $element->getMinute();
		$name = $element->getFullyQualifiedName();
		
		if ($element->getTemplate())
		{
			$markup = '';
			foreach (array('day', 'month', 'year', 'hour', 'minute') as $key)
			{
				$element->setAttribs(is_array($atts = $this->getOption($key)) ? $atts : array());
				$markup .= str_replace('%input%', $view->formText($name . '[' . $key . ']', ${$key}, $element->getAttribs()), (string) $element->getTemplate());
			}
		} else 
		{
			$markup = $view->formText($name . '[day]', $day, $this->getOption('day')) . ' / '
					. $view->formText($name . '[month]', $month, $this->getOption('month')) . ' / '
					. $view->formText($name . '[year]', $year, $this->getOption('year')) . ' / '
					. $view->formText($name . '[hour]', $year, $this->getOption('hour')) . ' / '
					. $view->formText($name . '[minute]', $year, $this->getOption('minute'));
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