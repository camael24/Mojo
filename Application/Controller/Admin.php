<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Admin extends Kit
    {

        public function construct()
        {
            $this->framework->getDebugBar()->sql(\Application\Model\Mapped\User::getSqlLog());

            $user = new \Hoa\Session\Session('user');
            if($user['logged'] === true)
                $this->data->isLogged = true;
            else
                $this->data->isLogged = false;
        }

        public function indexAction()
        {

            //$this->flash->alert('foo' , 'bar');

            $this->greut->render();

        }

        public function createAction()
        {
            if ($this->post->check(['login' , 'password']) !== true) {

            }

            var_dump('foo bar');

            $this->greut->render();
        }

        public function userAction()
        {
            $this->greut->render(['Admin' , 'Index']);
        }

    }
}
