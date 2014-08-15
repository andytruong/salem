<?php

namespace AndyTruong\Salem\Application;

use Luracast\Restler\Restler;
use Luracast\Restler\Scope;

trait RouteAwareApplication
{

    /** @var Restler Route */
    private $route;

    /** @var array Default resources. */
    private $route_resources = [
        ['Resources', 'resources', false], // prefix, class, app-awrae
    ];

    /**
     * Setter for route property.
     *
     * @param Restler $route
     */
    public function setRoute(Restler $route)
    {
        $this->route = $route;
    }

    /**
     * Getter for route property.
     *
     * @return Restler
     */
    public function getRoute()
    {
        if (is_null($this->route)) {
            $this->setRoute($this->generateDefaultRoute());

            // Adding default resources
            foreach ($this->route_resources as $route_info) {
                $this->register($route_info[0], $route_info[1], $route_info[2]);
            }
        }
        return $this->route;
    }

    /**
     * Generate default route.
     *
     * @return \Luracast\Restler\Restler
     */
    protected function generateDefaultRoute()
    {
        return new Restler('production' === $this->mode, $this->debug);
    }

    /**
     * Register a new resource with Restler.
     *
     * @param string $class_name
     * @param string $prefix
     * @param bool $app_aware
     */
    public function register($class_name, $prefix = '', $app_aware = true)
    {
        $this->getRoute()->addAPIClass($class_name, $prefix);
        if ($app_aware) {
            $app = $this;
            Scope::register($class_name, function() use ($app, $class_name) {
                return new $class_name($app);
            });
        }
    }

}
