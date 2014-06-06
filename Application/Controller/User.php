<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class User extends Kit
    {

        public function construct()
        {
            $this->framework->getDebugBar()->sql(\Application\Model\Mapped\User::getSqlLog());
        }

        public function indexAction()
        {
            $user = new \Application\Model\Record\User();

            $query = $this->router->getQuery();
            $page = isset($query['page']) ? $query['page'] : 1;
            $page = $page -1;
            $total = $user->count();

            if($page <= 0 )
                $page = 0;

            if($page > $total)
                $page = $total;

            $nbPerPage = 1;
            $all = $user->getAll($page , $nbPerPage);
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

        public function NewAction()
        {
            $this->greut->render();
        }

        public function ShowAction($user_id) {

            $this->data->user = new \Application\Model\Mapped\User($user_id);
            $this->greut->render();
        }
        public function CreateAction()
        {
            $session = new \Hoa\Session\Session('form');
            if ($this->post->check(['login' , 'password' , 'rpassword' , 'email' , 'name' ]) === false) {

               $session['field'] = $this->post->all();
               $this->redirect->redirect('newUser');
           }

            $session->forgetMe();
            $user = new \Application\Model\Record\User();
            $user->newUser($this->post['login'], $this->post['password'], $this->post['email'] , $this->post['name']);


            $this->redirect->redirect('indexUser');
        }
    }
}
