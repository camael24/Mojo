<?php
namespace Application\Controller\Generic {
     use Sohoa\Framework\Kit;
    class Admin extends Generic
    {
         public function construct()
        {
            parent::construct();
            $this->framework->getDebugBar()->sql(\Application\Model\Mapped\User::getSqlLog());

            $user = new \Hoa\Session\Session('user');

            if ($user['logged'] === true) {
                $this->data->isLogged = true;
                $this->data->id = $user['id'];
                $this->data->name = $user['name'];
            } else
                $this->data->isLogged = false;

        }
    }
}
