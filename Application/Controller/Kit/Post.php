<?php
namespace Application\Controller\Kit {
    class Post extends \Sohoa\Framework\Kit\Kitable implements \ArrayAccess
    {
            private $_data = array();

            public function construct()
            {
                $this->_data = $_POST;
                $this->view->getData()->post = $this;
            }

        public function offsetSet($offset, $value)
        {
            $this->_data[$offset] = $value;
        }
        public function offsetExists($offset)
        {
            return true;
        }
        public function offsetUnset($offset)
        {
        }
        public function offsetGet($offset)
        {
            if(array_key_exists($offset, $this->_data))

                return $this->_data[$offset];

            return null;
        }

        public function check(Array $array)
        {
            $status  = true;
            foreach ($array as $key)
                if(!array_key_exists($key, $this->_data) or $this->_data[$key] === null)
                    $status = false;

            return $status;
        }

        public function all()
        {
            return $this->_data;
        }

    }
}
