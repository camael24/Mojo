<?php
namespace Mojo\Form {
    class Radio extends Checkbox
    {
        protected $_attributes = ['type' => 'radio'];

        public function option($value , $label)
        {
            $this->_options[] = [$value , $label];

            return $this;
        }

    }
}
