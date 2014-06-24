<?php

namespace {

    use Sohoa\Framework\Framework;

    require_once __DIR__ . '/../vendor/autoload.php';

    $framework = new \Mojo\Mojo('Dev');
    $framework->kit('flash', new \Application\Controller\Kit\Flash());
    $framework->kit('post', new \Application\Controller\Kit\Post());
    $framework->kit('acl', new \Application\Controller\Kit\Acl());

    $framework->run();
}
