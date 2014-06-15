<?php
namespace Mojo\Form\Validate {

    class Range extends Validate
    {
        protected $_detail = 'This field are not in authorized option';

        protected function _valid($data, $argument)
        {
            if (in_array('getOptions', get_class_methods($this->_parent))) {
                $options = $this->_parent->getOptions();
                $opt     = array();
                foreach ($options as $value) {
                    if (array_key_exists(1, $value)) {
                        $opt[] = $value[1];
                    } else {
                        $opt[] = $value[0];
                    }
                }

                return in_array($data, $opt);
            }

            throw new Exception("You cant set Range validator on item %s", 0, array(get_class($this->_parent)));
        }
    }
}
