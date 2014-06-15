<?php
namespace Mojo\Form\Theme {

    class Generic
    {
        protected $_parent = null;
        protected $_errors = array();

        public function setParent($parent)
        {
            $this->_parent = $parent;
        }

        public function hasError($name)
        {
            return array_key_exists($name, $this->_errors);
        }

        public function getError($name)
        {
            if ($this->hasError($name) === true) {
                return $this->_errors[$name];
            }

            return null;
        }
    }
}
