<?php
namespace {

    use Hoa\Database\Query\Insert;

    $model = new \Mojo\Model\ActiveRecord();
    $model->sql('DELETE FROM user;');

    $insert = new Insert;
    $insert
        ->into('user')
        ->on('idUser', 'login', 'password', 'name', 'email', 'token', 'activated', 'registerTime', 'connectTime', 'avatarType', 'avatarData')
        ->values('null', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');

    $model->sql($insert, ['admin', sha1('admin'), 'admin', 'foo@bar.com', 'aze123456', '1', time(), time(), '', '']);

    for ($i = 0; $i< 10; $i++) {
        $model
            ->sql($insert, [
                'thehawk',
                sha1('123456789'),
                'thehawk'.$i,
                'thehawk970@gmail.com',
                'aze123456',
                '0',
                time(),
                time(),
                'local',
                './Foobar.jpg'
            ]);
    }

}
