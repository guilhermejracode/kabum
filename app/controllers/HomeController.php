<?php

class HomeController {
    public function index() {
        $data = ['titulo' => 'Página Inicial'];
        View::render('home/index', $data);
    }
}
