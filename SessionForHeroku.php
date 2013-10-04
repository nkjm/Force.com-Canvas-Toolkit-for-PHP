<?php
require_once 'MemcacheSASL.php';

class SessionForHeroku {
    public $session_id;
    public $memcache;

    public function __construct(){
        ini_set('session.use_cookies', false);
        ini_set('session.use_trans_sid', true);
        ini_set('session.use_only_cookies', false);

        // start session
	if (!session_start()){
            trigger_error("Session is not available.", E_USER_ERROR);
	}

        $this->session_id = session_id();

        // initiate memcache
        $this->memcache = new MemcacheSASL;
        $this->memcache->addServer($_ENV["MEMCACHIER_SERVERS"], '11211');
        $this->memcache->setSaslAuthData($_ENV["MEMCACHIER_USERNAME"], $_ENV["MEMCACHIER_PASSWORD"]);
    }

    public function add($k, $v){
        if (!isset($this->session_id) || empty($this->session_id)){
            trigger_error("Session is not available.", E_USER_ERROR);
        }
        if (!isset($this->memcache)){
            trigger_error("Memcachier is not available.", E_USER_ERROR);
        }

        $this->memcache->add($this->session_id . '_' . $k, $v); 
    }

    public function get($k){
        if (!isset($this->session_id) || empty($this->session_id)){
            trigger_error("Session is not available.", E_USER_ERROR);
        }
        if (!isset($this->memcache)){
            trigger_error("Memcachier is not available.", E_USER_ERROR);
        }

        return $this->memcache->get($this->session_id . '_' . $k);
    }
}
?>
