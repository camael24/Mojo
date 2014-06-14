<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Admin extends Generic\Admin
    {
        public function indexAction()
        {

            //$this->flash->alert('foo' , 'bar');
            if ($this->acl->need('admin.panel') === false) {
                $this->flash->alert('Acces unauthorized' , '');
                $this->redirect->redirect('root');
            }

            $user = new \Application\Model\Record\User();

            $query = $this->router->getQuery();
            $page = isset($query['page']) ? $query['page'] : 1;
            $page = $page -1;
            $total = $user->count();

            if($page <= 0 )
                $page = 0;

            if($page > $total)
                $page = $total;

            // Page ... non opérationnel

            $nbPerPage = 15;
            $all = $user->getAll($page , $nbPerPage , false);
            $this->data->page = $page;
            $this->data->total = ($total/$nbPerPage);
            $this->data->all = $all;

            $previous = $page - 1;
            if($previous <= 0)
                $previous = 0;

            $next = $page + 1;
            if($next >= $total)
                $next = $total;

            $this->data->prev = $previous;
            $this->data->next  = $next;

            $this->greut->render();

        }

        public function createAction()
        {
            if ($this->post->check(['login' , 'password']) !== true) {
                $this->flash->alert('Error' , 'Erreur dans le formulaire un champ est manquant ou vide');
                $this->redirect->redirect('indexUser');
            } else {

                $user   = new \Application\Model\Record\User();
                $login  = $this->post['login'];
                $pass   = $this->post['password'];

                if (($data =$user->connect($login, $pass)) !== false) {
                    $user->getByLogin($login);
                    $u           = new \Hoa\Session\Session('user');
                    $u['id']     = $data['idUser'];
                    $u['name']   = $data['name'];
                    $u['login']  = $data['login'];
                    $u['email']  = $data['email'];
                    $u['token']  = $data['token'];
                    $u['logged'] = true;

                    $this->data->isLogged   = true;
                    $this->data->id         = $u['id'];
                    $this->data->name       = $u['name'];

                    $this->flash->success('Welcome' , '');
                } else {
                    $this->flash->alert('Error' , 'Credential non authorized');
                    $this->redirect->redirect('indexUser');
                }

                $this->greut->render();
            }
        }

        public function userAction()
        {
            $this->greut->render(['Admin' , 'Index']);
        }

    }
}
