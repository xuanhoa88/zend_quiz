<?php

class Lumia_DataGrid_Column
{
    
    /**
     * @var Lumia_DataGrid_Header
     */
    protected $_header;
    
    /**
     * @var Lumia_DataGrid_Body
     */
    protected $_body;
    
    /**
     * Constructor
     *
     * @param Lumia_DataGrid_Body $body
     * @param Lumia_DataGrid_Header $header
     */
    public function __construct(Lumia_DataGrid_Body $body, Lumia_DataGrid_Header $header)
    {
        $this->_body = $body;
        $this->_header = $header;
    }
    
    /**
     * Get header
     */
    public function getHeader() 
    {
        return $this->_header;
    }
    
    /**
     * Get body
     */
    public function getBody() 
    {
        return $this->_body;
    }

    /**
     * Set the View object
     *
     * @param  	Zend_View_Interface $view
     * @return	Lumia_DataGrid_Column_Abstract
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->_body->setView($view);
        $this->_header->setView($view);
        
        return $this;
    }
    
}