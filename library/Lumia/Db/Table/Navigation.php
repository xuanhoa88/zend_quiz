<?php

class Lumia_Db_Table_Navigation extends Lumia_NestedSet
{

    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'navigation_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_navigation';
    
    /**
     * This represent the default table structure
     * 
     * @var array
     */
    protected $_structures = array(
    		'name'  => 'navigation_name',
    		'left'  => 'navigation_left',
    		'right' => 'navigation_right',
    		'level' => 'navigation_level'
    );
}
