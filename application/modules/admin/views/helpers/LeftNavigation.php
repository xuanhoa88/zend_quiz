<?php

class Admin_View_Helper_LeftNavigation extends Zend_View_Helper_Abstract
{
	/**
	 * @var Admin_View_Helper_Menu
	 */
	protected $_menu;
	
	/**
	 * View helper entry point:
	 * Retrieves helper and optionally sets container to operate on
	 *
	 * @return Admin_View_Helper_LeftNavigation
	 */
	public function leftNavigation()
	{
		// Build hierarchies
		$hierarchies = $this->_toHierarchies(Admin_Auth::getInstance()->getNavigation()->toArray());
		$navigation = new Zend_Navigation($hierarchies);
		$this->_menu = $this->view->navigation($navigation)->menu();
		$this->_menu->setUlClass('nav');
		
		// Get current url
		$currentUrl = rtrim(Zend_Controller_Front::getInstance ()->getRequest ()->getRequestUri (), '/');
		
		// If current url not match with list urls
		if (!($currentPage = $navigation->findOneByUri ( $currentUrl ))) 
		{
			// Put each element into an array.
			$segments = explode('/', $currentUrl);
			$count = count($segments);
			if ($count === 0)
			{
				return;
			}
			
			// Separate url to sub-url
			for ($i = 1; $i < $count; $i++)
			{
				$segments[$i] = ($segments[$i - 1] . '/' . $segments[$i]);
			}
			
			// Reverse order
			$segments = array_reverse($segments);
			
			// Check for an exact match
			foreach ($segments as $segment)
			{
				// Break out of the loop, we've found an exact match;
				if ($currentPage = $navigation->findOneByUri ( $segment ))
				{
					break;
				}
			}
		}
		
		if ($currentPage instanceof Zend_Navigation_Page_Uri)
		{
		    // Set active
		    $currentPage->setActive ( true );
		    	
		    // Set active flag for own parent
		    $currentPage = $currentPage->getParent ();
		    while ( $currentPage instanceof Zend_Navigation_Page_Uri )
		    {
		        $currentPage->setActive ( true );
		        $currentPage = $currentPage->getParent ();
		    }
		}
		
		return $this;
	}
	
	/**
     * Renders helper
     *
     * @return string
     */
    public function __toString()
    {
		return $this->_menu->render();
    }

	/**
	 * Convert a tree array (with depth) into a hierarchical array.
	 *
	 * @param 	$nodes|array   Array with depth value.
	 * @return 	array
	 */
	protected function _toHierarchies(array $nodes)
	{
		$result = array();
		if (count($nodes) > 0)
		{
			$stackLevel = 0;
				
			// Node Stack. Used to help building the hierarchy
			$stack = array();
				
			foreach ($nodes as $node)
			{
				$node['type'] = 'Zend_Navigation_Page_Uri';
				$node['id'] = (int) $node['navigation_id'];
				$node['label'] = $this->view->translate($node['navigation_name']);
				$node['uri'] = $this->_internalURL($node['navigation_url']) ? $this->view->baseUrl(rtrim($node['navigation_url'], '/')) : $node['navigation_url'];
				$node['pages'] = array();

				// Number of stack items
				$stackLevel = count($stack);

				// Check if we're dealing with different levels
				while ($stackLevel > 0 && $stack[$stackLevel - 1]['navigation_level'] >= $node['navigation_level'])
				{
					// remove the navigation_level after processed
					unset($stack[$stackLevel - 1]['navigation_level']);
						
					array_pop($stack);
					$stackLevel --;
				}

				// Stack is empty (we are inspecting the root)
				if ($stackLevel == 0)
				{
					// Assigning the root node
					$i = count($result);
					$result[$i] = $node;
					$stack[] = & $result[$i];
				} else
				{
					// Add node to parent
					$i = count($stack[$stackLevel - 1]['pages']);
					$stack[$stackLevel - 1]['pages'][$i] = $node;
					$stack[] = & $stack[$stackLevel - 1]['pages'][$i];
				}
			}
		}

		return $result;
	}

	/**
	 * Validate internal URL
	 * 
	 * @param	string $url
	 * @return	bool
	 */
	protected function _internalURL( $url ) 
	{
		// Abort if parameter URL is empty
		if ( !is_string($url) || empty($url) ) 
		{
			return false;
		}

		// Parse parameter URL
		$currentUrl = parse_url($url);
		if (empty($currentUrl['host']))
		{
			return true;
		}
		
		// Parse home URL
		$baseUrl = parse_url($this->view->baseUrl());
		
		// Is an internal link
		if ($currentUrl['host'] == $baseUrl['host']) 
		{
			return true;
		}
	  
		// Is an external link
		return false;
	}
}
