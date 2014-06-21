<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class User extends Generic\Admin
    {

        public function indexAction()
        {

            $user = new \Application\Model\Record\User();

            $query = $this->router->getQuery();
            $page = isset($query['page']) ? $query['page'] : 1;
            $page = $page -1;
            $total = $user->count();

            if ($page <= 0) {
                $page = 0;
            }

            if ($page > $total) {
                $page = $total;
            }

            // Page ... non opérationnel

            $nbPerPage = 15;
            $all = $user->getAll($page, $nbPerPage, true);
            $this->data->page = $page;
            $this->data->total = ($total/$nbPerPage);
            $this->data->all = $all;

            $previous = $page - 1;
            if ($previous <= 0) {
                $previous = 0;
            }

            $next = $page + 1;
            if ($next >= $total) {
                $next = $total;
            }

            $this->data->prev = $previous;
            $this->data->next  = $next;

            $this->greut->render();
        }

        public function newAction()
        {
            $this->greut->render();
        }

        public function showAction($user_id)
        {
            $this->data->user = new \Application\Model\Mapped\User($user_id);
            $this->greut->render();
        }
        public function createAction()
        {
            $session = new \Hoa\Session\Session('form');
            $form    = \Mojo\Form\Form::get('admin.user');
            if ($this->post->check(['login', 'password', 'rpassword', 'email', 'name']) === false) {
                $session['field'] = $this->post->all();
                $this->redirect->redirect('newUser');
            }

            var_dump($this->post->all());

               exit('foo');
            $session->forgetMe();
            $user = new \Application\Model\Record\User();
            $bool = $user->newUser(
                $this->post['login'],
                $this->post['password'],
                $this->post['email'],
                $this->post['name']
            );

            if ($bool === true) {
                $this->flash->success('New user', 'User create');
            } else {
                $this->flash->error('New user', 'We can not create this user');
            }

            $this->redirect->redirect('indexUser');
        }
        public function activateAction($user_id)
        {
            if ($this->acl->need('admin.user.special') === true) {
                $user               = new \Application\Model\Mapped\User($user_id);
                $user['activated']  = '1';
                $user->update();

                $this->flash->success('User#Activate', 'User has been activate');
                $this->redirect->redirect('indexAdmin');
            } else {
                 $this->flash->alert('User#Activate', 'Credential not allow');
                 $this->redirect->redirect('indexAdmin');
            }

        }

        public function unactivateAction($user_id)
        {
            if ($this->acl->need('admin.user.special') === false) {
                $this->flash->alert('User#Unactivate', 'Credential not allow');
                $this->redirect->redirect('indexAdmin');
            }

            $user               = new \Application\Model\Mapped\User($user_id);
            $user->mode(null, \Application\Model\Mapped\User::UPDATE_ALL_VALUE); // WTF ??
            $user['activated']  = '0' ;
            $user->update();

            $this->flash->success('User#Unactivate', 'User has been unactivate');
            $this->redirect->redirect('indexAdmin');
        }

        public function deleteAction($user_id)
        {
            $u = new \Hoa\Session\Session('user');
            if ($user_id !== $u['id']) {
                $user = new \Application\Model\Record\User();
                $user->delete($user_id); // todo : Probleme here

                $this->flash->success('User#Delete', 'Account delete!');
            } else {
                $this->flash->alert('User#Delete', 'You can delete your account !');
            }

            $this->redirect->redirect('indexUser');
        }

        public function editAction($user_id)
        {
            $model = new \Application\Model\Mapped\User($user_id);
            $this->data->user = $model;

            $this->greut->render();
        }
    }
}
