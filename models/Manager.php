<?php

class Manager {

    protected $db = null;

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    protected function dbConnect()
    {
        try
        {
            return new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
            
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}