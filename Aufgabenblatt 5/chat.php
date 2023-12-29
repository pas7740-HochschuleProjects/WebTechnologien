<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">

    <script defer src="./js/request.js"></script>
    <script defer src="./js/chat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<?php

require("start.php");

if(empty($_SESSION["user"])){
    header("Location: login.php");
} else if(empty($_GET['friend'])){
    header("Location: friends.php");
}



?>

<body class="container">
    <h1 class="mt-2 mb-3" id="heading"></h1>
    <div class="btn-group" role="group">
      <a class="btn btn-secondary mt-0 mb-0"href="friends.php">
      < Back
      </a> 
      <a class="btn btn-secondary mt-0 mb-0" href="profile.php?friend=<?php echo $_GET['friend']; ?>">
      Profile
      </a> 
      <a class="btn btn-danger border-0 mt-0 mb-0">
        <button type="button" class="bg-danger border-0 text-white" data-bs-toggle="modal" data-bs-target="#chatModal">
        Remove Friend
        </button>

        <div class="modal fade" id="chatModal" tabindex="-1">
     <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title fs-5">Remove <?php echo $_GET['friend']; ?> as Friend
             </h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
             </button>
            </div>
         <div class="modal-body">
         <p>Do you really want to end your friendship?</p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary"data-bs-dismiss="modal">
            Cancel
            </button>
            <form class="btn btn-secondary bg-danger border-0" method="post" action="friends.php" id="remove-friend-form">
             <input type="hidden" value="<?php echo $_GET['friend']; ?>" name="friendname" />
             <button class="btn btn-primary" type="submit" name="action"  value="delete-friend" id="remove-friend-button">
             Yes, Please!
             </button>
            </form>
         </div>  
        </div>    
     </div>  
     </div> 

      </a> 
    </div>            
     
     

            <div class="container border border-dark mb-4 mt-4" >
                  <ul class="col align-items-start" id="chatbox" >
                  </ul>  
            </div>

            <div class="input-group mt-0">
                <input class="form-control" id="textsubmit" type="text" placeholder="New Message"/>
                <button class="btn btn-primary" onclick="sendMessage()" >Send</button>
            </div>
</body>

<template id="message-template">
    <li class="d-flex justify-content-between text-break"><text></text><text class="text-end text-nowrap"></text></li>
</template>

</html>