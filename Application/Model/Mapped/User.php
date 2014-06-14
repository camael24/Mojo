<?php
namespace Application\Model\Mapped {

    class User extends \Application\Model\Record\User
    {
            /**
            * Call by __construct for hydrate model
            */
            protected $_id = 0;

            protected function map()
            {
                $id         = func_get_arg(0);
                $this->_id  = $id;

                return $this->getById($id); // Special action , in design pattern ACTIVE RECORD define in  \Application\Model\Record\User
            }

            /**
            * Call by an model update like $model['foo'] = 'bar'; available in mode "immediate" , never call in mode "manual"
            */
            protected function unmap($cols , $value)
            {
                echo '<pre>Update cols : '.$cols.' => '.$value.'</pre>';
            }

            /**
            * Call by an manual update like $model->update() available in mode "manual" , never call in mode "immediate"
            */
            protected function _update(Array $data = array())
            {

                $this->set($this->_id , $data);
            }

    }
}
