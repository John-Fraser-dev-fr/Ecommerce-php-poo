<?php

namespace Models;


class Admin extends Model
{
    public function showAdmin()
    {
        $q=$this->pdo->query("SELECT * FROM users");
        $q->fetch();

        
     
    }
}