<?php
namespace Mojo\Debug  {
    class Bar
    {
        private $_framework = null;
        private $_msg = array();
        public function setFramework(\Sohoa\Framework\Framework $framework)
        {
                $this->_framework = $framework;
        }

        public function alert($message)
        {
            $this->_msg('alert' , $message);
        }

        public function info($message)
        {
            $this->_msg('info' , $message);
        }

        public function message($message)
        {
            $this->_msg('message' , $message);
        }

        public function sql($sql)
        {
            if(is_array($sql))
                foreach ($sql as $key => $value)
                    $this->_msg('sql' , '#'.$key."\t".$value[0]."\t => Result : ".$value[1].' lines');

        }

        protected function _msg($type , $message , $time = null)
        {
            if($time === null)
                $time = time();

            $this->_msg[] =  array('type' => $type ,'message' =>  $message ,'time' =>  $time);

        }

    protected function _router()
    {
        $router = $this->_framework->getRouter();
        $dump = $router->dump();

        $out = '<table class="table"><tr><th>Method</th><th>Route</th><th>Name</th><th>Controller#Action</th></tr>';

        $rule = $router->getTheRule();
        $rule = $rule[1];

        foreach ($dump as $key => $value)
            if($rule === $value[0])
                $out .= '<tr class="success"><td>'.$value[1].'</td><td>'.$value[2].'</td><td>'.$value[0].'</td><td>'.$value[3].'</td></tr>';
            else
                $out .= '<tr><td>'.$value[1].'</td><td>'.$value[2].'</td><td>'.$value[0].'</td><td>'.$value[3].'</td></tr>';

        return $out . '</table>';
    }

    protected function _session()
    {
         if(\Hoa\Session\Session::isStarted() === false)

            return '<div class="alert alert-danger">Session not activated</div>';

        $out = '<table class="table striped"><tr><th>Name</th><th>Key</th><th>Value</th></tr>';

            $convert = function ($value) {
                if(is_string($value))

                    return $value;

                if(is_array($value))

                    return json_encode($value);

                if(is_object($value))

                    return 'Object '.get_class($value);

                if(is_bool($value))
                    if($value === TRUE)

                        return 'true';
                    else
                        return 'false';

                if(is_int($value))

                    return 'int('.$value.')';

                if(is_double($value))

                    return 'double('.$value.')';

                if(is_float($value))

                    return 'float('.$value.')';

                return $value;
            };

        foreach ($_SESSION[\Hoa\Session\Session::TOP_NAMESPACE] as $name => $v)
            foreach ($v as  $item)
                foreach ($item as  $key => $value)
                $out .= '<tr><td>'.$name.'</td><td>'.$key.'</td><td>'.$convert($value).'</td></tr>';

        return $out . '</table>';
    }

    protected function _messages()
    {
         if(empty($this->_msg) === true)

            return '<div class="alert alert-danger">No messages</div>';

        $out = '<ul class="list-group">';
        foreach ($this->_msg as $value) {
                $theme = '';
                switch ($value['type']) {
                    case 'alert':
                        $theme = 'list-group-item-danger';
                        break;
                    case 'message':
                        $theme = 'list-group-item-success';
                        break;
                    case 'info':
                        $theme = 'list-group-item-info';
                        break;
                    case 'sql':
                        $theme = 'list-group-item-warning';
                        break;
                }

            $out .='<li class="list-group-item '.$theme.'">'.$value['message'].' <span class="badge">'.date('H:i:s' , $value['time']).'</span></li>';
        }

  $out .= '</ul>';

return $out;
    }

    protected function _forms()
    {
            if(empty($_POST) === true)

            return '<div class="alert alert-danger">No POST data</div>';

        $out = '<ul class="list-group">';

        foreach ($_POST as $key => $value)
            $out .='<li class="list-group-item">'.$key.'<span class="badge">'.$value.'</span></li>';

        $out .= '</ul>';

        return $out;
    }
    protected function _mojo()
    {
        $path = function ($p) {
            return '<li class="list-group-item">'.$p.' <span class="badge">'.resolve($p).'</span></li>';
        };
        $fwk = $this->_framework;
        $out = '<ul class="list-group">
  <li class="list-group-item">PHP <span class="badge">'.phpversion().'</span></li>
  <li class="list-group-item">Environnement <span class="badge">'.$fwk->getEnvironnement()->getEnvironnement().'</span></li>
  <li class="list-group-item">Path</li>';
  $out .= $path('hoa://Application');
  $out .= $path('hoa://Application/Controller');
  $out .= $path('hoa://Application/Public');
  $out .= $path('hoa://Public');
  $out .= '</ul>';

return $out;
    }
        public function render()
        {
$out = '<ul class="nav nav-tabs">
  <li class="disabled"><a href="#" data-toggle="tab"><i class=" glyphicon glyphicon-exclamation-sign"></i></a></li>
  <li><a href="#mojo" data-toggle="tab">Mojo</a></li>
  <li><a href="#router" data-toggle="tab">Router</a></li>

  <li><a href="#session" data-toggle="tab">Session</a></li>
  <li><a href="#messages" data-toggle="tab">Messages</a></li>
  <li><a href="#forms" data-toggle="tab">Forms</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane" id="mojo">'.$this->_mojo().'</div>
  <div class="tab-pane" id="router">'.$this->_router().'</div>
  <div class="tab-pane" id="session">'.$this->_session().'</div>
  <div class="tab-pane" id="messages">'.$this->_messages().'</div>
  <div class="tab-pane" id="forms">'.$this->_forms().'</div>
</div>';

            return $out;
        }

    }
}
