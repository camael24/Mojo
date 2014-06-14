<?php
namespace Mojo\Form {
    class Form extends Element
    {
        protected static $_instance = array();
        protected $_name = 'form';
        protected $_theme = null;

        public static function get($name)
        {
            if($name === null or $name === '')
                throw new Exception("You must get an name for the form", 0);

            if(!array_key_exists($name, static::$_instance))
                static::$_instance[$name] = new static($name);

            return static::$_instance[$name];
        }

        private function __construct($name)
        {

        }

        public function setTheme($object)
        {
            $this->_theme = $object;
        }

        public function render()
        {
            if($this->_theme !== null)

                return $this->_theme->form($this);

            return null;
        }
    }
}
