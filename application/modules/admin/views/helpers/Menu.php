<?php
class Admin_View_Helper_Menu extends Zend_View_Helper_Navigation_Menu 
{
	
	/**
	 * Returns an HTML string containing an 'a' element for the given page if
	 * the page's href is not empty, and a 'span' element if it is empty
	 *
	 * Overrides {@link Zend_View_Helper_Navigation_Abstract::htmlify()}.
	 *
	 * @param Zend_Navigation_Page $page
	 *        	page to generate HTML for
	 * @return string HTML string for the given page
	 */
	public function htmlify(Zend_Navigation_Page $page) 
	{
		// get label and title for translating
		$label = $page->getLabel ();
		$title = $page->getTitle ();
		
		// translate label and title?
		if ($this->getUseTranslator () && $t = $this->getTranslator ()) 
		{
			if (is_string ( $label ) && ! empty ( $label )) 
			{
				$label = $t->translate ( $label );
			}
			
			if (is_string ( $title ) && ! empty ( $title )) 
			{
				$title = $t->translate ( $title );
			}
		}
		
		// get attribs for element
		$attribs = array (
				'id' => $page->getId (),
				'title' => $title,
				'class' => $page->getClass () 
		);
		
		// does page have a href?
		$href = $page->getHref ();
		$element = 'a';
		$attribs ['href'] = ($href ? $href : 'javascript:void(0)');
		$attribs ['target'] = $page->getTarget ();
		
		// Has child?
		$hasChild = $page->hasPages();
		
		// Add css class
		if (!$hasChild)
		{
			$attribs ['class'] = $page->isActive () ? 'active' : '';
		}
		
		// Add an arrow if a ul has a ul child
		$arrow = ($hasChild ? ' <span class="fa arrow"></span>' : '');
		return '<' . $element . $this->_htmlAttribs ( $attribs ) . '>' . $this->view->escape ( $label ) . $arrow . '</' . $element . '>';
	} 
}