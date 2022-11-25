<?php

namespace Bahman\NoticeBoard\Core;

use mysqli;

require_once("config.php");

class Database
{
    public $connection;

    function __construct()
    {
        $this->open_db_connection();
    }

    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($this->connection->connect_error) {
            die("ERROR: Could not connect. " . $this->connection->connect_error);
        }
    }

    public function query(string $sql)
    {
        $result = $this->connection->query($sql, MYSQLI_ASSOC);
        $this->confirm_query($result);

        return $result;
    }

    private function confirm_query($result)
    {
        if ($result) {
            return;
        }
        die("Query Failed" . $this->connection->error);
    }

    public function escape_string(?string $string)
    {
        return $this->connection->real_escape_string($string);
    }

    public function insert_id()
    {
        return $this->connection->insert_id;
    }

}

