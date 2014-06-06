<?php
namespace Mojo {

    class Mojo extends \Sohoa\Framework\Framework
    {
            private $_debugbar = null;
            public function construct()
            {
                $this->_debugbar = new \Mojo\Debug\Bar();
                $this->_debugbar->setFramework($this);
                $this->kit('redirect' , new \Sohoa\Framework\Kit\Redirector());

            }
/** **/
            public function getDebugBar()
            {
                return $this->_debugbar;
            }

    }
}
