<?php
        
class session {
    public function __construct() {
        $this->config = getConfig('session');
        $this->start();
    }
    private function start() {
        $cookieParams = session_get_cookie_params();

        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $this->config['secure'],$this->config['httponly']);
        session_name($this->config['secure_session_id']);
        session_start();
        session_regenerate_id();
    }
    public function stop() {
        $_SESSION = array();
        $cookieParams = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000, $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], $cookieParams["httponly"]);
        session_destroy();
    }
}

?>