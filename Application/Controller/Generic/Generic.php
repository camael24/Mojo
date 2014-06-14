<?php
namespace Application\Controller\Generic {
     use Sohoa\Framework\Kit;
    class Generic extends Kit
    {
         public function construct()
        {

            parent::construct();

            $user  = new \Hoa\Session\Session('user');
            $acl   = \Hoa\Acl\Acl::getInstance();
            $model = new \Application\Model\Record\User();
            $name  = $user['login'];
            $group = $model->getGroup($name);

            $acl->addUser(new \Hoa\Acl\User($name , $user['name'] , $group));

        }
    }
}
