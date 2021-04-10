<?php

namespace Application\Core;

class Router
{
    private string $route;
    private object $Model;
    private string $templatesPath;

    public function __construct()
    {
        $this->Model = new Model();
        $this->route = $_SERVER['REQUEST_URI'];
        $this->templatesPath = 'views/';
    }

    public function run()
    {
        if ($this->route == '/') {
            $this->layout();
            include $this->templatesPath.'index.php';
        } else if ($this->route == '/signup') {
            $this->Model->loginAction();
            $this->layout();
            include $this->templatesPath.'login.php';
        } else if ($this->route == '/signin') {
            $this->Model->registerAction();
            $this->layout();
            include $this->templatesPath.'register.php';
        } else if ($this->route == '/profile') {
            $this->layout();
            include $this->templatesPath.'profile.php';
        } else if ($this->route == '/logout') {
            include $this->templatesPath.'logout.php';
        } else {
            $this->layout();
            include $this->templatesPath.'error.404.php';
        }
    }

    private function layout()
    {
        include $this->templatesPath.'layout.default.php';
    }
}