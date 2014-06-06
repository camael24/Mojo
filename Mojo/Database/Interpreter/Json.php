<?php
namespace Mojo\Database\Interpreter {
    class Json implements Iface
    {
        protected $_raw = '';
        protected $_table = array();
        protected $_scope = array();

        public function file($filename)
        {
            $this->_raw = file_get_contents($filename);
        }

        public function interprete($string ='')
        {
            if($string  === '')
                $string = $this->_raw;

                $json = json_decode($string , true);

                if(is_array($json))
                    foreach ($json as $name => $option)
                        $this->item($name , $option);

            return $this->_table;
        }

        protected  function item($name , $option)
        {
                if(strpos($name, '_') === 0)
                    $this->addScope(substr($name , 1) , $option);
                else
                    $this->addTable($name, $option);
        }

        public function addTable($name , $option, $parent = null)
        {
                $this->_table[] = new \Mojo\Database\Interpreter\Element\Table($this , $name , $option,$parent);
        }

        public function getScope($name)
        {
            if(array_key_exists($name, $this->_scope))

                return $this->_scope[$name];

            return array();
        }

        public function addScope($name , $option)
        {
            if(!in_array($name , $this->_scope))
                $this->_scope[$name] = $option;
        }
    }
}
