<?php
namespace Mojo\Form\Theme {
    class Bootstrap extends Generic
    {
        protected $_sizeLabel = 'col-sm-2';
        protected $_sizeControl = 'col-sm-5';
        public function form($form)
        {

            $out = '<form class="form-horizontal" role="form" '.$form->getAttributeAsString().'>';
            foreach ($form->getChilds() as $child)
                $out .= $this->item($child);

            $out .= '</form>';

            return $out;
        }

        public function item($item)
        {
            if(is_object($item))
                $class = get_class($item);
            else
                $class = 'Text';

            switch ($class) {
                case 'Text':
                    return $this->text($item);
                    break;
                case 'Mojo\Form\Textarea':
                    return $this->textarea($item);
                    break;
                case 'Mojo\Form\Checkbox':
                    return $this->check($item);
                    break;
                case 'Mojo\Form\Radio':
                    return $this->radio($item);
                    break;
                case 'Mojo\Form\Select':
                    return $this->select($item);
                    break;
                case 'Mojo\Form\Submit':
                case 'Mojo\Form\Input':
                    return $this->input($item);
                    break;
                default:
                    # code...
                    break;
            }
        }

        public function input($item)
        {
            return '<div class="form-group">
            <label for="'.$item->getId().'" class="'.$this->_sizeLabel.' control-label">'.$item->getLabel().'</label>
            <div class="'.$this->_sizeControl.'"><'.$item->getName().' '.$item->getAttributeAsString().' class="form-control" /></div>
            </div>';
        }

        public function text($item)
        {
            $label = $item['label'];
            $value = $item['value'];

            return '<div class="form-group">
            <label class="'.$this->_sizeLabel.' control-label">'.$label.'</label>
            <div class="'.$this->_sizeControl.'"><p class="form-control-static">'.$value.'</p>
            </div></div>';
        }

        public function textarea($item)
        {
            $value = $item->extractAttribute('value');
            $item->defaultAttribute('class' , 'form-control');

            return '<div class="form-group">
            <label for="'.$item->getId().'" class="'.$this->_sizeLabel.' control-label">'.$item->getLabel().'</label>
            <div class="'.$this->_sizeControl.'"><'.$item->getName().' '.$item->getAttributeAsString().'>'.$value.'
            </'.$item->getName().'></div>
            </div>';

        }

        public function select($item)
        {
            $item->defaultAttribute('class' , 'form-control');

            $select = '<'.$item->getName().' '.$item->getAttributeAsString().'>';
            foreach ($item->getOptions() as $value)
                if($value[1] !== null)
                    $select .= '<option value="'.$value[1].'">'.$value[0].'</option>';
                else
                    $select .= '<option>'.$value[0].'</option>';
            $select .= '</'.$item->getName().'>';

            return '<div class="form-group">
            <label for="'.$item->getId().'" class="'.$this->_sizeLabel.' control-label">'.$item->getLabel().'</label>
            <div class="'.$this->_sizeControl.'">'.$select.'</div>
            </div>';
        }

        public function check($item)
        {
            $select = '';
            foreach ($item->getOptions() as $value)
                    $select .= '<label class="checkbox-inline"><'.$item->getName().' '.$item->getAttributeAsString().' name="'.$value[2].'" value="'.$value[1].'" />'.$value[0].'</label>';

            return '<div class="form-group">
            <label for="'.$item->getId().'" class="'.$this->_sizeLabel.' control-label">'.$item->getLabel().'</label>
            <div class="'.$this->_sizeControl.'">'.$select.'</div>
            </div>';
        }

        public function radio($item)
        {
            $name = $item->extractAttribute('name');
            $select = '';
            foreach ($item->getOptions() as $value)
                    $select .= '<label class="radio-inline"><'.$item->getName().' '.$item->getAttributeAsString().' name="'.$name.'" value="'.$value[1].'" />'.$value[0].'</label>';

            return '<div class="form-group">
            <label for="'.$item->getId().'" class="'.$this->_sizeLabel.' control-label">'.$item->getLabel().'</label>
            <div class="'.$this->_sizeControl.'">'.$select.'</div>
            </div>';
        }
    }
}
