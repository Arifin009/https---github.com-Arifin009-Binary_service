<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="css/profile.css">
</head>
<body>
  <div class="profile">
  
    <div class="profile-picture">
      <div class="profile-picture-container">
        <img src="img/icon.jpeg" alt="Profile Picture" id="profile-pic">
        <div class="name">default name</div>
      </div>
  
    </div>

    <div class="profile-details">
      <h2>Edit Profile</h2>
      <form id="profile-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Save">
      </form>
    </div>
  </div>
  <script>
var profile = document.getElementById('profile-pic');
profile.addEventListener("click", myFunction);

function myFunction() {
    var fileInput = document.createElement('input');
  fileInput.type = 'file';

  // Trigger click event on the file input
  fileInput.click();
  fileInput.addEventListener('change',function(event){
    var selectedFile = event.target.files[0];
    if (selectedFile) {
      console.log('File selected:', selectedFile);
      // Here you can perform operations with the selected file
    }

  });
}
  </script>
</body>
</html>
