<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Main extends Kit
    {

        public function indexAction()
        {
            $form = \Mojo\Form\Form::get('foo');
            $form->setData([
              'foo' => 'bas',
              'bar' => 'll555',
              'quz' => 'worl',
              'o1'  => 'hello',
              'o2'  => 'world',
              'fibox' => 'hello'
            ]);

            // $form->valid();

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
