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
            $aUser = new \Hoa\Acl\User($name, $user['name']);

            $aUser->addGroup($group);
            $acl->addUser($aUser);
        }
    }
}
