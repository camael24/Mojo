<?php
namespace Mojo\Form\Validate {

    class Required extends Validate
    {
        protected $_detail = 'This field is required';
        protected function _valid($data, $argument)
        {
            return !empty($data);
        }
    }
}
