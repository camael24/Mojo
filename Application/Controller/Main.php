<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Main extends Kit
    {

        public function indexAction()
        {

            $form = \Mojo\Form\Form::get('foo');
            $form
                ->action('/admin/foo')
                ->method('post')
                ->setTheme(new \Mojo\Form\Theme\Bootstrap());

            $form[] = (new \Mojo\Form\Input())
                        ->id('foo')
                        ->label('Hello World')
                        ->placeholder('hello');
            $form[] = (new \Mojo\Form\Textarea())
                        ->id('bar')
                        ->label('Hello')
                        ->value('foobar');
            $form[] = ['label' => 'Foo' , 'value' => 'Bar'];
            $form[] = (new \Mojo\Form\Select())
                        ->id('quz')
                        ->label('f')
                        ->option('Hello' , 'hello')
                        ->option('World' , 'world');
            $form[] = (new \Mojo\Form\Checkbox())
                        ->label('f')
                        ->option('Hello' , 'hello' , 'o1')
                        ->option('World' , 'world' , 'o2');
            $form[] = (new \Mojo\Form\Radio())
                        ->name('fibox')
                        ->label('f')
                        ->option('Hello' , 'hello')
                        ->option('World' , 'world');

            $form[] = (new \Mojo\Form\Submit())
                        ->value('Submit');

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
