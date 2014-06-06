<?php
namespace Mojo\Database\Formatter {
    abstract class Formatter
    {
            protected $_scope = array();
            protected $_interprete = null;
            public function __construct(\Mojo\Database\Interpreter\Iface $interprete)
            {
                $this->_interprete = $interprete;
                $this->loadSpecificScope();
            }

            protected  function loadSpecificScope()
            {
                if(!empty($this->_scope))
                    foreach ($this->_scope as $id => $value)
                        $this->_interprete->addScope($id , $value);
            }

            public function sql()
            {
                $data = $this->_interprete->interprete();
                $out = '';

                foreach ($data as $table)
                    $out .= $this->_sql($table);

                return  $out;
            }

            protected function _sql($table)
            {
            }
    }
}
