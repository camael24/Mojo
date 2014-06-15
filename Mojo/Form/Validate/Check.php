<?php
namespace Mojo\Form\Validate {

    class Check
    {

        protected $_validate = array();
        protected $_checked  = true;
        protected $_errors   = array();
        protected $_childs   = array();

        public function __construct($item)
        {
            $this->_validate = $item->getValidate();

            foreach ($item->getChilds() as $child) {
                if (is_object($child) && ($name = $child->getAttribute('name'))!== null) {
                    $data 	  = $item->getData($name);
                    $validate = $child->getValidate();
                    if ($this->check($name, $data, $validate, $child) === false) {
                        $this->_checked = false;
                    }
                }
            }
        }

        protected function check($name, $data, $validate, $parent)
        {
            $bool = true;
            foreach ($validate as $el) {
                $el   = explode(':', $el);
                $val  = array_shift($el);
                $instance = dnew('\\Mojo\\Form\\Validate\\'.ucfirst($val));
                $bool = $instance->valid($data, $el, $parent);
                if ($bool === false) {
                    $this->_errors[$name][] = $instance->getErrors();
                }
            }

            return $bool;
        }

        public function isValid()
        {
            return $this->_checked;

        }

        public function getErrors()
        {
            return $this->_errors;
        }
    }
}
