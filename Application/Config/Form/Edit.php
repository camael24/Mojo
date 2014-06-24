<?php

$form = \Mojo\Form\Form::get('admin.user'); // Load $_POST information !
$form
    ->action('/user/')
    ->method('post')
    ->setTheme(new \Mojo\Form\Theme\Bootstrap());

$form[] = (new \Mojo\Form\Input())
            ->id('login')
            ->label('Login')
            ->placeholder('Your Login')
            ->need('required|length:5:');

$form[] = (new \Mojo\Form\Input())
            ->id('password')
            ->type('password')
            ->label('Password')
            ->placeholder('Your password')
            ->need('required|length:5:');

$form[] = (new \Mojo\Form\Input())
            ->id('rpassword')
            ->type('password')
            ->label('Password')
            ->placeholder('Confirm Your password')
            ->need('required|length:5:');

$form[] = (new \Mojo\Form\Input())
            ->id('email')
            ->type('email')
            ->label('E-Mail')
            ->placeholder('Your email we don\'t send spam !')
            ->need('required|length:5:|email');

$form[] = (new \Mojo\Form\Input())
            ->id('name')
            ->label('Name')
            ->placeholder('Your name')
            ->need('required|length:5:');

$form[] = (new \Mojo\Form\Submit())
            ->value('Submit');
