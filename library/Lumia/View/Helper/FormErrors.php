<?php

/**
 * Lumia_View_Helper_FormErrors
 *
 * @category   Lumia
 * @package    Lumia_View_Helper
 */
class Lumia_View_Helper_FormErrors extends Zend_View_Helper_FormErrors
{
	/**
	 * Render form errors
	 *
	 * @param 	string|array $errors Error(s) to render
	 * @param 	array $options        	
	 * @return 	string
	 */
	public function formErrors($errors, array $options = null)
	{
		if (! is_array($errors) || ! count($errors))
		{
			return '';
		}

		$escape = true;
		if (isset($options['escape']))
		{
			$escape = (bool) $options['escape'];
			unset($options['escape']);
		}
		
		if (empty($options['class']))
		{
			$options['class'] = 'errors';
		}
		
		if (isset($options['elementStart']))
		{
			$this->setElementStart($options['elementStart']);
		}
		if (isset($options['elementEnd']))
		{
			$this->setElementEnd($options['elementEnd']);
		}
		if (isset($options['elementSeparator']))
		{
			$this->setElementSeparator($options['elementSeparator']);
		}
		
		$start = $this->getElementStart();
		if (strstr($start, '%s'))
		{
			$attribs = $this->_htmlAttribs($options);
			$start = sprintf($start, $attribs);
		}
		
		// Flattens a multi-dimensional associative array down into a 1 dimensional
		$flatArray = array();
		foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($errors)) as $k => $v)
		{
			$flatArray[$k] = $v;
		}
		
		if ($escape)
		{
			foreach ($flatArray as $key => $error)
			{
				$errors[$key] = $this->view->escape($error);
			}
		}
		
		$msg = array_shift($flatArray);
		$html = $start . $msg . $this->getElementEnd();
		
		return $html;
	}
}
