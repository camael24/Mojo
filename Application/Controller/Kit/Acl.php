<?php
namespace Application\Controller\Kit {

    class Acl extends \Sohoa\Framework\Kit\Kitable
    {
        public function need($perm)
        {
            $user = new \Hoa\Session\Session('user');
            $name = $user['login'];
            $acl  = \Hoa\Acl\Acl::getInstance();

            if ($name !== null) {
                return $acl->isAllowed($name, $perm);
            }

            return false;
        }
    }
}
