<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');
?>
<br />
<form class="form-horizontal" role="form" method="post" action="/user/">
<h1>Inscription</h1>
        <?php
            $s = new \Hoa\Session\Session('form');
            if($s->isEmpty() !== true)
                $this->form->setData($s['field']);

            echo $this->form->input('Login');
            echo $this->form->input('Password' ,'Mot de passe' , 'password');
            echo $this->form->input('Confirmation du mot de passe' ,'Mot de passe' , 'password' , 'rpassword');
            echo $this->form->input('Email' , '' , 'email');
            echo $this->form->input('Identifiant');
            echo $this->form->submit();
        ?>
</form>

<?php
    $this->endBlock();
