<?php

    $acl 	= \Hoa\Acl\Acl::getInstance();
    $model 	= new \Application\Model\Record\Acl();

foreach ($model->getGroup() as $value) {
    if ($value['inherit'][0] === '') {
        $value['inherit'] = array();
    }
    $acl->addGroup(new \Hoa\Acl\Group($value['id'], $value['label']), $value['inherit']);
}

foreach ($model->getPermissionByGroup() as $key => $value) {
    $acl->allow($key, $value);
}
