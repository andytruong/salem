<?php

namespace AndyTruong\Salem;

class Application
{

    use \AndyTruong\Salem\Application\ORMAwareApplication,
        \AndyTruong\Salem\Application\RouteAwareApplication,
        \AndyTruong\Salem\Application\ConfigAwareApplication;

    /** @var string Application's running mode. */
    protected $mode = 'production';

    /** @var boolean Debugging. */
    protected $debug = false;

    /** @var string Root directory of application. */
    protected $app_root = './';

    /**
     * Constructor
     *
     * @param string $config_file
     */
    public function __construct($app_root, $config_file = '/config/config.php')
    {
        // App Root
        $this->app_root = rtrim($app_root, '/');

        // App configuration
        $config = require $this->app_root . '/' . ltrim($config_file, '/');
        if (!is_array($config)) {
            throw new \RuntimeException('Configuration must be an array.');
        }

        if (isset($config['mode'])) {
            $this->mode = $config['mode'];
            unset($config['mode']);
        }

        if (isset($config['debug'])) {
            $this->debug = $config['debug'];
            unset($config['debug']);
        }

        // inject variables
        $this->variablesSet($config);
    }

    /**
     * Set app's mode.
     *
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Get app's running mode.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Get root directory of application.
     *
     * @return string
     */
    public function getAppRootDir()
    {
        return $this->app_root;
    }

}
