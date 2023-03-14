<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    include_once("db.class.php");
    class EditProfile extends Database
    {
        private string $_firstName;
        private string $_lastName;
        private string $_nickname; 
        private string $_password; 
        private string $_re_password;

        function __construct($firstName, $lastName, $nickname, $password, $re_password)
        {
            parent::__construct();

            $this->_firstName = $firstName;
            $this->_lastName = $lastName;
            $this->_nickname = $nickname;
            $this->_password = $password;
            $this->_re_password = $re_password;
        }

        function checkNickname() : bool
        {
            $stmt = $this->database->prepare("SELECT pseudonim FROM users WHERE pseudonim = ?");
            $stmt->bind_param("s", $this->_nickname);
            $stmt->execute();

            $result = $stmt->get_result();
            
            if($result)
            {
                if($result->num_rows > 0)
                {
                    unset($stmt);
                    return false;
                }
                else
                {
                    unset($stmt);
                    return true;
                }
            }
            return true;
            unset($stmt);
        }

        function checkPassword() : bool
        {
            if($this->_password == $this->_re_password)
            {
                if(strlen($this->_password) >= 8)
                {
                    return true;
                }
                else
                {
                    $_SESSION['error3'] = "Hasło musi mieć co najmniej 8 znaków!";
                    return false;
                }
            }
            else
            {   
                $_SESSION['error3'] = "Podane hasła do siebie nie pasują!";
                return false;
            }
        }

        function changeValues() : void
        {
            $stmt = $this->database->prepare("INSERT INTO users(imie, nazwisko, pseudonim, haslo) VALUES(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $this->_firstName, $this->_lastName, $this->_nickname, $this->_password);
            $stmt->execute();

            unset($stmt);
        }
    }
?>