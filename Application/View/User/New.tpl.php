<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');
?>
<br />
<form class="form-horizontal" role="form" method="post" action="/user/">
<h1>Inscription</h1>
        <?php
            $s = new \Hoa\Session\Session('form');
            echo $this->form->get('admin.user', $s['field']);
        ?>
</form>

<?php
    $this->endBlock();
