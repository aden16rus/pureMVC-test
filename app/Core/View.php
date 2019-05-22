<?php

    include_once ('../app/Core/Helper.php');

class View
{

    private function get(string $view, array $data = null)
    {
           include '../app/views/'.$view.'.php';
    }

    public function generate(string $template, $data = null, string $msg = null, string $msgType = null)
    {
        $this->get('header');
        if (isset($msg)) {
            $this->get('message', array('msg' => $msg, 'type' => $msgType));
        }
        $this->get($template, $data);
        $this->get('footer');
    }

}