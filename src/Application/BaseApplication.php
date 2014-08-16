<?php

namespace AndyTruong\Salem\Application;

use AndyTruong\Common\NullObject;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class BaseApplication
{

    use \AndyTruong\Salem\Application\ConfigAwareApplication,
        \Psr\Log\LoggerAwareTrait;

    /**
     * Get logger.
     *
     * @param bool $get_default
     * @return LoggerInterface
     */
    public function getLogger($get_default = true)
    {
        if (null === $this->logger) {
            if (!$get_default) {
                // Avoid fatal error
                return new NullObject();
            }
            $this->setLogger($this->generateDefaultLogger());
        }
        return $this->logger;
    }

    /**
     * Generate default logger.
     *
     * @return LoggerInterface
     */
    public function generateDefaultLogger()
    {
        return $this->getObject('logger', new NullLogger());
    }

    /**
     * Get object with config aware.
     *
     * @param string $name
     * @return mixed
     */
    public function getObject($name, $default = null)
    {
        $this->getLogger(false)->debug("Get object {$name}");

        $config = $this->variableGet($name);
        if (is_callable($config)) {
            return call_user_func($config, $this);
        }

        if (null !== $default) {
            return $default;
        }
    }

}
