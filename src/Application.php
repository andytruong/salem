<?php

namespace AndyTruong\Salem;

class Application
{

    use \AndyTruong\Salem\Application\ORMAwareApplication,
        \AndyTruong\Salem\Application\RouteAwareApplication,
        \AndyTruong\Salem\Application\ConfigAwareApplication;
}
