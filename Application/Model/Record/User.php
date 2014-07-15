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
                ->on('idUser', 'login', 'password', 'name', 'email', 'token', 'activated', 'registerTime', 'connectTime', 'avatarType', 'avatarData')
                ->values('null', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');

                    $this
                    ->sql($insert, ['thehawk', '123456789', 'thehawk1', 'thehawk970@gmail.com', 'aze123456', '1', time(), time(), 'local', './Foobar.jpg'])
                    ->sql($insert, ['thehawk', '123456789', 'thehawk2', 'thehawk971@gmail.com', 'aze123456', '1', time(), time(), 'local', './Foobar.jpg'])
                    ->sql($insert, ['thehawk', '123456789', 'thehawk3', 'thehawk972@gmail.com', 'aze123456', '1', time(), time(), 'local', './Foobar.jpg'])
                    ->sql($insert, ['thehawk', '123456789', 'thehawk4', 'thehawk973@gmail.com', 'aze123456', '1', time(), time(), 'local', './Foobar.jpg']);

        }

        public function newUser($login, $password, $email, $name)
        {
            if (count($this->getByLogin($login)) > 0) {
                return false;
            }

            $insert = new Insert;
            $insert
                ->into('user')
                ->on('idUser', 'login', 'password', 'name', 'email', 'token', 'activated', 'registerTime', 'connectTime', 'avatarType', 'avatarData')
                ->values('null', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');

            $this
                ->sql($insert, [$login, sha1($password), $name, $email, md5(time()), '0', time(), '0', '', '']);

            return true;
        }

        public function set($id, Array $data)
        {
            // $data = ['cols' => 'value']

            $update = new \Hoa\Database\Query\Update;
            $update
                ->table('user')
                ->where('idUser = ?');

            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $update->set($key, '"'.$value.'"');
                }
                $this->sql($update, [$id]);
            }
        }

        public function getByLogin($login)
        {
            $select = new Select();
            $select
                ->from('user')
                ->where('login = ?');

            $f = $this->sql($select, [$login])->first();

            if ($f === null) {
                return array();
            }

            return $f;
        }

        public function getByID($id)
        {
            $select = new Select();
            $select
                ->from('user')
                ->where('idUser = ?');

            return $this->sql($select, [$id])->first();
        }

        public function getAll($start = null, $nb = 15, $activate = true)
        {
            $select = new Select();
            $select
                ->from('user');

            if ($activate === true) {
                $select->where('activated = 1');
            }

            if ($start !== null) {
                $select->limit($start*$nb, $nb);
            }

            return $this->sql($select, [])->all();
        }

        public function connect($login, $password)
        {
            $select = new Select;
            $select
                ->from('user')
                ->where('login = ?')
                ->where('password = ?')
                //->where('activated = 1')
                ;

            $all = $this
                        ->sql($select, [$login, sha1($password)])
                        ->all();

            if (count($all) === 1) {
                return $all[0];
            }

            return false;
        }

        public function count()
        {
            $s = $this->sql('SELECT COUNT(*) FROM user WHERE activated = 1;')->first();
            $s = array_values($s);

            if (array_key_exists(0, $s)) {
                return intval($s[0]);
            }

            return 0;
        }

        public function delete($id)
        {
            $delete = new \Hoa\Database\Query\Delete;
            $delete
                ->from('user')
                ->where('idUser = ?');

            $this->sql($delete, [$id]);
        }

        public function getGroup($name)
        {
            return array('admin');
        }
    }
}
