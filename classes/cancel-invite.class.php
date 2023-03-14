<?php
    include_once("db.class.php");

    class CancelInvite extends Database
    {
        public function cancel($user_id, $friend_id) : void
        {
            $stmt = $this->database->prepare("DELETE FROM your_friends WHERE user_id = ? AND friend_id = ? AND status='Waiting'");
            $stmt->bind_param("ii", $user_id, $friend_id);
            $stmt->execute();
        }
    }
?>