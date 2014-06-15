<?php
namespace Mojo {

    class Mojo extends \Sohoa\Framework\Framework
    {
            private $_debugbar = null;
            private $_acl = null;

           public function __construct()
           {
                parent::__construct();

                $this->_debugbar = new \Mojo\Debug\Bar();
                $this->_debugbar->setFramework($this);
                $this->kit('redirect' , new \Sohoa\Framework\Kit\Redirector());

                $this->loadAcl();
                $this->loadForm();

           }

            public function getDebugBar()
            {
                return $this->_debugbar;
            }

            public function loadAcl()
            {
                if(file_exists('hoa://Application/Config/Acl.php')){
                    require 'hoa://Application/Config/Acl.php';
                    $this->_acl = \Hoa\Acl\Acl::getInstance();
                }
            }

            public function getAcl()
            {
                return $this->_acl;
            }

            public function loadForm()
            {
                if(file_exists('hoa://Application/Config/Form.php'))
                    require 'hoa://Application/Config/Form.php';
            }

    }
}
