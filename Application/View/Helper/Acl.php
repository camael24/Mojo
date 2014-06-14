<?php

/**
 * Description of Dummy
 *
 * @author Guile
 */

namespace Application\View\Helper {

    use Sohoa\Framework\View;
    use Hoa\Console\Chrome\Text;

    class Acl extends View\Helper
    {
        public function need($perm)
        {
            $user = new \Hoa\Session\Session('user');
            $name = $user['login'];
            $acl  = \Hoa\Acl\Acl::getInstance();

            if($name !== null)

                return $acl->isAllowed($name , $perm);

            return false;
        }
    }
}
