<?php

abstract class Lumia_DataGrid_Column_Abstract extends Lumia_DataGrid_Option
{
    /**
     * View object
     *
     * @var Zend_View_Interface
     */
    protected $_view;
    
    /**
     * Column attributes
     * 
     * @var array
     */
    protected $_attributes = array();

    /**
     * Set the View object
     *
     * @param  	Zend_View_Interface $view
     * @return	Lumia_DataGrid_Column_Abstract
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->_view = $view;
        
        return $this;
    }

    /**
     * Set the View object
     *
     * @return  Zend_View_Interface
     */
    public function getView()
    {
    	if (!($this->_view instanceof Zend_View_Interface))
    	{
    		throw new Lumia_DataGrid_Exception('The view provider does not extend from \'Zend_View_Interface\'');
    	}
    	
    	return $this->_view;
    }

    /**
     * Set column attribute
     *
     * @param  	string $name
     * @param  	mixed $value
     * @return	Lumia_DataGrid_Column_Abstract
     */
    public function setAttribute($name, $value)
    {
        $name = $this->_filter($name);
        if ('' === $name) 
        {
            throw new Lumia_DataGrid_Exception(sprintf('Invalid attribute "%s" provided; must contain only valid variable characters and be non-empty', $name));
        }

        $this->_attributes[$name] = $value;

        return $this;
    }

    /**
     * Add column attribute
     *
     * @param  	string $name
     * @param  	mixed $value
     * @return	Lumia_DataGrid_Column_Abstract
     */
    public function addAttribute($name, $value)
    {
        $name = $this->_filter($name);
        if ('' === $name) 
        {
            throw new Lumia_DataGrid_Exception(sprintf('Invalid attribute "%s" provided; must contain only valid variable characters and be non-empty', $name));
        }
		
        if ($this->hasAttribute($name))
        {
        	if (!is_array($this->_attributes[$name]))
        	{
        		$this->_attributes[$name] = (array) $this->_attributes[$name];
        	}
        	
        	$this->_attributes[$name] = array_merge($this->_attributes[$name], (array) $value);
        } else
        {
        	$this->_attributes[$name] = $value;
        }

        return $this;
    }

    /**
     * Set multiple attributes at once
     *
     * @param  array $attributes
     * @return Lumia_DataGrid_Column_Abstract
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $key => $value) 
        {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * Retrieve element attribute
     *
     * @param  string $name
     * @return mixed
     */
    public function getAttribute($name)
    {
        $name = (string) $name;
        if (isset($this->_attributes[$name])) 
        {
            return $this->_attributes[$name];
        }

        return null;
    }

    /**
     * Is attribute registered?
     *
     * @return boolean
     */
    public function hasAttribute($name)
    {
        return array_key_exists($name, $this->_attributes);
    }

    /**
     * Return all attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->_attributes;
    }

    /**
     * Remove element attribute
     *
     * @param  string $name
     * @return Lumia_DataGrid_Column_Abstract
     */
    public function removeAttribute($name)
    {
        if ($this->hasAttribute($name))
        {
        	unset($this->_attributes[$name]);
        }

        return $this;
    }
    
    /**
     * Alias of _attributesToHtml()
     */
    public function attributesToHtml()
    {
    	return $this->_attributesToHtml($this->getAttributes());
    }
    
    /**
     * Converts an associative array to a string of tag attributes.
     *
     * @param array $attribs From this array, each key-value pair is converted to an attribute name and value.
     * @return string The XHTML for the attributes.
     */
    protected function _attributesToHtml(array $attribs)
    {
    	$xhtml = ' ';
        foreach ($attribs as $key => $val) 
        {
            $key = $this->getView()->escape($key);
            if (('on' == substr($key, 0, 2)) || ('constraints' == $key)) 
            {
                // Don't escape event attributes; _do_ substitute double quotes with singles
                if (!is_scalar($val)) 
                {
                    // non-scalar data should be cast to JSON first
                    $val = Zend_Json::encode($val);
                }
                // Escape single quotes inside event attribute values.
                // This will create html, where the attribute value has
                // single quotes around it, and escaped single quotes or
                // non-escaped double quotes inside of it
                $val = str_replace('\'', '&#39;', $val);
            } else 
            {
                if (is_array($val)) 
                {
                    $val = implode(' ', $val);
                }
                
                $val = $this->getView()->escape($val);
            }

            if ('id' == $key) 
            {
                $val = $this->_normalizeId($val);
            }

            if (strpos($val, '"') !== false) 
            {
                $xhtml .= " $key='$val'";
            } else 
            {
                $xhtml .= " $key=\"$val\"";
            }
        }
        
        return $xhtml;
    }

    /**
     * Normalize an ID
     *
     * @param  string $value
     * @return string
     */
    protected function _normalizeId($value)
    {
        if (strstr($value, '[')) 
        {
            if ('[]' == substr($value, -2)) 
            {
                $value = substr($value, 0, strlen($value) - 2);
            }
            $value = trim($value, ']');
            $value = str_replace('][', '-', $value);
            $value = str_replace('[', '-', $value);
        }
        
        return $value;
    }

    /**
     * Filter a name to only allow valid variable characters
     *
     * @param string $value            
     * @return string
     */
    protected function _filter($value)
    {
        return preg_replace('/[^a-zA-Z0-9_\x7f-\xff]/', '', (string) $value);
    }

    /**
     * String representation of form element
     *
     * Proxies to {@link render()}.
     *
     * @return string
     */
    public function __toString()
    {
        try 
        {
            return (string) $this->render();
        } catch (Exception $e) 
        {
            trigger_error($e->getMessage(), E_USER_WARNING);
            return '';
        }
    }

    /**
     * Render form element
     *
     * @return string
     */
    abstract public function render();
}