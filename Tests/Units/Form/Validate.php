<?php
namespace Mojo\Form {

    require __DIR__.'/../Runner.php';
    class Validate
    {
    }
}

namespace Tests\Units\Mojo\Form {

    class Validate extends \mageekguy\atoum
    {
        public function testEmail()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('login')
                ->label('Login')
                ->placeholder('Your Login')
                ->need('email');

            $form->setData([
                'login' => 'hello'
                ]);

            $check = new \Mojo\Form\Validate\Check('foo');

            $this->boolean($check->isValid())
                 ->isFalse();
            $this->boolean($check->isValid(['login' => 'foo@bar.com'], true))
                ->isTrue();
            $this->boolean($check->isValid(['login' => 'foo@barcom'], true))
                ->isFalse();

            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Checkbox())
                ->label('Login')
                ->option('foo', 'bar', 'd')
                ->need('email');

            $check = new \Mojo\Form\Validate\Check('foo');

            $this->exception(function () use ($check) {
                $check->isValid();
            })->message->contains('Email validator');

        }

        public function testRequired()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('foo')
                ->need('required');

            $form[] = (new \Mojo\Form\Input())
                ->id('bar')
                ->need('required');
            $form->setData(['foo' => 'hello']);

            $check = new \Mojo\Form\Validate\Check('foo');

            $this->boolean($check->isValid())
                 ->isFalse();
            $this->boolean($check->isValid(['foo' => 'foo@bar.com', 'bar' => 'd'], true))
                ->isTrue();
            $this->boolean($check->isValid(['login' => 'foo@barcom'], true))
                ->isFalse();
        }

        public function testLength()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('foo')
                ->need('length:5');

            $form->setData(['foo' => 'hello']);

            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['foo' => '1']))->isFalse();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['foo' => '111111']))->isFalse();

            $this->dump('Validate : Left to test the > and < length');
        }

        public function testLengthInRange()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('foo')
                ->need('length:5:7');

            $form->setData(['foo' => 'hello']);
        }

        public function testLengthMinor()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('foo')
                ->need('length::7');

            $form->setData(['foo' => 'hello']);
        }

        public function testLenghtSuperior()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('foo')
                ->need('length:5:');

            $form->setData(['foo' => 'hello']);
        }

        public function testMax()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('foo')
                ->need('max:5:');

            $form->setData(['foo' => '1']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['foo' => 1]))->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['foo' => 5]))->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['foo' => 6]))->isFalse();
        }

        public function testMin()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('foo')
                ->need('min:5:');

            $form->setData(['foo' => '6']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['foo' => 1]))->isFalse();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['foo' => 5]))->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['foo' => 6]))->isTrue();

        }

        public function testRangeSelect()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Select())
                    ->id('quz')
                    ->label('Select :')
                    ->option('', '')
                    ->option('Hello', 'hello')
                    ->option('World', 'world')
                    ->need('range');

            $form->setData(['quz' => 'hello']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['quz' => 'foo']))->isFalse();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['quz' => 'hellow4']))->isFalse();
        }

        public function testRequiredCheckbox()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Checkbox())
                    ->label('Checkboxy')
                    ->option('Hello', 'hello', 'o1')
                    ->option('World', 'world', 'o2')
                    ->need('required');

            $form->setData(['o1' => 'hello']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isTrue();

            $form->setData(['ow' => 'hello']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isFalse();
        }

        public function testRangeCheckbox()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Checkbox())
                    ->label('Checkboxy')
                    ->option('Hello', 'hello', 'o1')
                    ->option('World', 'world', 'o2')
                    ->need('range');

            $form->setData(['o1' => 'hello']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isTrue();

            $form->setData(['ow' => 'hello']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isFalse();

        }

        public function testRangeRadio()
        {

            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Radio())
                        ->name('fibox')
                        ->label('Radio :')
                        ->option('Hello', 'hello')
                        ->option('World', 'world')
                        ->need('range');

            $form->setData(['fibox' => 'hello']);
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid())->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['fibox' => 'world']))->isTrue();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['fibox' => 'worldw']))->isFalse();
            $this->boolean((new \Mojo\Form\Validate\Check('foo'))->isValid(['fiboxx' => 'worldw']))->isFalse();

        }

        public function testRangeException()
        {
            $form   = \Mojo\Form\Form::get('foo');
            $form[] = (new \Mojo\Form\Input())
                ->id('foo')
                ->need('range');

            $form->setData(['foo' => '6']);
            $this->exception(function () use ($form) {

                (new \Mojo\Form\Validate\Check('foo'))->isValid();

            })->message->contains('Range validator');

        }
    }
}
