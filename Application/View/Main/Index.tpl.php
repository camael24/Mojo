<?php
    $this->inherits('hoa://Application/View/Layout/Basic.tpl.php');
    $this->block('content');

    echo $this->form->get('foo');

    $this->endBlock();
