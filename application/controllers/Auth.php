<?php

class Auth extends Application {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function index() {
        $this->data['pagebody'] = 'login';
        $this->render();
    }

    // submit method to handle form submission from the login view page
    // change the submit to login to match the login view page
    function login() {
        $key = $_POST['userid'];
        echo $_POST['userid'];
        echo '<br>';
        echo $_POST['password'];
        echo '<br>';
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        echo $password;
        $user = $this->users->get($key);
        if ($password == (string) $user->password) {
            $this->session->set_userdata('userID', $key);
            $this->session->set_userdata('userName', $user->name);
            $this->session->set_userdata('userRole', $user->role);
            echo 'logged in';
        }
        redirect('/');
    }

    // logout method to handle logout and clear the session value
    function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }

}
