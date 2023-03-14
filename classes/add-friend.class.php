<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    include_once("db.class.php");

    class AddFriend extends Database
    {
        function addFriend($user_id) : bool
        {
            parent::__construct();
            try
            {
                $stmt = $this->database->prepare("SELECT friend_id, user_id FROM your_friends WHERE friend_id = ? AND user_id = ?");
                $stmt->bind_param("ii", $_SESSION['id'], $user_id);
                $stmt->execute();

                $result = $stmt->get_result();
                $check = 0;

                if($result)
                {
                    if(!$result->num_rows > 0)
                    {
                        $check++;
                    }
                }

                $stmt = $this->database->prepare("SELECT friend_id, user_id FROM your_friends WHERE friend_id = ? AND user_id = ?");
                $stmt->bind_param("ii", $user_id, $_SESSION['id']);
                $stmt->execute();

                $result = $stmt->get_result();

                if($result)
                {
                    if(!$result->num_rows > 0)
                    {
                        $check++;
                    }
                }

                if($check == 2)
                {
                    if($user_id != $_SESSION['id'])
                    {
                        $stmt = $this->database->prepare("INSERT INTO your_friends(friend_id, user_id, status) VALUES(?, ?, ?)");
                        $status = "Waiting";
                        $stmt->bind_param("iis", $user_id, $_SESSION['id'], $status);
                        $stmt->execute();
            
                        $result = $stmt->get_result();
                    
                        header("location: view-profile.php?id=" . $user_id);
                        unset($stmt);
                    }
                    else
                    {
                        echo "Nie możesz dodać siebie samego do znajomych!<br>";
                        echo "<a href='view-profile.php?id=" . $user_id . "'>Powrót</a>";
                        unset($stmt);
                        return true;
                    }
                }
                else
                {
                    echo "Coś poszło nie tak! Prawdopodobnie masz już tę osobę w znajomych lub wysłałeś już zaproszenie!<br>";
                    echo "<a href='view-profile.php?id=" . $user_id . "'>Powrót</a>";
                }
                return false;
            }
            catch(Exception)
            {
                echo "Coś poszło nie tak! Prawdopodobnie masz już tę osobę w znajomych lub wysłałeś już zaproszenie!<br>";
                echo "<a href='view-profile.php?id=" . $user_id . "'>Powrót</a>";
                unset($stmt);
                return false;
            }
            unset($stmt);
            return false;
        }
    }
?>