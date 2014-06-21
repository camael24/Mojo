<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Main extends Kit
    {

        public function indexAction()
        {
            $this->greut->render();
        }

        public function logoutAction()
        {
            $user = new \Hoa\Session\Session('user');
            $user->destroy();
            $this->redirect->redirect('indexAdmin');
        }
    }

}
