 
<?php
session_start();
if (empty($_SESSION['email'])) {
    header('location:login.php');
    exit();
} else {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['id'];
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/chatHistory.css">
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
 <div class="chat-container">
    <div class="chat-header">
      <h1>Chat History</h1>
    </div>
    <div class="chat-messages" id="chatMessages">
      <!-- Display chat messages here -->
    </div>
  </div>
    


<script>
  // ... (existing code)

function displayChatMessages() {
  fetch('fetch_chat_history.php') // Change the URL to your PHP file
    .then(response => response.json())
    .then(data => {
      const chatMessagesContainer = document.getElementById('chatMessages');
      data.forEach(chat => {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');


        messageDiv.addEventListener('click', function() {
          // Redirect to contact.php with chat ID or any other identifier
          window.location.href = 'contact.php?chatting_user_id=' + chat.chatting_user_id; // Replace with your logic
        });
        // Create an image element for the icon
        const iconImg = document.createElement('img');
        // Set the image URL or path for the icon
        iconImg.src = 'img/icon.JPEG'; // Replace with your image path
        iconImg.style.height = '25px'; // Adjust the height as needed
        iconImg.style.width = '25px'; 

        const chatting_user_name = document.createElement('span');
        chatting_user_name.classList.add('chatting_user');
        chatting_user_name.textContent = chat.chatting_user_name + ': ';
        
        const lineBreak = document.createElement('br');

        const senderSpan = document.createElement('span');
        senderSpan.classList.add('sender');
        senderSpan.textContent = chat.sender + ': ';

        const messageBodySpan = document.createElement('span');
        messageBodySpan.classList.add('message-body');
        messageBodySpan.textContent = chat.message;

        messageDiv.appendChild(iconImg);
        messageDiv.appendChild(iconImg);
        messageDiv.appendChild(chatting_user_name);
        messageDiv.appendChild(lineBreak); // Append the image to the message
        messageDiv.appendChild(senderSpan);
        messageDiv.appendChild(messageBodySpan);
        chatMessagesContainer.appendChild(messageDiv);
      });
    })
    .catch(error => {
      console.error('Error fetching chat data:', error);
    });
}

// Display chat messages when the page loads
window.onload = displayChatMessages;


</script>

</body>
</html>