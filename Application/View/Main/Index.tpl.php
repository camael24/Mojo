<?php
    $this->inherits('hoa://Application/View/Layout/Basic.tpl.php');
    $this->block('content');
    echo '<div class="well"><h1>Foobar</h1></div>';
    $this->endBlock();
