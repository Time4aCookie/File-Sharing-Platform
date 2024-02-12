<?php
session_start();
?>
<!DOCTYPE html>
<html lang = 'en'>
    <head>
        <title>File Sharer</title>
    </head>
<body>
<?php
if(isset($_POST['logout'])){
    session_destroy();
}
if(!empty($_GET['username'])){
    $username = $_GET['username'];
    $_SESSION['username'] = $username;
}
$tempUse = $_SESSION['username'];
echo "<strong> $tempUse's Files <br><br></strong>";
if(isset($_SESSION['username'])){
    $directory = "/home/Rtatikonda11/user_files/$tempUse";

    foreach(glob($directory . "/*") as $file){
        if(is_file($file)){
            $firstSub = substr($file, 30);
            $userLen = strlen($_SESSION['username']);
            echo substr($firstSub, $userLen+1) . "<br>";
        }
    }
}
?>
<br><br>
<link rel="stylesheet" type="text/css" href="usersCss.css">
<fieldset>
    <form action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"method= "POST" enctype="multipart/form-data">   
    <label for="upload">Choose files to upload</label>
    <input type = "file" id = "upload" name = "upload" required/><br>
    <input type = "submit" value = "Upload"/>
    </form>
</fieldset>
    <br>
<fieldset>
    <form action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?> "method = "POST">
    <label for = "remove"> Type file name for removal </label>
    <input type = "text" id = "remove" name = "remove" required/>
    <input type = "submit" value = "Remove File"/>
    </form>
</fieldset>
    <br>
<fieldset>
    <form action = "open.php"method = "POST">
    <label for = "open"> Enter a file name to open </label>
    <input type = "hidden" name = "directory" value = "<?php echo $directory; ?>" />
    <input type = "text" id = "open" name = "open" required/>
    <input type = "submit" value = "Open"/>
    </form>
</fieldset>
    <br>
<fieldset>
    <form action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?> "method = "POST">
    <label for = "shareUser">Share to User:</label>
    <input type = "text" id = "shareUser" name = "shareUser"/>
    <label for = "shareFile">File to Share:</label>
    <input type = "text" id = "shareFile" name = "shareFile"/>
    <input type = "submit" value = "Share"/>
    </form>
</fieldset>
    <br>
    <form action = "homePage.php">
    <button type = "submit" name = "logout"> Logout</button>
    </form>
    <br><br><br>



    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_FILES["upload"]) && $_FILES["upload"]["error"] == UPLOAD_ERR_OK){
            
            $target_dir = "/home/Rtatikonda11/user_files/";
            $target_dir .= $_SESSION['username'] . "/";
            $target_filePath = $target_dir . basename($_FILES["upload"]["name"]);

            if(!file_exists($target_filePath)){
                move_uploaded_file($_FILES["upload"]["tmp_name"], $target_filePath);
                echo nl2br($_FILE['upload']);
                echo "Your file was uploaded!";
                header("Refresh:0");
            }
            else{
                echo "The file you are trying to upload already exists";
            }
        }
        else{
            echo "No file uploaded" . "<br>";
        }

        if(isset($_POST['remove'])){
            $remFile = $_POST['remove'];
            $remDir = $directory . '/' . $remFile;

            $removed = 0; 
            $_SESSION["removed"];
            foreach(glob($directory . '/*') as $file){
                if($file == $remDir){
                    if(is_file($file)){
                        unlink($file);
                        $_SESSION["removed"] = 1;
                        header("Refresh:0");
                    }
                    else{
                        echo "Couldn't remove <br>";
                    }
                }
            }
            if($_SESSION['removed'] ==0){
                echo "File could not be found...";
            }
            else{
                echo "FIle successfully removed";
            }
        }
    }
   if(isset($_POST['shareUser'])){
    if(isset($_POST['shareFile'])){
        $shareUser = htmlspecialchars($_POST['shareUser']);
        $userFile = "/home/Rtatikonda11/user_files/users.txt";
        $usernames = file($userFile, FILE_IGNORE_NEW_LINES);
        if(in_array($shareUser, $usernames) && $shareUser != $_SESSION['username']){
            $bareFile = htmlspecialchars($_POST['shareFile']);
            $shareFile = $directory . '/' . htmlspecialchars($_POST['shareFile']);
            foreach(glob($directory . '/*') as $file){
                if($shareFile == $file){
                    $shareDest = "/home/Rtatikonda11/user_files/$shareUser/$bareFile";
                    copy($shareFile, $shareDest);
                    echo "$bareFile successfully shared with $shareUser.";
                }
            }
        }
        else{
            echo "You have not specified a valid User.";
        }
    }
    else{
        echo "You need to specify a file to share.";
    }

   }
   else{
    if(isset($_POST['shareFile'])){
        echo "You need to specify a user to share to.";
    }
   } 
?>
</body>
</html>
