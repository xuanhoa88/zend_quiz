<?php

abstract class Lumia_Controller_Plugin_Module_Asset extends Zend_Controller_Plugin_Abstract
{
    /**
     * Find all elements have index is numeric
     *
     * @param array $assets            
     * @return array
     */
    protected function _findAssociative(array &$response, array $assets)
    {
        foreach ($assets as $key => $asset) 
        {
            array_push($response, $asset);
        }
    }
}
