<?php

namespace Silver\Ghost\Core;

use Silver\Ghost\Core\Gcsg\ComponentsLoaderInterface;

class ComponentsLoader implements ComponentsLoaderInterface
{
    public function __call($method, $params)
    {
        $component = 'Silver\Ghost\Components\\' . ucfirst($method);

        return (new $component)->compile($params);
    }
}