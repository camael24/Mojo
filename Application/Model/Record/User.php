<?php
namespace Application\Model\Record {

use Hoa\Database\Query\Insert;
use Hoa\Database\Query\Select;

    class User extends \Mojo\Model\Model
    {
            public function sample()
            {
                     $this->sql('DELETE FROM user;');

                $insert = new Insert;
                $insert
                    ->into('user')
                    ->on('idUser', 'login' , 'password' , 'name' , 'email' , 'token' , 'activated', 'registerTime' , 'connectTime' , 'avatarType' ,'avatarData')
                    ->values('null' , '?' , '?' , '?', '?' , '?', '?' , '?' , '?', '?' , '?');

                        $this
                        ->sql($insert , ['thehawk' , '123456789' , 'thehawk1', 'thehawk970@gmail.com', 'aze123456' , '1', time() , time() , 'local' , './Foobar.jpg'])
                        ->sql($insert , ['thehawk' , '123456789' , 'thehawk2', 'thehawk971@gmail.com','aze123456' , '1', time() , time() , 'local' , './Foobar.jpg'])
                        ->sql($insert , ['thehawk' , '123456789' , 'thehawk3', 'thehawk972@gmail.com','aze123456' , '1', time() , time() , 'local' , './Foobar.jpg'])
                        ->sql($insert , ['thehawk' , '123456789' , 'thehawk4', 'thehawk973@gmail.com','aze123456' , '1', time() , time() , 'local' , './Foobar.jpg']);

            }

            public function newUser($login , $password, $email)
            {
                $insert = new Insert;
                $insert
                    ->into('user')
                    ->on('idUser', 'login' , 'password' , 'name' , 'email' , 'token' , 'activated', 'registerTime' , 'connectTime' , 'avatarType' ,'avatarData')
                    ->values('null' , '?' , '?' , '?', '?' , '?', '?' , '?' , '?', '?' , '?');

                        $this
                        ->sql($insert , [$login , sha1($password) , $login, $email, crc32(time()) , '0', time() , '0', '' , '']);
            }

            public function getByLogin($login)
            {
                $select = new Select();
                $select
                    ->from('user')
                    ->where('login = ?');

                return $this->sql($select , [$login])->first();
            }

            public function getByID($id)
            {
                $select = new Select();
                $select
                    ->from('user')
                    ->where('idUser = ?');

                return $this->sql($select , [$id])->first();
            }

    }
}
