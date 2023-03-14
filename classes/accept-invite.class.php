<?php
    include_once("db.class.php");
    class AcceptInvite extends Database
    {
        function accept($friend_id, $user_id) : bool
        {
            parent::__construct();
            $stmt = $this->database->prepare("SELECT friend_id, user_id FROM your_friends WHERE friend_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $user_id, $friend_id);
            $stmt->execute();

            $result = $stmt->get_result();
            $check = 0;

            if($result)
            {
                if($result->num_rows < 2 && $result->num_rows > 0)
                {
                    $stmt = $this->database->prepare("UPDATE your_friends SET status = 'Accepted' WHERE friend_id = ? AND user_id = ?");
                    $stmt->bind_param("ii", $user_id, $friend_id);
                    $stmt->execute();

                    $stmt = $this->database->prepare("INSERT INTO your_friends(friend_id, user_id, status) VALUES(?, ?, ?)");
                    $status = "Accepted";
                    $stmt->bind_param("iis", $friend_id, $user_id, $status);
                    $stmt->execute();
                    echo "Zaproszenie zostało przyjęte!<hr>";
                    echo "<a href='index.php'>Powrót</a>";
                    return true;
                }
                else
                {
                    echo "Coś poszło nie tak! Prawdopodobnie zaproszenie zostało już przyjęte!<hr>";
                    echo "<a href='index.php'>Powrót</a>";
                    return false;
                }
            }
            return false;
        }
    }
?>