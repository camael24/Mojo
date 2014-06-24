<?php
namespace Mojo\Form\Validate {

    class Praspel extends Validate
    {
        protected $_detail = 'The given value is too long, need = %s char';
        protected $length  = 0;
        protected $max     = 0;
        protected $min     = 0;

        protected function _valid($data, $argument)
        {
            $praspel = array_shift($argument);

        }

        protected function getDetail()
        {
            return sprintf($this->_detail, $this->length);
        }
    }
}
