<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class User extends Kit
    {

        public function construct()
        {
            $this->framework->getDebugBar()->sql(\Application\Model\Mapped\User::getSqlLog());
        }

        public function indexAction()
        {
                //Get self profile !!
        }

        public function NewAction()
        {
                $this->greut->render();
        }

        public function CreateAction()
        {
            $s = new \Hoa\Session\Session('form');

            if ($this->post->check(['login' , 'password' , 'rpassword' , 'email' , 'identifiant' ]) === false) {
                $session = new \Hoa\Session\Session('form');
                $session['field'] = $this->post->all();
                $this->redirect->redirect('newUser');
            }

            $s->forgetMe();

        }
    }
}
