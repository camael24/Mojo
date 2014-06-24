<?php
namespace Mojo\Form\Validate {

    class Check
    {
        private $_isValid = null;
        private $_id = null;
        private $_errors = array();

        public function __construct($id)
        {
            $this->_id = $id;
        }

        public function isValid(Array $data = array())
        {
                $this->_errors  = array();

                return $this->validate($data);
        }

        protected function validate(Array $data = array())
        {
            $form  = \Mojo\Form\Form::get($this->_id);
            $valid = true;

            if (empty($data)) {
                $data = $form->getData();
            }

            foreach ($form->getChilds() as $child) {
                if (is_object($child)) {
                    $name  = $child->getAttribute('name');
                    $iData = (array_key_exists($name, $data)) ? $data[$name] : null;

                    foreach ($child->getNeed() as $val) {
                        if ($this->valid($val, $child, $iData, $form) === false) {
                            $valid = false;
                        }
                    }
                }
            }

            return $valid;
        }

        private function valid($validator, $item, $data, $form)
        {
            $validator              = explode(':', $validator);
            $val  		            = array_shift($validator);
            $instance 	            = dnew('\\Mojo\\Form\\Validate\\'.ucfirst($val));
            $bool                   = $instance->valid($data, $validator, $item, $form);
            $name                   = $item->getAttribute('name');
            $this->_errors[$name][] = $instance->getErrors();

            return $bool;
        }

        public function getErrors()
        {
            return $this->_errors;
        }

        public function setErrors(Array $error)
        {
            $this->_errors = $error;
        }
    }
}
