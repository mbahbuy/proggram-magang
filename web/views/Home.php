<?php

class Home extends Controller {
    public function index(){
        $data['judul'] = 'Home';
        $this->view('header', $data );
        $this->view('home_index', $data);
        $this->view('footer');
    }
}