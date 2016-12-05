<?php
/**
 * Plugin Broker
 */

class Lumia_DataGrid_Plugin extends Lumia_DataGrid_Plugin_Abstract
{
    /**
     * Array of instance of objects extending Zend_Controller_Plugin_Abstract
     *
     * @var array
     */
    protected $_plugins = array();

    /**
     * View instance
     * 
     * @var Zend_View_Abstract
     */
    protected $_view;

    /**
     * Set view instance
     * 
     * @param Zend_View $view
     */
    public function setView(Zend_View_Abstract $view)
    {
        $this->_view = $view;
        $this->_view->dataGridPluginBroker = array();
        $this->_view->dataGridPluginBroker['html'] = array();
        $this->_view->dataGridPluginBroker['js'] = array();
        $this->_view->dataGridPluginBroker['onload'] = array();
    }

    /**
     * Register a plugin.
     *
     * @param  Lumia_DataGrid_Plugin_Abstract $plugin
     * @return Lumia_DataGrid_Plugin
     */
    public function registerPlugin(Lumia_DataGrid_Plugin_Abstract $plugin)
    {
        $plugin->setGrid($this->_grid);
        $plugin->setGridData($this->_gridData);
        
        $this->_plugins[] = $plugin;
        
        return $this;
    }

    /**
     * Unregister a plugin.
     *
     * @param  Lumia_DataGrid_Plugin_Abstract $plugin
     * @return Lumia_DataGrid_Plugin
     */
    public function unregisterPlugin($plugin)
    {
        if ($plugin instanceof Lumia_DataGrid_Plugin_Abstract) 
        {
            // Given a plugin object, find it in the array and unset
            foreach ($this->_plugins as $key => $_plugin) 
            {
                if ($plugin === $_plugin) 
                {
                    unset($this->_plugins[$key]);
                }
            }
        } elseif (is_string($plugin)) 
        {
            // Given a plugin class, find all plugins of that class and unset them
            foreach ($this->_plugins as $key => $_plugin) 
            {
                if ($plugin == get_class($_plugin)) 
                {
                    unset($this->_plugins[$key]);
                }
            }
        }
        
        return $this;
    }

    /**
     * Has plugin been registered
     *
     * @param  string $class
     * @return bool
     */
    public function hasPlugin($class)
    {
        foreach ($this->_plugins as $plugin) 
        {
            if ($class == get_class($plugin)) 
            {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Retrieve a plugin or plugins by class
     *
     * @param  string $class Class name of plugin(s)
     * @return false|Lumia_DataGrid_Plugin_Abstract|array Returns false if none found, plugin if only one found, and array of plugins if multiple plugins of same class found
     */
    public function getPlugin($class)
    {
        $found = array();
        foreach ($this->_plugins as $plugin) 
        {
            if ($class == get_class($plugin)) 
            {
                $found[] = $plugin;
            }
        }
        
        switch (count($found)) 
        {
            case 0:
                return false;
            case 1:
                return $found[0];
            default:
                return $found;
        }
    }

    /**
     * Retrieve all plugins
     *
     * @return array
     */
    public function getPlugins()
    {
        return $this->_plugins;
    }

    /**
     * Set Grid
     *
     * @param 	Lumia_DataGrid_Abstract $grid
     * @return 	Lumia_DataGrid_Plugin
     */
    public function setGrid(Lumia_DataGrid_Abstract $grid)
    {
        $this->_grid = $grid;
        
        return $this;
    }

    /**
     * Set Grid Data
     *
     * @param object $data
     * @return void
     */
    public function setGridData($data)
    {
        $this->_gridData = $data;
    }

    /**
     * Called before Lumia_DataGrid_Abstract sends response 
     *
     * @return void
     */
    public function preResponse()
    {
        foreach ($this->_plugins as $plugin) 
        {
            $plugin->setGridData($this->_gridData);
            $plugin->setView($this->_view);
            $plugin->preResponse();
        }
    }

    /**
     * Called after Lumia_DataGrid_Abstract has generated response
     *
     * @return void
     */
    public function postResponse()
    {
        foreach ($this->_plugins as $plugin) 
        {
            $plugin->setGridData($this->_gridData);
            $plugin->setView($this->_view);
            $plugin->postResponse();
        }
    }

    /**
     * Called before Lumia_DataGrid_Abstract renders
     * 
     * This is the only plugin hook, which has no access to the 
     * grid data structure.
     *
     * @return void
     */
    public function preRender()
    {
        foreach ($this->_plugins as $plugin) 
        {
            $plugin->setView($this->_view);
            $plugin->preRender();
        }
    }

    /**
     * Called after Lumia_DataGrid_Abstract renders
     *
     * @return void
     */
    public function postRender()
    {
        foreach ($this->_plugins as $plugin) 
        {
            $plugin->setGridData($this->_gridData);
            $plugin->setView($this->_view);
            $plugin->postRender();
        }
    }
}