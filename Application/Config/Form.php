<?php

$form = \Mojo\Form\Form::get('foo'); // Load $_POST information !
$form
    ->action('/admin/foo')
    ->method('post')
    ->setTheme(new \Mojo\Form\Theme\Bootstrap());

$form[] = (new \Mojo\Form\Input())
            ->id('foo')
            ->label('Hello World')
            ->placeholder('hello')
            ->validate('required|min:2|max:3');

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
