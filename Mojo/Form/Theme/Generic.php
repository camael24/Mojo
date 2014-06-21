<?php
namespace Mojo\Form\Theme {

    class Generic
    {
        protected $_form = null;
        protected $_errors = array();

        public function setForm($form)
        {
            $this->_form = $form;
        }

        public function getForm()
        {
            return $this->_form;
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
