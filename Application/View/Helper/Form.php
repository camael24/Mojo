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
        private  $_data = array();

        public function setData(Array $data = array())
        {
                $this->_data = $data;
        }

        protected function get($name)
        {
            $name = strtolower($name);
            if(array_key_exists($name, $this->_data))

                return $this->_data[$name];

            return null;
        }

        public function input($name , $placeholder = '' ,$type = 'text' , $id='', $validate = '' , $value = null)
        {
                if($placeholder === '')
                    $placeholder = $name;

                if($id === '')
                    $id = ucfirst(strtolower($name));

                if($value === null)
                    $value = $this->get($id);

                if($value === null)

                    return '  <div class="form-group"><label for="input'.$id.'" class="col-sm-2 control-label">'.$name.'</label><div class="col-sm-10">
                <input type="'.$type.'" name="'.strtolower($id).'" class="form-control" id="input'.$id.'" placeholder="'.$placeholder.'"></div></div>';
                else
                    return '  <div class="form-group"><label for="input'.$id.'" class="col-sm-2 control-label">'.$name.'</label><div class="col-sm-10">
                <input type="'.$type.'"  name="'.strtolower($id).'" class="form-control" id="input'.$id.'" placeholder="'.$placeholder.'" value="'.$value.'"></div></div>';
        }

        public function submit($value = '')
        {
            if($value === '')

                    return '<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-default">Sign in</button></div></div>';
        }

    }
}
