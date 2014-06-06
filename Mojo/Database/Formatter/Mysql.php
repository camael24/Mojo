<?php

namespace Mojo\Database\Formatter {
    class Mysql extends Formatter
    {
            protected $_scope = array(
                    '__default' => array(
                            'type' => 'VARCHAR(255)'
                    ),
                    'id' => array(
                            'primary' => 'true',
                            'type' => 'INTEGER',
                            'non-null' => 'NOT NULL',
                            'ai' => 'AUTO_INCREMENT'
                        )
                );

            protected function _sql($table)
            {
                $name = $table->getName();
                $col = $table->getData();
                $prim = $table->getPrimaryKeys();
                $unique = $table->getUniqueKeys();
                $query = new \Mojo\Database\Query\Create();
                $query
                    ->name($name);
                foreach ($col as $col_name => $opt) {
                        if (array_key_exists('type',$opt)) {
                            $type = $opt['type'];
                            unset($opt['type']);
                        } else {
                            $type = 'VARCHAR(255)';
                        }
                        $query->col($col_name , $type , $opt);
                }
                if(!empty($prim))
                    $query->primary($prim);
                //if(!empty($unique))
                    //$query->definition('UNIQUE KEY' , $unique);
                return $query->sql()."\n";
            }

    }
}
