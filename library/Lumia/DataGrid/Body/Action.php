<?php

class Lumia_DataGrid_Body_Action extends Lumia_DataGrid_Body
{

    /**
     * @var array
     */
    protected $_hooks = array();

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct($name = null)
    {
    	parent::__construct($name ? $name : time());
    	
    	// Auto disable sorting
    	$this->disableSort();
    }

    /**
     * Add hook
     *
     * @param 	mixed $hook
     * @return	Lumia_DataGrid_Body_Action	            
     */
    public function addHook($hook)
    {
    	if (is_callable($hook) || is_array($hook))
        {
        	$this->_hooks[] = $hook;
        }
    }

    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
//     	$this->getView()->clearVars();
    	$rowData = $this->getData();
        $render = array();
        $mustHave = array('label', 'href');
        foreach ($this->_hooks as $hook) 
        {
        	if (is_callable($hook))
        	{
        		$render[] = (string) call_user_func($hook, $rowData, $this->getView());
        		continue;
        	}
        	
            if (!is_array($hook) || !(count(array_intersect($mustHave, array_keys($hook))) === count($mustHave))) 
            {
                continue;
            }
            
            // Is encrypt flag enabled?
            $encrypt = array();
            if (array_key_exists('encrypt', $hook)) 
            {
                $encrypt = (array) $hook['encrypt'];
                unset($hook['encrypt']);
            }
            
            // Get label
            $label = $hook['label'];
            unset($hook['label']);
            
            // Get url
            if (preg_match_all('/\:(?P<fields>\w+)/', $hook['href'], $matches)) 
            {
                foreach ($matches['fields'] as $_index => $_key) 
                {
                    $_val = isset($rowData[$_key]) ? $rowData[$_key] : null;
                    if (in_array($_key, $encrypt, true)) 
                    {
                        $_val = Lumia_Cryptography::factory('HashID')->encrypt($_val);
                    }
                    
                    $hook['href'] = str_replace($matches[0][$_index], $_val, $hook['href']);
                }
            }
            
            // Create item
            $render[] = '<a' . $this->_attributesToHtml($hook) . '>' . $label . '</a>';
        }
        
        return $this->getView()->htmlList($render, false, false, false);
    }
}