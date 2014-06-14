<?php
namespace Application\Model\Record {
    class Acl
    {
        public function getGroup()
        {
            return [
                ['id' => 'guest' ,'label' => 'Invité'		 , 'inherit' => []],
                ['id' => 'user'  ,'label' => 'Utilisateur'   , 'inherit' => ['guest']],
                ['id' => 'mod'   ,'label' => 'Moderateur'    , 'inherit' => ['user']],
                ['id' => 'admin' ,'label' => 'Administrateur', 'inherit' => ['mod']]
            ];
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
