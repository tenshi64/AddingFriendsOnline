<?php
    include_once("db.class.php");

    if(!isset($_SESSION))
    {
        session_start();
    }

    class LogIn extends Database
    {
        private string $_nickname = "";
        private string $_password = "";

        function __construct($nickname, $password)
        {
            parent::__construct();
            $this->_nickname = $nickname;
            $this->_password = $password;
        } 

        public function checkUser() : bool
        {
            $stmt = $this->database->prepare("SELECT imie, nazwisko, data_dolaczenia, id FROM users WHERE pseudonim=? AND haslo=?");
            $stmt->bind_param("ss", $this->_nickname, $this->_password);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result)
            {
                if($result->num_rows > 0)
                {
                    $row = $result->fetch_row();
                    $_SESSION['imie'] = $row[0];
                    $_SESSION['nazwisko'] = $row[1];
                    $_SESSION['data_dolaczenia'] = $row[2];
                    $_SESSION['id'] = $row[3];
                    $_SESSION['pseudonim'] = $this->_nickname;
                    unset($stmt);
                    return true;
                }
                else
                {
                    unset($stmt);
                    return false;
                }
            }
        } 
    }
?>