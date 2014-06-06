<?php
namespace Application\Controller\Kit {
    class Flash extends \Sohoa\Framework\Kit\Kitable
    {
            private $_data = array();

            public function construct()
            {

            }

            public function alert($title , $content)
            {
                $this->_box('alert' , $title , $content);
            }

            public function success($title , $content)
            {
                $this->_box('success' , $title , $content);
            }

            protected function _box($type , $title , $content)
            {

                $f = new \Hoa\Session\Flash('notif.box');
                $f['type'] =  $type;
                $f['title'] = $title;
                $f['content'] = $content;
            }

    }
}
