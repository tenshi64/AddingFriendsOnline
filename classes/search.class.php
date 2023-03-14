<?php
    include_once("db.class.php");
    class Search extends Database
    {
        function searchUser($search)
        {
            parent::__construct();
            $stmt = $this->database->prepare("SELECT imie, pseudonim, nazwisko, data_dolaczenia, id FROM users WHERE imie LIKE ? OR nazwisko LIKE ? OR pseudonim LIKE ?");
            $stmt->bind_param("sss", $search, $search, $search);
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
        }
    }
?>