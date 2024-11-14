<?php

namespace Lib;

class View
{
    protected $template;
    protected $view;
    public $meta = [];
    public $scripts = [];
    public $styles = [];
    public $data = [];

    public function __construct($view, $template = 'main')
    {
        $this->view = $view;
        $this->template = 'templates/' . $template . '.php';
    }

    public function render()
    {
        extract($this->data);

        $filepath =  $_ENV['APP_ROOT'] . "/views/" . $this->view . ".php";
        if (file_exists($filepath)) {
            ob_start();
            include $filepath;
            $content = ob_get_clean();
            include $_ENV['APP_ROOT'] . "/views/" . $this->template;
        } else {
            $error = "Se intentó cargar la vista '{$this->view}' pero no se encontro el archivo";
            echo "<span class='error-msg'>$error</span>";
        }
    }
}
