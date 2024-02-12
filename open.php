<?php
if(isset($_POST["open"])){
            $fileToOpen = $_POST["open"];
            $directory = $_POST["directory"];
            $filePath = $directory . "/" . $fileToOpen;
            if (file_exists($filePath)) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($filePath);
                // Finally, set the Content-Type header to the MIME type of the file, and display the file.
            header("Content-Type: ".$mime);
            header('Content-Disposition: inline; filename="'.$fileToOpen.'";');
            readfile($filePath);
            exit;
            }
            else{
                echo "This file does not exist";
            }
        }
?>