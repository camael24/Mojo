<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Group extends Generic\Admin
    {

        public function indexAction()
        {
            $modelAcl        = new \Application\Model\Record\Acl();
            $this->data->acl = $modelAcl->getGroup();

            $this->greut->render();
        }

        public function newAction()
        {

        }

        public function showAction($user_id)
        {

        }

        public function createAction()
        {

        }

        public function activateAction($user_id)
        {

        }

        public function unactivateAction($user_id)
        {

        }

        public function deleteAction($user_id)
        {

        }

        public function editAction($user_id)
        {

        }

        public function updateAction($user_id)
        {

        }
    }
}
