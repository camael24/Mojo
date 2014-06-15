<?php
namespace Mojo\Form\Validate {

    class Length extends Validate
    {
        protected $_detail = 'The given value is too long, need = %s char';
        protected $length = 0;

        protected function _valid($data, $argument)
        {

            if (in_array('getOptions', get_class_methods($this->_parent))) {
                throw new Exception("You cant set Length validator on item %s", 0, array(get_class($this->_parent)));
            }
            $this->length = array_shift($argument);

            return (strlen($data) == intval($this->length));
        }

        protected function getDetail()
        {
            return sprintf($this->_detail, $this->length);
        }
    }
}
