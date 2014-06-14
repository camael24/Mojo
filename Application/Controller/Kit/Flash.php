<?php
namespace Application\Controller\Kit {
    class Flash extends \Sohoa\Framework\Kit\Kitable
    {
            private $_data = array();

            public function error($title , $content)
            {
                $this->_box('danger' , $title , $content);
            }

            public function alert($title , $content)
            {
                $this->_box('warning' , $title , $content);
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
