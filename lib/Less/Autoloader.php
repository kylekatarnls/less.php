<?php

/**
 * Autoloader.
 */
class Less_Autoloader
{
    /**
     * Registered flag.
     *
     * @var bool
     */
    protected static $registered = false;

    /**
     * Library directory.
     *
     * @var string
     */
    protected static $libDir;

    /**
     * Register the autoloader in the spl autoloader.
     *
     * @throws Exception If there was an error in registration
     *
     * @return void
     */
    public static function register()
    {
        if (self::$registered) {
            return;
        }

        self::$libDir = dirname(__FILE__);

        if (false === spl_autoload_register(array('Less_Autoloader', 'loadClass'))) {
            throw new Exception('Unable to register Less_Autoloader::loadClass as an autoloading method.');
        }

        self::$registered = true;
    }

    /**
     * Unregisters the autoloader.
     *
     * @return void
     */
    public static function unregister()
    {
        spl_autoload_unregister(array('Less_Autoloader', 'loadClass'));
        self::$registered = false;
    }

    /**
     * Loads the class.
     *
     * @param string $className The class to load
     */
    public static function loadClass($className)
    {

        // handle only package classes
        if (strpos($className, 'Less_') !== 0) {
            return;
        }

        $className = substr($className, 5);
        $fileName = self::$libDir . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        if (file_exists($fileName)) {
            require $fileName;

            return true;
        } else {
            throw new Exception('file not loadable ' . $fileName);
        }
    }
}
