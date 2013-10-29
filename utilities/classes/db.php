<?php

class db extends mysqli{
    public function __construct() {
        $this->config = require2('/utils/configuration/db.php');
             
        parent::__construct(
            $this->config['host'],
            $this->config['username'],
            $this->config['password']
        );

	}
    public function query($sql) {
    	//TODO: SQL INJECTION PROTECTION

    	parent::query($sql);
    }
    public function insert($args) {
        if (!$args || !$args['table'] || !$args['values']) {
            return;
        }
        
        $sql = "INSERT INTO " . $args['table'];

        if ( array_key_exists('fields',$args) ) {
            $sql .= " (" . $args['fields'] . ")";
        }

        $sql .= " VALUES ('{$args['values']}')";
        $this->query($sql);
    }
    public function select($args) {
        if (!$args) {
            return;
        }

        $sql = "SELECT {$args['select']} FROM {$args['table']}";
        $sql .= ( isset($args['where']) ) ? " WHERE {$args['where']}" : "";
        
        return $this->query($sql);
    }
}

?>