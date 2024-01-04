<?php
// Check if the form is submitted and the required fields are present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_id']) && isset($_POST['message'])) {
    session_start();
    $contactId = $_POST['contact_id'];
    $message = $_POST['message'];
    $userId = $_SESSION['id'];
    $currentDateTime = date("Y-m-d H:i:s");
    
    include 'C:\xampp\htdocs\Binary service\config.php';

    $existingRoomQuery = $pdo->prepare("SELECT * FROM chatroom WHERE (user_one = ? AND user_two = ?) OR (user_one = ? AND user_two = ?)");
    $existingRoomQuery->execute([$userId, $contactId, $contactId, $userId]);
    $existingRoom = $existingRoomQuery->fetch(PDO::FETCH_ASSOC);

    if (!$existingRoom) {
        // If the chatroom doesn't exist, insert a new record into the chatroom table
        $statement = $pdo->prepare("INSERT INTO chatroom (user_one, user_two, time) VALUES (?, ?, ?)");
        $statement->execute([$userId, $contactId, $currentDateTime]);
        $chatroomId = $pdo->lastInsertId();
    }
    else{
        
            // If the chatroom already exists, use its ID
            $chatroomId = $existingRoom['c_id'];
       
    }

    $insertMessageQuery = $pdo->prepare("INSERT INTO conversation_reply (reply, user_id_fk, time, ch_id_fk) VALUES (?, ?, ?, ?)");
    $insertMessageQuery->execute([$message, $userId, $currentDateTime, $chatroomId]);

    $response = "<div class='message'> $message</div>";
    echo $response;


} else {
    // Handle the case where required fields are missing or the request method is not POST
    http_response_code(400); // Bad request
    echo "Invalid request. Missing fields.";
}
?>
