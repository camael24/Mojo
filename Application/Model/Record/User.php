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

            public function newUser($login , $password, $email , $name)
            {
                $insert = new Insert;
                $insert
                    ->into('user')
                    ->on('idUser', 'login' , 'password' , 'name' , 'email' , 'token' , 'activated', 'registerTime' , 'connectTime' , 'avatarType' ,'avatarData')
                    ->values('null' , '?' , '?' , '?', '?' , '?', '?' , '?' , '?', '?' , '?');

                        $this
                        ->sql($insert , [$login , sha1($password) , $name, $email, md5(time()) , '0', time() , '0', '' , '']);
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

            public function getAll($start = null , $nb = 15)
            {
             $select = new Select();
                $select
                    ->from('user')
                    ->where('activated = 1');


            if( $start !== null)
                    $select->limit($start*$nb , $nb);



                return $this->sql($select , [])->all();
            }

        public function count(){

            $s = $this->sql('SELECT COUNT(*) FROM user WHERE activated = 1;')->first();
            $s = array_values($s);

            if(array_key_exists(0, $s))
                return intval($s[0]);

        return 0;
        }
    }
}
