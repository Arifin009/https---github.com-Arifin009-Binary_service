<?php
session_start();
if (empty($_SESSION['email'])) {
    header('location:login.php');
    exit();
} else {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['id'];

    if (isset($_POST['submit'])) {
        $contact_id = $_POST['seller_id'];
        
    }
    else{
        $contact_id = $_GET['chatting_user_id'];
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contactStyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Freelance Chat</title>
</head>
<body>


    <header>
        <div >
            <nav class="fh5co-nav">
                <div class="top-menu">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-2">
                                <div id="fh5co-logo"><a href="index.php">Binary Service </a></div>
                            </div>
                            <div class="col-xs-10 text-right menu-1">
                                <ul>
                                    <li><a href="buyer.php">Home</a></li>
                                    <li class="has-dropdown">
                                        <a href=" #fh5co-features">Services</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Bachlor Rent</a></li>
                                            <li><a href="#">Macanic</a></li>
                                            <li><a href="#">Teacher</a></li>
                                            <li><a href="#">Legal advisor</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="logout.php">logout</a></li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>

    </header>
<?php

include 'databaseManager.php';
$DatabaseManager = new DatabaseManager();
$existingRoom = $DatabaseManager->getChatRoom($user_id, $contact_id);
$contactorName = $DatabaseManager->getUsernameByID($contact_id);


if ($existingRoom) {
    $chatroomId = $existingRoom['chatroomId'];
    $messages = $existingRoom['messages'];// Assuming 'ch_id' is the chatroom ID column

  
    ?>
       <section class="container chat-container">
    <div class="chat-box">
    <div class="titlebar">
      
            <img src="img/icon.JPEG" class="user-picture img-rounded" alt="User Picture" width="30" height="30">
            <span class="username"><?php echo $contactorName?></span>
        </div>
        <div class="messages">
        <?php foreach ($messages as $message): ?>
        <?php if ($message['user_id_fk'] == $user_id): ?>
            <div class="message user-message">
            <?php echo $message['reply']; ?>
            </div>
        <?php else: ?>
            <div class="message contact-message">
 
            <img src="img/icon.JPEG" class="img-rounded message-img" alt="Cinque Terre" width="30" height="30"> <?php echo $message['reply']; ?>
            </div>
        <?php endif;?>
    <?php endforeach;?>
            <!-- End of PHP code for messages -->
        </div>
        <form class="input-box" id="messageForm">
            <textarea id="messageInput" placeholder="Type your message..."></textarea>
            <input type="hidden" name="contact_id" value="<?php echo $contact_id ?>">
            <button type="button" class="msg" id="sendMessage">Send</button>
        </form>
    </div>
</section>

        <?php
} else {
    ?>
        <section class="container chat-container">
            <div class="chat-box">
                <div class="messages">

                        <div class="message">

                        </div>

                </div>
                <form class="input-box" id="messageForm">
    <textarea id="messageInput" placeholder="Type your message..."></textarea>
    <input type="hidden" name="contact_id" value="<?php echo $contact_id ?>">
    <button type="button" class="msg" id="sendMessage">Send</button>
</form>

            </div>
        </section>
        <?php
}
?>
    


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#sendMessage').click(function() {
        var message = $('#messageInput').val();
        var contactId = $('input[name="contact_id"]').val();

        $.ajax({
            type: 'POST',
            url: 'messageProcess.php',
            data: {
                message: message,
                contact_id: contactId
            },
            success: function(response) {
                $('.messages').append(response);
                $('#messageInput').val('');
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Set scroll position to the bottom on page load
    $('.messages').scrollTop($('.messages')[0].scrollHeight);
});





</script>

</body>
</html>