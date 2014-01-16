<?php

class db extends mysqli {
    protected $config;
    private $connection;

    public function __construct() {
        $this->config = getConfig('db');             
    }
    private function setup() {
        $this->connection = parent::__construct(
            $this->config['host'],
            $this->config['username'],
            $this->config['password'],
            $this->config['db_name']
        );        
    }
    public function dropUsers() {
        $this->delete(array(
            'table' => 'user'
        ));
    }
    public function query($sql) {
        //TODO: SQL INJECTION PROTECTION
        if (!$this->connection) {
            $this->setup();
        }
        return parent::query($sql);
    }
    public function insert($args) {
        if (!$args || !$args['table'] || !$args['values']) {
            return;
        }
        
        $sql = "INSERT INTO " . $args['table'];

        if ( array_key_exists('fields',$args) ) {
            $sql .= " (" . $args['fields'] . ")";
        }

        $sql .= " VALUES ({$args['values']})";
        return $this->query($sql);
    }
    public function select($args) {
        if (!$args) {
            return;
        }

        $sql = "SELECT {$args['select']} FROM {$args['table']}";
        $sql .= ( isset($args['where']) ) ? " WHERE {$args['where']}" : "";
        return $this->query($sql);
    }
    public function delete($args) {
        if (!$args || !$args['table']) { return; }

        $sql = "DELETE FROM {$args['table']}";

        return $this->query($sql);
    }
}

?>