<?php

/**
 * Description of Dummy
 *
 * @author Guile
 */

namespace Application\View\Helper {

    use Sohoa\Framework\View;
    use Hoa\Console\Chrome\Text;

    class Form extends View\Helper
    {
        public function get($name)
        {
            return \Mojo\Form\Form::get('foo')->render();
        }

    }
}
