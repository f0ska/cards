<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tpl
{
    public $data = array();
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function set($position, $template, $data = array())
    {
        $this->data[$position] = $this->ci->load->view($template, $data, true);
    }

    public function get($position)
    {
        if (isset($this->data[$position]))
        {
            return $this->data[$position];
        }
        else
        {
            return '';
        }
    }

    public function is($position)
    {
        if (isset($this->data[$position]) && $this->data[$position])
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function render($template)
    {
        $this->ci->load->view($template);
    }
}
