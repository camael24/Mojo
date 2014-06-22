<?php
namespace Mojo\Form\Validate {

    class Length extends Validate
    {
        protected $_detail = 'The given value is too long, need = %s char';
        protected $length  = 0;
        protected $max     = 0;
        protected $min     = 0;

        protected function _valid($data, $argument)
        {

            if (in_array('getOptions', get_class_methods($this->_parent))) {
                throw new Exception("You cant set Length validator on item %s", 0, array(get_class($this->_parent)));
            }

            if (count($argument) == 1) {
                $this->length = array_shift($argument);

                return (strlen($data) == intval($this->length));

            } else {
                $this->min    = array_shift($argument);
                $this->max    = array_shift($argument);

                if ($this->min === '' && $this->max === '') {
                    throw new Exception("Error syntax min and max value are empty", 1);
                }

                if ($this->min === '') {
                    return (strlen($data) <= $this->max);
                }

                if ($this->max === '') {
                    return (strlen($data) >= $this->min);
                }

                return (strlen($data) >= $this->min && strlen($data) <= $this->max);
            }

        }

        protected function getDetail()
        {
            return sprintf($this->_detail, $this->length);
        }
    }
}
