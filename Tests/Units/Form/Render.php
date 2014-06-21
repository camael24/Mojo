<?php
namespace Mojo\Form {

    require __DIR__.'/../Runner.php';
    class Render
    {
    }
}

namespace Tests\Units\Mojo\Form {

    class Render extends \mageekguy\atoum
    {
        public function testInput()
        {
            $input = (new \Mojo\Form\Input())
                ->id('login')
                ->label('Login')
                ->placeholder('Your Login');

            $this->string($input->getLabel())->isEqualTo('Login');
            $this->string($input->getId())->isEqualTo('login');
            $this->string($input->getAttribute('name'))->isEqualTo('login');
            $this->string($input->getAttribute('placeholder'))->isEqualTo('Your Login');
        }

        public function testCheckbox()
        {
            $input = (new \Mojo\Form\Checkbox())
                ->label('Checkboxy')
                ->option('Hello', 'hello', 'o1')
                ->option('World', 'world', 'o2');

            $this->string($input->getLabel())->isEqualTo('Checkboxy');
            $this->variable($input->getId())->isNull();
            $this->variable($input->getAttribute('name'))->isNull();
            $this->variable($input->getAttribute('placeholder'))->isNull();
            $this->array($input->getOptions())->hasSize(2);

        }

        public function testForm()
        {
            $form = \Mojo\Form\Form::get('foo'); // Load $_POST information !
            $form
                ->action('/admin/foo')
                ->method('post')
                ->setTheme(new \Mojo\Form\Theme\Bootstrap());

            $form[] = (new \Mojo\Form\Input())
                        ->id('foo')
                        ->label('Hello World')
                        ->placeholder('hello')
                        ->validate('required|min:2|email');

            $form[] = (new \Mojo\Form\Textarea())
                        ->id('bar')
                        ->label('Hello')
                        ->placeholder('hello')
                        ->validate('required|min:5|max:10');

            $form[] = ['label' => 'Foo' , 'value' => 'Bar'];

            $form[] = (new \Mojo\Form\Select())
                        ->id('quz')
                        ->label('Select :')
                        ->option('', '')
                        ->option('Hello', 'hello')
                        ->option('World', 'world')
                        ->validate('required');

            $form[] = (new \Mojo\Form\Checkbox())
                        ->label('Checkboxy')
                        ->option('Hello', 'hello', 'o1')
                        ->option('World', 'world', 'o2');

            $form[] = (new \Mojo\Form\Radio())
                        ->name('fibox')
                        ->label('Radio :')
                        ->option('Hello', 'hello')
                        ->option('World', 'world')
                        ->validate('required');

            $form[] = (new \Mojo\Form\Submit())
                        ->value('Submit');

            $this->string($form->getAttribute('action'))->isEqualTo('/admin/foo');
            $this->string($form->getAttribute('method'))->isEqualTo('post');
            $this->array($form->getChilds())->hasSize(7);

        }

        public function testRadio()
        {
            $input = (new \Mojo\Form\Radio())
                ->name('fibox')
                ->label('Radio :')
                ->option('Hello', 'hello')
                ->option('World', 'world')
                ->validate('required');

            $this->string($input->getLabel())->isEqualTo('Radio :');
            $this->variable($input->getId())->isNull();
            $this->string($input->getAttribute('name'))->isEqualTo('fibox');
            $this->variable($input->getAttribute('placeholder'))->isNull();
            $this->array($input->getOptions())->hasSize(2);

        }

        public function testSelect()
        {

            $input = (new \Mojo\Form\Select())
                ->id('quz')
                ->label('Select :')
                ->option('', '')
                ->option('Hello', 'hello')
                ->option('World', 'world');

            $this->string($input->getLabel())->isEqualTo('Select :');
            $this->string($input->getId())->isEqualTo('quz');
            $this->string($input->getAttribute('name'))->isEqualTo('quz');
            $this->array($input->getOptions())->hasSize(3);

        }

        public function testSubmit()
        {
            $input = (new \Mojo\Form\Submit())
                ->value('Submit');

            $this->string($input->getAttribute('value'))->isEqualTo('Submit');

        }

        public function testTextarea()
        {
            $input = (new \Mojo\Form\Textarea())
                ->id('bar')
                ->label('Hello')
                ->placeholder('hello');

            $this->string($input->getLabel())->isEqualTo('Hello');
            $this->string($input->getId())->isEqualTo('bar');
            $this->string($input->getAttribute('name'))->isEqualTo('bar');
            $this->string($input->getAttribute('placeholder'))->isEqualTo('hello');

        }
    }
}
