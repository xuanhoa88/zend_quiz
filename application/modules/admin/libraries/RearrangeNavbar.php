<?php
class Admin_RearrangeNavbar 
{
	/**
	 *
	 * @var Zend_View_Interface
	 */
	protected $_view;
	
	/**
	 * Constructor
	 *
	 * Registers form view helper as decorator
	 *
	 * @param mixed $options        	
	 */
	public function __construct(Zend_View_Interface $view = null) 
	{
		$this->_view = $view;
	}
	
	/**
	 * Returns all elements as <ul>/<li> structure
	 * Possible options:
	 * - list (simple <ul><li>)
	 *
	 * @param	array $tree
	 * @return 	string
	 */
	public function _toHtml(array $tree) 
	{
		$html = '';
		
		// find deepest active
		$minDepth = 0;
		
		// iterate container
		$prevDepth = - 1;
		
		foreach ($tree as $node) 
		{
			if (!isset($node['depth'], $node['navigation_id'], $node['navigation_name']) || ($node['depth'] < $minDepth)) 
			{
				// page is below minDepth or not accepted by acl/visibilty
				continue;
			}
			
			// get depth of item
			$depth = $node['depth'];
			
			// make sure indentation is correct
			$depth -= $minDepth;
			
			if ($depth > $prevDepth) 
			{
				// start new ul tag
				$html .= '<ol' . ($depth == 0 ? ' class="sortable"' : '') . '>' . PHP_EOL;
			} else if ($prevDepth > $depth) 
			{
				// close li/ul tags until we're at current depth
				for ($i = $prevDepth; $i > $depth; $i --) 
				{
					$html .= '    </li>' . PHP_EOL;
					$html .= '</ol>' . PHP_EOL;
				}
				
				// close previous li tag
				$html .= '    </li>' . PHP_EOL;
			} else 
			{
				// close previous li tag
				$html .= '    </li>' . PHP_EOL;
			}
			
			// render li tag and page
			$html .= '    <li id="nav_' . $node['navigation_id'] . '">' . PHP_EOL . '        ' . '<div><span class="disclose"><span></span></span>' . $this->_view->translate($node['navigation_name']) . '</div>' . PHP_EOL;
			
			// store as previous depth for next iteration
			$prevDepth = $depth;
		}
		
		if ($html) 
		{
			// done iterating container; close open ul/li tags
			for ($i = $prevDepth + 1; $i > 0; $i --) 
			{
				$html .= '    </li>' . PHP_EOL . '</ol>' . PHP_EOL;
			}
			
			$html = rtrim( $html, PHP_EOL );
		}
		
		return $html;
	}
	
	/**
	 * Render form
	 *
	 * @param Zend_View_Interface $view        	
	 * @return string
	 */
	public function render() 
	{
		return $this->_toHtml(Admin_Auth::getInstance()->getNavigation()->toArray());
	}
}
