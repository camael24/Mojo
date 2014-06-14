<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');
?>
<br />
<form class="form-horizontal" role="form" method="post" action="/user/">
<h3>Edit - <?php echo $user['login']; ?></h3>
        <?php

            $this->form->setData([
                'login' => $user['login'],
                'email' => $user['email'],
                'name'  => $user['name']
            ]);

            echo $this->form->input('Login');
            echo $this->form->input('Password' ,'Mot de passe' , 'password');
            echo $this->form->input('Confirmation du mot de passe' ,'Mot de passe' , 'password' , 'rpassword');
            echo $this->form->input('Email' , '' , 'email');
            echo $this->form->input('Nom' , '' , '' , 'name');

        ?>
        <div class="form-group">
            <label for="input'.$id.'" class="col-sm-2 control-label">Groups</label>
            <div class="col-sm-10"><input type="text" value="" data-role="tagsinput" class="tag-groups"/></div>
        </div>
<?php echo $this->form->submit(); ?>
</form>

<?php
    $this->endBlock();
