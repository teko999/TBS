<?php

class DB
{
    protected $connection;
    public $lastID;

    public function __construct($host, $user, $passwrod, $db_name)
    {
        $this->connection = new mysqli($host, $user, $passwrod, $db_name);

        if(mysqli_connect_error()) {
            throw new Exception( 'cannot connect to DB');
        }
        $this->query("SET NAMES UTF8");
    }

    public function query($sql)
    {
        if(!$this->connection) {
            return false;
        }

        $result = $this->connection->query($sql);

        if(mysqli_error($this->connection)) {
            throw new Exception(mysqli_error($this->connection));
        }
        $this->lastID = $this->connection->insert_id;
        if(is_bool($result)) {
            return $result;
        }

        $data = [];

        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function escape($str)
    {
        return mysqli_real_escape_string($this->connection, $str);
    }
}
