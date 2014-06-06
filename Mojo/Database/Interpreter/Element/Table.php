<?php
namespace Mojo\Database\Interpreter\Element  {
    class Table
    {
        private $_structure = null;
        private $_name = '';
        private $_option = array();
        private $_parent = null;
        private $_data = array();
        private $_primary = array();
        private $_unique = array();

        public function __construct(\Mojo\Database\Interpreter\Iface $structure , $name , $option = array(), $parent = null)
        {
            $this->setStructure($structure);
            $this->setName($name);
            $this->setOption($option);
            $this->setParent($parent);

            $this->process();
        }

        public function setStructure($structure)
        {
            $this->_structure = $structure;
        }

        public function setName($name)
        {
            $this->_name = $name;
        }

        public function setOption(Array $option = array())
        {
            $this->_option = $option;
        }

        public function setParent($parent = null)
        {
            $this->_parent = $parent;
        }

        private function process()
        {
            if ($this->_parent !== null) {
                $chain = explode('_' , $this->_parent);
                $chain[] = $this->_name;
                $chain = implode('_' , $chain);
                $this->setName(strtolower($chain));
            }

            if(empty($this->_option))
                $this->defaultColumn();

            foreach ($this->_option as $name => $option) {
                if(strpos($name, '&') === 0)
                    $this->_structure->addTable(substr($name, 1), $option , $this->_name);
                else
                    $this->_column($name , $option);

            }
        }
        private function defaultColumn()
        {
            $name = explode('_' ,$this->_name);

            $option = array(
                    "id@" => array()
                );
            if(count($name) > 1)
                foreach ($name as $value)
                    $option['ref'.ucfirst($value)] = array();

            $this->setOption($option);
        }
        private function _column($name , $option)
        {
             if (array_key_exists('_scope', $option)) {
                $option = $this->applyScope($option['_scope'] , $option);
                unset($option['_scope']);
            }

            if (strpos($name, '#') === 0) {
                $option =$this->applyScope('id' , $option);
                $name = substr($name , 1);

                if($name === '' or $name === FALSE)
                    $name = 'id@';
            }

            $name = $this->_name($name);
            $option = $this->applyScope('_default' , $option);

            if (array_key_exists('primary', $option) && ($option['primary'] === 'true' or $option['primary'] === true)) {
                $this->_primary[] = $name;
                unset($option['primary']);
            }

            if (array_key_exists('unique', $option) && ($option['unique'] === 'true' or $option['unique'] === true)) {
                $this->_unique[] = $name;
                unset($option['unique']);
            }

            if(!in_array($name, $this->_data))
                $this->_data[$name] = $option;

        }

        private function applyScope($idScope , $option)
        {
            $scope = $this->_structure->getScope($idScope);
            $option = array_merge($scope , $option);

            return $option;
        }

        private function _name($name)
        {
            if($this->_name === null)

                return $name;

            $n = str_replace('_', ' ', $this->_name);
            $n = ucwords($n);
            $n = str_replace(' ', '', $n);

            if(strpos($name, '@') === 0)

                return strtolower($n).ucfirst(substr($name, 1));

            if(strpos($name, '@') === strlen($name) -1)

                return substr($name , 0 , strlen($name) -1).ucfirst($n);

            return str_replace('@', $n, $name);
        }

        public function getData()
        {
            return $this->_data;
        }

        public function getName()
        {
            return $this->_name;
        }

        public function getPrimaryKeys()
        {
            return $this->_primary;
        }

        public function getUniqueKeys()
        {
            return $this->_unique;
        }

    }
}
