<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');
?>
<br />
<h1>Inscription</h1>
        <?php
            $s = new \Hoa\Session\Session('form');
            echo $this->form->get('admin.user', $s['field']);
        ?>

<?php
    $this->endBlock();
