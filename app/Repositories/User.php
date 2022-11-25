<?php

namespace Bahman\NoticeBoard\Repositories;

class User extends BaseRepository
{
    protected $db_table = "users";
    public $id;
    public $name;

    public function all()
    {
        return $this->find_this_query(
            'SELECT * FROM `users`'
        );
    }
}