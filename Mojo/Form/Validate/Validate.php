<?php
namespace Mojo\Form\Validate {

    class Validate
    {
        protected $_detail = '';
        protected $_parent = null;
        protected $_errors = array();

        public function valid($data, $el, $parent)
        {
            $this->_parent = $parent;
            $bool = $this->_valid($data, $el);
            if ($bool === false) {
                $this->_errors = $this->getDetail();
            }

            return $bool;
        }

        public function getErrors()
        {
            return $this->_errors;
        }

        protected function getDetail()
        {
            return $this->_detail;
        }
    }
}
