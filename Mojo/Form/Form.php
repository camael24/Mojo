<?php
namespace Mojo\Form {

    class Form extends Element
    {
        protected static $_instance = array();
        protected $_name = 'form';
        protected $_theme = null;
        protected $_data = array();

        public static function get($name)
        {
            if ($name === null or $name === '') {
                throw new Exception("You must get an name for the form", 0);
            }

            if (!array_key_exists($name, static::$_instance)) {
                static::$_instance[$name] = new static($name);
            }

            return static::$_instance[$name];
        }

        private function __construct($name)
        {

        }

        public function getData($name = null)
        {
            if ($name === null) {
                return $this->_data;
            }

            if (array_key_exists($name, $this->_data)) {
                return $this->_data[$name];
            }

            return null;
        }

        public function setData(Array $data)
        {
            $this->_data = $data;
        }

        public function setTheme($object)
        {
            $this->_theme = $object;
            $this->_theme->setParent($this);
        }

        public function getTheme()
        {
            $this->_theme;
        }

        public function valid()
        {
            if (empty($this->_data)) {
                $this->_data = $_POST;
            }

            $validate = new \Mojo\Form\Validate\Check($this);

            return $validate->isValid();
        }

        public static function isValid($name)
        {
            return static::get($name)->valid();
        }

        public function render()
        {
            if ($this->_theme !== null) {
                return $this->_theme->form($this, new \Mojo\Form\Validate\Check($this));
            }

            return null;
        }
    }
}
