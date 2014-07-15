<?php
namespace Application\Model\Record {

    use Hoa\Database\Query\Insert;
    use Hoa\Database\Query\Select;

    class Acl extends \Mojo\Model\ActiveRecord
    {

        public function getGroup()
        {
            $select = new Select;
            $select
                ->from('`group`');

            $return = $this->sql($select)->all();
            $group  = [];

            foreach ($return as $value) {
                $group[] =  [
                                'id'    => $value['name'] ,
                                'label' => $value['label'],
                                'inherit' => explode(',', $value['inherit'])
                            ];
            }

            return $group;
        }

        public function getPermissionByGroup()
        {
            return [
                'admin' => [
                    new \Hoa\Acl\Permission('admin.user.delete'),
                ],
                'mod' => [
                    new \Hoa\Acl\Permission('admin.panel'),
                    new \Hoa\Acl\Permission('admin.user.show'),
                    new \Hoa\Acl\Permission('admin.user.edit'),
                    new \Hoa\Acl\Permission('admin.user.create'),
                    new \Hoa\Acl\Permission('admin.user.special')

                ],
                'user' => [
                    new \Hoa\Acl\Permission('user.panel.show'),
                    new \Hoa\Acl\Permission('user.panel.edit'),
                ],
                'guest' => [
                    new \Hoa\Acl\Permission('user.panel.create'),
                ]
            ];

        }
    }
}
