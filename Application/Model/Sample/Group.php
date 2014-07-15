<?php
namespace {

    use Hoa\Database\Query\Insert;

    $model = new \Mojo\Model\ActiveRecord();
    $model->sql('DELETE FROM `group`;');

    $insert = new Insert;
    $insert
        ->into('`group`')
        ->on('idGroup', 'name', 'label', 'inherit')
        ->values('null', '?', '?', '?');

        $model
            ->sql($insert, ['guest', 'Invite', ''])
            ->sql($insert, ['user', 'User', 'guest'])
            ->sql($insert, ['mod', 'Moderateur', 'user,guest'])
            ->sql($insert, ['admin', 'Administrateur', 'mod,user,guest']);

}
