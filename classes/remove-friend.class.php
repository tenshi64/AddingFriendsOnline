<?php
    include_once("db.class.php");

    class RemoveFriend extends Database
    {
        public function remove($user_id, $friend_id) : bool
        {
            $stmt = $this->database->prepare("DELETE FROM your_friends WHERE user_id = ? AND friend_id = ?");
            $stmt->bind_param("ii", $user_id, $friend_id);
            $stmt->execute();

            $result = $stmt->get_result();

            $stmt = $this->database->prepare("DELETE FROM your_friends WHERE user_id = ? AND friend_id = ?");
            $stmt->bind_param("ii", $friend_id, $user_id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result)
            {
                unset($stmt);
                return true;
            }
            unset($stmt);
            return false;
        }
    }
?>