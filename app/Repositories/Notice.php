<?php

namespace Bahman\NoticeBoard\Repositories;

class Notice extends BaseRepository
{
    protected $db_table = "notices";
    public $id;
    public $title;
    public $content;
    public $time;
    public $name;
    public $user_id;
    
    public function all()
    {
        return $this->find_this_query(
            'SELECT notices.*, users.name FROM `notices`  INNER JOIN users ON user_id = users.Id'
        );
    }

    public function findOrFail($notice_id)
    {
        $sql = "SELECT notices.*, users.name FROM `notices`";
        $sql .= "INNER JOIN users ON user_id = users.id ";
        $sql .= "WHERE notices.id = $notice_id ";
        $sql .= "LIMIT 1";
        $result = $this->find_this_query($sql);

        if (empty($result)) {
            throw new \Exception("Notice Not Found");
        }

        return array_shift($result);
    }

    public function create()
    {
        $sql = "INSERT INTO " . $this->db_table . " (title,content,user_id)";
        $sql .= "VALUES('";
        $sql .= $this->database->escape_string($this->title) . "','";
        $sql .= $this->database->escape_string($this->content) . "','";
        $sql .= $this->database->escape_string($this->user_id) . "')";

        if ($this->database->query($sql)) {
            $this->id = $this->database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $sql = "UPDATE " . $this->db_table . "  SET ";
        $sql .= "title= '" . $this->database->escape_string($this->title) . "',";
        $sql .= "content= '" . $this->database->escape_string($this->content) . "',";
        $sql .= "user_id= '" . $this->database->escape_string($this->user_id) . "'";
        $sql .= " WHERE id= " . $this->database->escape_string($this->id);

        $this->database->query($sql);

        return mysqli_affected_rows($this->database->connection) == 1;
    }

    public function delete()
    {
        $sql = "DELETE FROM " . $this->db_table . "  ";
        $sql .= " WHERE id= " . $this->database->escape_string($this->id);
        $sql .= " LIMIT 1 ";

        $this->database->query($sql);

        return mysqli_affected_rows($this->database->connection) == 1;
    }

}