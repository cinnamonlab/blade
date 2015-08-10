<?php

namespace Framework\Blade;

use Framework\Exception\FrameworkException;
use Framework\Response;
use Exception;
use Framework\Config;

class View extends Response
{
    private $path;
    private $data = array();

    function __construct( $template ) {
        $this->path = Config::get('blade.template')
            . "/" . preg_replace("/\./", "/", $template) . ".php";

        parent::__construct();
    }

    function display( ) {

        $this->setCode(200)
            ->setContentType('text/html')
            ->setContent( $this->get() );
        parent::display();

    }

    function with( $param1, $param2 = null ) {
        if ( is_string($param1) ) {
            $this->data[$param1] = $param2;
        } else if ( is_array($param1) ) {
            foreach( $param1 as $key => $value ) {
                $this->data[$key] = $value;
            }
        }

        return $this;
    }

    static function make( $templates ) {
        return new View( $templates );
    }

    public function path() {

        $compiled = Blade::compiled($this->path);
        if ( ! file_exists($compiled)
            || filemtime($this->path) > filemtime($compiled) ) {
            file_put_contents($compiled, Blade::compile($this) );
        }

        return $compiled;
    }

    public function originalPath() {
        return $this->path;
    }

    /**
     * Get the final output by String
     * @return string
     * @throws Exception
     */

    public function get()
    {
        $__data = $this->data;

        ob_start() and extract($__data, EXTR_SKIP);

        try  {
            include $this->path();
        } catch (Exception $e) {
            ob_get_clean();
            throw FrameworkException::internalError($e->getMessage());
        }
        $content = ob_get_clean();

        return trim($content);
    }

    public function render() {
        return $this->get();
    }

}