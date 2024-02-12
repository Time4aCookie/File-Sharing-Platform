<!DOCTYPE html>
<html lang = "en">
    <head>
        <title> Home Page</title>
    </head>
    <body>
        <h1> Welcome! </h1>
        <p> This is a simple file sharing website. Upon entering your 
            username, you are able to view, add, and remove your files.
        </p>
        <br><br> 
        <form method = "GET">  
            <fieldset> 
                <label for="username"> Username</label>
                <input type="text" name = "username" id = "username" placeholder="Enter username here" required>
                <input type = "submit" value = "Login">
            </fieldset>
        </form>
        <?php
            if(isset($_GET["username"])){
                $username = htmlspecialchars($_GET["username"]);
                $file = "/home/Rtatikonda11/user_files/users.txt";
                $usernames = file($file, FILE_IGNORE_NEW_LINES);
                if(in_array($username, $usernames)){
                    $encoded_username = urlencode($username);
                    header("Location: users.php?username=$encoded_username");
                    exit();
                }
                else{
                    echo "The username you entered does not exist, please try again";
                }
        }
        ?>
    </body>
</html>
