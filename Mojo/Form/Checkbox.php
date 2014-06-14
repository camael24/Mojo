<?php
namespace Mojo\Form {
    class Checkbox extends Select
    {
        protected $_name = 'input';
        protected $_attributes = ['type' => 'checkbox'];

        public function option($value , $label , $name)
        {

            $this->_options[] = [$value , $label ,$name];

            return $this;
        }

    }
}
