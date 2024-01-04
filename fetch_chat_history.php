<?php
include 'C:\xampp\htdocs\Binary service\config.php';
include 'databaseManager.php';
session_start();
$Current_user_id = $_SESSION['id'];
$DatabaseManager = new DatabaseManager();

// Fetch chatroom IDs where the current user is involved
$sql_chatroom = $pdo->prepare("
    SELECT *
    FROM chatroom
    WHERE user_one = ? OR user_two = ?
");
$sql_chatroom->execute([$Current_user_id, $Current_user_id]);
$result_chatroom = $sql_chatroom->fetchAll(PDO::FETCH_ASSOC);

$chatData = array();

foreach ($result_chatroom as $row_ch_room) {
    $chatroom_id = $row_ch_room['c_id'];
    $other_user_id = ($row_ch_room['user_one'] == $Current_user_id) ? $row_ch_room['user_two'] : $row_ch_room['user_one'];
    // Retrieve the last message for each chatroom
    $sql_last_message = $pdo->prepare("
        SELECT cr_id, reply, user_id_fk
        FROM conversation_reply
        WHERE ch_id_fk = ?
        ORDER BY cr_id DESC
        LIMIT 1
    ");
    $sql_last_message->execute([$chatroom_id]);
    $last_message = $sql_last_message->fetch(PDO::FETCH_ASSOC);

    if ($last_message) {
            $Current_user_id = $_SESSION['id'];
            if($last_message['user_id_fk']==$Current_user_id)
            {
                $senderName="you";
            }
            else{
                $senderName = $DatabaseManager->getUsernameByID($last_message['user_id_fk']);
            }
            $chatting_user_name = $DatabaseManager->getUsernameByID($other_user_id);

        $chatData[] = array(
            'chatroomId' => $chatroom_id,
            'sender' => $senderName,
            'chatting_user_id' => $other_user_id,
            'chatting_user_name' => $chatting_user_name,
            'message' => $last_message['reply'],
            'lastMessageId' => $last_message['cr_id']
        );
    }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($chatData);
?>
