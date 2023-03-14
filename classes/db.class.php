<?php
    abstract class Database
    {
        protected $database;
        function __construct()
        {
            $db = new mysqli("localhost", "root", "", "projekt");
            if(!mysqli_errno($db))
            {
                $this->database = $db;
            }
            else
            {
                echo "Ups, coś poszło nie tak!";
            }
        }

        function __destruct()
        {
            $this->database->close();
        }
    }
?>