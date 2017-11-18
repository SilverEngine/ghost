<?php

namespace Silver\Ghost\Core;

use Silver\Ghost\Core\Gcsg\ComponentsLoaderInterface;
use Silver\Ghost\Exception\NotFoundException;

class Template
{

    /**
     * template copmponents such as
     * variable, control structures, loops,
     * @var ComponentsLoaderInterface
     */
    private $_components;

    /**
     * @var string file to be rendered
     */
    private $_file;

    /**
     * prefered extension
     * @var string
     */
    private $_ext = ".ghost";

    /**
     * data to be rendered with the template file
     * @var array
     */
    private $_data = array();


    /**
     * Template constructor.
     * initialise components
     *
     * @param ComponentsLoaderInterface $components
     */
    public function __construct(ComponentsLoaderInterface $components)
    {
        $this->_components = $components;
    }


    /**
     * @param       $file
     * @param array $data
     * @return mixed
     * @throws NotFoundException
     */
    public function render($file, $data)
    {
        if(!file_exists($file . $this->_ext)) throw new NotFoundException("Error File $file " . $this->_ext . " was not found.");
        $this->_file = file_get_contents($file . $this->_ext);
        $this->_data = $data;


        $this->_file  = $this->_components->variables("/\(\(.*\)\)/",$this->_file, "/\(|\)/" , $this->_data);
        $this->_file  = $this->_components->statments($this->_file, $this->_data);

        return $this->_file;
    }
}