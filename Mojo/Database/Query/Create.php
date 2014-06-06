<?php

namespace Mojo\Database\Query {
    class Create
    {
            private $_temporary = false;
            private $_name = '';
            private $_ifNotExists = false;
            private $_createDefinition = array();
            private $_tableOptions =  array();
            private $_selectStatement = '';

            public function isTemporary()
            {
                $this->_temporary = true;

                return $this;
            }

            public function ifNotExists()
            {
                $this->_ifNotExists = true;

                return $this;
            }

            public function name($name)
            {
                $this->_name = $name;

                return $this;
            }
            public function col($name , $type , $option = array())
            {
                $this->_createDefinition['columns'][] = array(
                        'name' => $name,
                        'type' => $type,
                        'options' => implode(' ', $option)
                    );

                return $this;
            }
            public function definition($args)
            {
                $this->_createDefinition['definition'][] = implode(' ' , $args);

                return $this;
            }

            public function primary(Array $column , $type = null , $symbol = null)
            {
                $out = [];
                if($symbol !== null)
                    $out [] = 'CONSTRAINT '.$symbol;

                $out[] = 'PRIMARY KEY';

                if($type !== null)
                    $out .= $type;

                $out[] ='('.implode(',' , $column).')';

                $this->definition($out);
            }

public function unique() {}
            public function option($name , $value)
            {
                $this->_tableOptions[$name] = $value;

                return $this;
            }

            public function statement($string)
            {
                $this->_selectStatement = $string;

                return $this;
            }

            protected function renderTemporary()
            {
                if($this->_temporary === true)

                    return  'TEMPORARY';
            }

            protected function renderIfNotExists()
            {
                if($this->_ifNotExists === true)

                    return 'IF NOT EXISTS';
            }

            protected function renderName()
            {
                return $this->_name;
            }

            protected function renderColumn()
            {
                if(!array_key_exists('columns',$this->_createDefinition))

                    return '';

                $col = array();

                if(array_key_exists('columns', $this->_createDefinition))
                    foreach ($this->_createDefinition['columns'] as $column) {
                        if($column['options'] !== '')
                            $col[]= '`'.$column['name'].'` '.$column['type'].' '. $column['options'];
                        else
                            $col[] ='`'.$column['name'].'` '.$column['type'];
                }

                if(array_key_exists('definition', $this->_createDefinition))
                    foreach ($this->_createDefinition['definition'] as $value)
                        $col[] =$value;

                return implode(",\n" , $col)."\n";
            }

            protected function renderTableOption()
            {
            }

            protected function renderStatement()
            {
            }

            public function sql()
            {
                $out = array('CREATE');
                $out[] = $this->renderTemporary();
                $out[] = 'TABLE';
                $out[] = $this->renderIfNotExists();
                $out[] = $this->renderName();
                 if (!empty($this->_createDefinition)) {
                        $out[] = '('."\n";
                        $out[] = $this->renderColumn();
                        $out[] = ')';
                }
                //$out[] = $this->renderTableOption();
                //$out[] = $this->renderStatement();
            return str_replace(['  ' , "\n "], [' ' , "\n"],  implode(' ' , $out)).';';
            }

            public function __toString()
            {
                return $this->sql();
            }

    }
}
