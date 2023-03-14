<?php
    include_once("db.class.php");
    class GetInfo extends Database
    {
        function __construct()
        {
            parent::__construct();
        }
        
        function getInfo($id) : object
        {
            $stmt = $this->database->prepare("SELECT imie, pseudonim, nazwisko, data_dolaczenia FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            
            if($result)
            {
                if($result->num_rows > 0)
                {
                    unset($stmt);
                    return $result;
                }
                else
                {
                    unset($stmt);
                    return null;
                }
            }
            unset($stmt);
            return false;
        }

        function checkIfInvited($user_id, $friend_id) : bool
        {
            $stmt = $this->database->prepare("SELECT user_id, friend_id FROM your_friends WHERE status = 'Waiting' AND user_id = ? AND friend_id = ?");
            $stmt->bind_param("ii", $user_id, $friend_id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result)
            {
                if($result->num_rows > 0)
                {         
                    return true;
                }
                else
                {
                    return false;
                }
            }
            return true;
        }
    }
?>