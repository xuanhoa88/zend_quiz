<?php
return array(
    'production' => array(
        // +------------------+
        // | PHP ini settings |
        // +------------------+
        'phpSettings' => array(
            'display_startup_errors' => 0,
            'display_errors' => 0,
            'date.timezone' => 'Asia/Ho_Chi_Minh'
        ),
        // ; +-----------------------------+
        // ; | Include path |
        // ; +-----------------------------+
        'includePaths' => array(
            APPLICATION_PATH . '/../library'
        ),
        // ; +--------------------- +
        // ; | Autoloader namespace |
        // ; +----------------------+
        'autoloaderNamespaces' => array(
            'Lumia_'
        ),
        // ; +-----------+
        // ; | Bootstrap |
        // ; +-----------+
        'bootstrap' => array(
            'path' => APPLICATION_PATH . '/Bootstrap.php',
            'class' => 'Bootstrap'
        ),
        // ; +-----------+
        // ; | Resources |
        // ; +-----------+
        'pluginPaths' => array(
            'Lumia_Application_Resource_' => APPLICATION_PATH . '/../library/Lumia/Application/Resource'
        ),
        'resources' => array(
            // ;+-----------------+
            // ;| FrontController |
            // ;+-----------------+
            'frontController' => array(
                'controllerDirectory' => APPLICATION_PATH . '/controllers',
                'moduleDirectory' => APPLICATION_PATH . '/modules',
                'defaultControllername' => 'index',
                'defaultAction' => 'index',
                'defaultModule' => 'default',
                'pluginDirectory' => APPLICATION_PATH . '/plugins',
                'returnresponse' => false,
                'throwexceptions' => true,
                'noErrorHandler' => false,
                'noViewRenderer' => false,
                'useDefaultControllerAlways' => false,
                'disableOutputBuffering' => false,
                'prefixDefaultModule' => true,
                'params' => array(
                    'displayExceptions' => false
                )
            ),
            // ; +---------+
            // ; | Modules |
            // ; +---------+
            'modules' => true,
            // ; +--------+
            // ; | Layout |
            // ; +--------+
            'layout' => true,
            // ; +------+
            // ; | View |
            // ; +------+
            'view' => array(
                'view' => 'XHTML1_STRICT',
                'encoding' => 'UTF-8',
                'charset' => 'UTF-8',
                'contentType' => 'text/html; charset=UTF-8'
            ),
            // ; +---------+
            // ; | Session |
            // ; +---------+
            'session' => array(
                'save_path' => APPLICATION_PATH . '/../public/uploads/session',
                'use_only_cookies' => true,
                'remember_me_seconds' => 864000,
                'gc_maxlifetime' => 864000,
                'saveHandler' => array(
                    'class' => 'Zend_Session_SaveHandler_DbTable',
                    'options' => array(
                        'name' => 'core_session',
                        'primary' => 'session_id',
                        'modifiedColumn' => 'session_modified',
                        'dataColumn' => 'session_data',
                        'lifetimeColumn' => 'session_lifetime'
                    )
                )
            ),
            // ; +----+
            // ; | Db |
            // ; +----+
            'db' => array(
                'adapter' => 'PDO_MYSQL',
                'isDefaultTableAdapter' => true,
                'params' => array(
                    'host' => 'localhost',
                    'port' => 3306,
                    'username' => 'root',
                    'password' => '',
                    'dbname' => 'zend_quiz',
                    'charset' => 'UTF8',
                    'persistent' => false,
                    'autoQuoteIdentifiers' => true
                )
            ),
            // ; +----------------------+
            // ; | JQUERY VALIDATE FORM |
            // ; +----------------------+
            'Jqueryvalidateform' => array(
                'enable' => true,
                'showWarnings' => false
            )
        ),
        // ; +--------+
        // ; | Assets |
        // ; +--------+
        'assets' => array(
            // ; +------------+
            // ; | Javascript |
            // ; +------------+
            'javascript' => array(
                '__construct' => array(
                    array(
                        'conditional' => 'lt IE 9',
                        'src' => '/static/js/html5shiv.min.js'
                    ),
                    array(
                        'conditional' => 'lt IE 9',
                        'src' => '/static/js/respond.min.js'
                    ),
                    '/static/jquery/jquery-1.11.1.min.js',
                    '/static/bootstrap/js/bootstrap.min.js',
                    '/static/jquery-validation/jquery.validate.min.js',
                    '/static/jquery-validation/additional-methods.min.js',
                    '/static/jquery-validation/jquery.validate.bootstrap.js',
                    '/static/bootstrap-spinner/dist/spin.min.js',
                    '/static/bootstrap-spinner/dist/ladda.min.js',
                    '/static/bootstrap-dialog/js/bootstrap-dialog.min.js',
                    '/static/bootstrap-notify/bootstrap-notify.min.js',
                    '/static/lumia/ajax.js',
                    '/static/lumia/datatable.js',
                    '/static/lumia/printing.js'
                )
            ),
            // ; +------------+
            // ; | Stylesheet |
            // ; +------------+
            'stylesheet' => array(
                '__construct' => array(
                    '/static/bootstrap/css/bootstrap.min.css',
                    '/static/font-awesome/css/font-awesome.min.css',
                    '/static/bootstrap-spinner/dist/ladda-themeless.min.css',
                    '/static/bootstrap-dialog/css/bootstrap-dialog.min.css'
                )
            )
        )
    ),
    'development' => array(
        '_extends' => 'production',
        // +------------------+
        // | PHP ini settings |
        // +------------------+
        'phpSettings' => array(
            'display_startup_errors' => 1,
            'display_errors' => 1
        )
    )
);
