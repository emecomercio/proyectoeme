<?php

namespace Lib;

class View
{
    protected $template;
    protected $view;
    protected $meta = [];
    public $data = [];

    public function __construct($view, $template = 'templates/app.php')
    {
        $this->view = $view;
        $this->template = $template;
    }

    public function render()
    {
        extract($this->data);

        $filepath =  $_ENV['ROOT'] . "/views/" . $this->view . ".php";
        if (file_exists($filepath)) {
            ob_start();
            include $filepath;
            $content = ob_get_clean();
            include $_ENV['ROOT'] . "/views/" . $this->template;
        } else {
            $error = "Se intentó cargar la vista '{$this->view}' pero no se encontro el archivo";
            echo "<span class='error-msg'>$error</span>";
        }
    }
}
