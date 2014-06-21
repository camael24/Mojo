<?php
namespace Mojo\Form\Validate {

    class Check
    {
        private $_isValid = null;
        private $_id = null;

        public function __construct($id)
        {
            $this->_id = $id;
        }

        public function isValid(Array $data = array(), $revalidate = false)
        {
            if ($revalidate === true or $this->_isValid === null) {
                $this->_isValid = $this->validate($data);
            }

            return $this->_isValid;
        }

        protected function validate(Array $data = array())
        {
            $form  = \Mojo\Form\Form::get($this->_id);
            $valid = true;

            if (empty($data)) {
                $data = $form->getData();
            }

            foreach ($form->getChilds() as $child) {
                $name  = $child->getAttribute('name');
                $iData = (array_key_exists($name, $data)) ? $data[$name] : null;

                foreach ($child->getNeed() as $val) {
                    if ($this->valid($val, $child, $iData, $form) === false) {
                        $valid = false;
                    }
                }
            }

            return $valid;
        }

        private function valid($validator, $item, $data, $form)
        {
            $validator   = explode(':', $validator);
            $val  		 = array_shift($validator);
            $instance 	 = dnew('\\Mojo\\Form\\Validate\\'.ucfirst($val));

            return $instance->valid($data, $validator, $item, $form);
        }
    }
}
