<?php


class DatabaseManager {
   

    public function getChatRoom($user_id, $contact_id) {
        include 'C:\xampp\htdocs\Binary service\config.php';
        $existingRoomQuery =$pdo->prepare("SELECT * FROM chatroom WHERE (user_one = ? AND user_two = ?) OR (user_one = ? AND user_two = ?)");
        $existingRoomQuery->execute([$user_id, $contact_id, $contact_id, $user_id]);
        $existingRoom = $existingRoomQuery->fetch(PDO::FETCH_ASSOC);

        if ($existingRoom) {
            $chatroomId = $existingRoom['c_id']; // Assuming 'c_id' is the chatroom ID column

            // Retrieve messages from conversation_reply table for the specific chatroom
            $messagesQuery = $pdo->prepare("SELECT * FROM conversation_reply WHERE ch_id_fk = ?");
            $messagesQuery->execute([$chatroomId]);
            $messages = $messagesQuery->fetchAll(PDO::FETCH_ASSOC);

            // Prepare and return an object representing the chat room and its messages
            $chatRoomObject = [
                'chatroomId' => $chatroomId,
                'messages' => $messages
            ];

            return $chatRoomObject;
        } else {
            return null; // No existing room found
        }
    }
    public function getUsernameByID($id)
{
    include 'C:\xampp\htdocs\Binary service\config.php';
    
    $name = "Unknown"; // Default value
    
    try {
        $query = "SELECT username FROM Users WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$id]);
        
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($row && isset($row['username'])) {
            $name = $row['username'];
        }
    } catch (PDOException $e) {
        // Handle any database errors here
        // You might log the error or set a default value for $name
        // Example: log the error and set a default value
        error_log('Database error: ' . $e->getMessage());
        $name = "Unknown";
    }
    
    return $name;
}

}


?>