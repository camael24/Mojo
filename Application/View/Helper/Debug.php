<?php

/**
 * Description of Dummy
 *
 * @author Guile
 */

namespace Application\View\Helper {

    use Sohoa\Framework\View;
    use Hoa\Console\Chrome\Text;

    class Debug extends View\Helper
    {

        private $_debugEnable = FALSE;

        public function __construct()
        {
            if(defined('MOJO_DEBUG') and MOJO_DEBUG === TRUE)
                $this->_debugEnable = true;
        }

        public function __call($name, $args)
        {
                if($this->_debugEnable === FALSE)

                    return '';

                $name = '_'.$name;
                if(in_array($name, get_class_methods($this)))

                    return call_user_func_array([$this, $name], $args);
        }
        protected function _show()
        {
            $bar = $this->view->getFramework()->getDebugBar();

            return $bar->render();
        }
    }
}
