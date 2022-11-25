<?php

namespace Bahman\NoticeBoard\Repositories;

use Bahman\NoticeBoard\Core\Database;

class BaseRepository
{
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function find_this_query(string $sql)
    {
        $result = $this->database->query($sql);
        $object_array = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $object_array[] = $this->instantation($row);
        }

        return $object_array;
    }

    public function instantation($record)
    {
        $object = new static;
        foreach ($record as $attribute => $value) {
            if ($object->has_the_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    public function has_the_attribute($attribute): bool
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }
}