<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');

echo '<br /><h3>Edit - '.$user['login'].'</h3>';
echo $this->form->get('admin.user');
$this->endBlock();
