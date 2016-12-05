<?php

class Admin_Auth extends Lumia_Auth
{
    /**
     * Singleton instance
     *
     * @var Admin_Auth
     */
    protected static $_instance;

    /**
     * Returns an instance of Admin_Auth
     *
     * Singleton pattern implementation
     *
     * @return Admin_Auth Provides a fluent interface
     */
    public static function getInstance()
    {
        if (null === self::$_instance) 
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
}
