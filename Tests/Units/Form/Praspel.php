<?php
namespace Mojo\Form {

    require __DIR__.'/../Runner.php';
    class Praspel
    {
    }
}

namespace Tests\Units\Mojo\Form {

    class Praspel extends \mageekguy\atoum
    {
        public function testInput()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                        ->id('login')
                        ->label('Login')
                        ->placeholder('Your Login')
                        ->praspel('');

            $form->setData(['login' => 'Foobar']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isTrue();

        }
    }
}
