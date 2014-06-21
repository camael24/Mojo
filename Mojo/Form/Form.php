<?php
namespace Mojo\Form {

    class Form extends Element
    {
        protected static $_instance = array();
        protected $_name = 'form';
        protected $_formid = null;
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
            $this->_formid = $name;
        }

        public function getFormId()
        {
            return $this->_formid;
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

        public function setData($data = null)
        {
            if (!empty($data) and is_array($data)) {
                $this->_data = $data;
            }

            return $this;
        }

        public function setTheme($object)
        {
            $this->_theme = $object;
            $this->_theme->setForm($this);
        }

        public function getTheme()
        {
            $this->_theme;
        }

        public function render()
        {
            if ($this->_theme !== null) {
                return $this->_theme->form($this);
            }

            return null;
        }
    }
}
