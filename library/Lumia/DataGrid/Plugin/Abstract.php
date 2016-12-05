<?php

/**
 * Plugin Abstract
 */

abstract class Lumia_DataGrid_Plugin_Abstract
{
    /**
     * Grid Instance
     * 
     * @var Lumia_DataGrid
     */
    protected $_grid;
    
    /**
     * Grid Data Instance
     * 
     * @var object
     */
    protected $_gridData;
    
    /**
     * View Instance
     * 
     * @var Zend_View
     */
    protected $_view;

    /**
     * Set View Instance
     * 
     * @param 	Zend_View_Abstract $view
     * @return 	Lumia_DataGrid_Plugin_Abstract
     */
    public function setView(Zend_View_Abstract $view)
    {
        $this->_view = $view;
        
        return $this;
    }

    /**
     * Set Grid Instance 
     * 
     * @param 	$grid Lumia_DataGrid_Abstract
     * @return 	Lumia_DataGrid_Plugin_Abstract
     */
    public function setGrid(Lumia_DataGrid_Abstract $grid)
    {
        $this->_grid = $grid;
        
        return $this;
    }

    /**
     * Get Grid Instance
     *
     * @return Lumia_DataGrid_Abstract
     */
    public function getGrid()
    {
        return $this->_grid;
    }

    /**
     * Set an instance of the grid data structure
     *
     * @param object $data
     * @return void
     */
    public function setGridData($data)
    {
        $this->_gridData = $data;
    }

    /**
     * Get an instance of the grid data structure
     * 
     * @return object
     */
    public function getGridData()
    {
        return $this->_gridData;
    }

    /**
     * Add HTML to plugin
     *
     * @param $html HTML string
     */
    public function addHtml($html)
    {
        $this->_view->dataGridPluginBroker['html'][] = $html;
    }

    /**
     * Add javascript to plugin for onload
     *
     * @param $js javascript string
     */
    public function addOnLoad($js)
    {
        $this->_view->dataGridPluginBroker['onload'][] = $js;
    }

    /**
     * Add javascript to plugin
     *
     * @param $js javascript string
     */
    public function addJavascript($js, $onload = false)
    {
        if ($onload == true) 
        {
            return $this->addOnLoad($js);
        }
        
        $this->_view->dataGridPluginBroker['js'][] = $js;
    }

    abstract public function preResponse();
    abstract public function postResponse();
    abstract public function preRender();
    abstract public function postRender();
}