<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="index.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
</head>

<?php 

require("start.php");

if(empty($_SESSION["user"])){
  header("Location: login.php");
}

$response = $service->loadUser($_SESSION["user"]);
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$oneline = $_POST['one-line'];

?>

<body>
    <h1>Profile Settings</h1>

    <form method="post" action="settings.php">
        <fieldset>
            <legend>Base Data</legend>
            <label> <text>First Name</text> <input type="text" placeholder="Your name" name="firstname"/></label>
            <label> <text>Last Name</text> <input type="text" placeholder="Your surname" name="lastname"/></label>
            <label><text>Coffee or Tea?</text>
                <select>
                    <option>Coffee</option>
                    <option>Tea</option>
                    <option>Neither</option>
                </select>
            </label>
        </fieldset>
        <fieldset>
            <legend>Tell Something About You</legend>
            <textarea cols="70" rows="6" placeholder="Leave a comment here"></textarea>
        </fieldset>
        <fieldset>
            <legend>Prefered Chat Layout</legend>
            <label class="radio"> <input type="radio" name="one-line"/> Username and message in one line </label>
            <label class="radio"> <input type="radio" name="one-line"/> Username and message in seperated lines</label>
        </fieldset>
        <button formaction="friends.php">Cancel</button>
        <button>Save</button>
    </form>
</body>

</html>