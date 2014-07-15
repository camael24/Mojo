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

            $form    = \Mojo\Form\Form::get('admin.user');
            $form->action('/user/');
            $form->setData($this->post->all());
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
            $check   = new \Mojo\Form\Validate\Check('admin.user');
            $form->setData($this->post->all());

            if ($check->isValid() === false) {
                $session['field'] = $this->post->all();
                $this->redirect->redirect('newUser');
            }

            if ($form->getData('password') !== $form->getData('rpassword')) {
                $this->flash->error('password', 'The password and confirmation are not egal');
                $session['field'] = $this->post->all();
                $this->redirect->redirect('newUser');
            }
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
            $model              = new \Application\Model\Mapped\User($user_id);
            $this->data->user   = $model;
            $form               = \Mojo\Form\Form::get('admin.user');
            $form->insertBeforeLast('<div class="form-group"><label for="input" class="col-sm-2 control-label">Groups</label><div class="col-sm-10"><input type="text" value="" data-role="tagsinput" class="tag-groups" name="groups"/></div></div>');
            $form->action('/user/'.$model['idUser']);

            $form->fill([
                'login'     => $model['login'],
                'password'  => '',
                'rpassword' => '',
                'name'      => $model['name'],
                'email'     => $model['email']
            ]);

            if (!empty($_POST)) {
                $form->check();
            }

            $this->greut->render();
        }

        public function updateAction($user_id)
        {
            $form             = \Mojo\Form\Form::get('admin.user');
            $check            = new \Mojo\Form\Validate\Check('admin.user');
            $model            = new \Application\Model\Mapped\User($user_id);
            $form['password']
                            ->optionnal()
                            ->need('length:5:');
            $form['rpassword']
                            ->optionnal()
                            ->need('length:5:');

            $form->setData($this->post->all());

            echo '<pre>'.print_r($this->post->all(), true).'</pre>';

            var_dump($check->isValid());

            if ($check->isValid() === false) {
                $this->flash->error('Error', 'An error on a field');
                $this->redirect->redirect('editUser', ['user_id' => $user_id]);
            }

            if ($form->getData('password') !== $form->getData('rpassword')) {
                $this->flash->error('Password', 'The password and confirmation are not egal');
                $this->redirect->redirect('editUser', ['user_id' => $user_id]);
            }

            $user = new \Application\Model\Record\User();
            $new  = [
                    'login'    => $this->post['login'],
                    'password' => sha1($this->post['password']),
                    'email'    => $this->post['email'],
                    'name'     => $this->post['name']
            ];
            $old  = [
                    'login'    => $model['login'],
                    'password' => $model['password'],
                    'email'    => $model['email'],
                    'name'     => $model['name']
            ];

            $diff = array_diff($new, $old);

            if ($this->post['password'] === '') {
                unset($diff['password']);
            }

            echo '<pre>'.print_r($diff, true).'</pre>';
            $bool = $user->set($user_id, $diff);

            $this->flash->success('New user', 'User update');
            $this->redirect->redirect('indexUser');
        }
    }
}
