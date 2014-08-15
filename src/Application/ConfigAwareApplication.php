<?php

namespace AndyTruong\Salem\Application;

trait ConfigAwareApplication
{

    /**
     * Application variable.
     *
     * @var array
     */
    protected $variables = [];

    /**
     * Variable getter.
     *
     * @param string $name
     */
    public function variableGet($name)
    {
        return isset($this->variables[$name]) ? $this->variables[$name] : null;
    }

    /**
     * Variable setter.
     *
     * @param name $name
     * @param mixed $value
     */
    public function variableSet($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     *
     * @param array $variables
     */
    public function variablesSet(array $variables)
    {
        $this->variables = array_merge($variables, $this->variables);
    }

    /**
     * Get all appliation's variables.
     *
     * @return array
     */
    public function variablesGet()
    {
        return $this->variables;
    }

}
