<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Main extends Kit
    {

        public function indexAction()
        {
            $form = \Mojo\Form\Form::get('foo');
            $form->setData([
              'foo' => 'foo+bb@bar.com',
              'bar' => 'll555',
              'quz' => 'worl',
              'o1'  => 'hello',
              'o2'  => 'world',
              'fibox' => 'hello'
            ]);

            var_dump(\Mojo\Form\Form::isValid('foo'));

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
