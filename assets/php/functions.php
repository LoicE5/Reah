<?php

class func {

    public static function checkLoginState($db){

        if(!isset($_SESSION)) { # if the session isn't active
            session_start(); # We start the session
        }

        if(isset($_COOKIE['userid']) && isset($_COOKIE['token']) && isset($_COOKIE['serial'])) { # if the session is active

            $query = "SELECT * FROM sessions WHERE sessions_userid = :userid AND sessions_token = :token AND sessions_serial = :serial;";

            $userid = $_COOKIE['userid'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];

            $stmt = $db->prepare($query);
            $stmt->execute(array(':userid' => $userid, ':token' => $token, ':serial' => $serial));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['sessions_userid'] > 0){

                if($row['sessions_userid'] == $_COOKIE['userid'] && 
                $row['sessions_token'] == $_COOKIE['token'] && 
                $row['sessions_serial'] == $_COOKIE['serial']) {

                    if($row['sessions_userid'] == $_SESSION['userid'] && 
                        $row['sessions_token'] == $_SESSION['token'] && 
                        $row['sessions_serial'] == $_SESSION['serial']) {

                        return true;

                    } else {
                        func::createSession($_COOKIE['username'],$_COOKIE['userid'],$_COOKIE['token'],$_COOKIE['serial']);
                        return false;
                    }
                }
            }


        }

    }


    public static function createString($len){
        $string = "1qay2wsx3edc4rnrenjfne7374Bhh3jef7vve667384bdb6dbh";
        
        $s = substr(str_shuffle($string),0,$len);

        return $s;
    }

    public static function createRecord($db, $user_username, $user_id){
        $db->prepare("DELETE FROM sessions WHERE sessions_userid = :sessions_userid;")->execute(array(':sessions_userid'=>$user_id));

        $token = func::createString(32);
        $serial = func::createString(32);

        func::createCookie($user_username, $user_id, $token, $serial);
        func::createSession($user_username, $user_id, $token, $serial);

        $stmt = $db->prepare('INSERT INTO `sessions`(`sessions_userid`, `sessions_token`, `sessions_serial`, `sessions_date`) VALUES (:user_id,:token,:serial,"03/01/2021")');
        $stmt->execute(array(':user_id'=>$user_id, ':token'=>$token, ':serial'=>$serial));
    }

    public static function createCookie($user_username, $user_id, $token, $serial){
        setcookie('userid', $user_id, time() + (86400) * 30, "/");
        setcookie('username', $user_username, time() + (86400) * 30, "/");
        setcookie('token', $token, time() + (86400) * 30, "/");
        setcookie('serial', $serial, time() + (86400) * 30, "/");
    }

    public static function deleteCookie(){
        setcookie('userid', '', time() -1, "/");
        setcookie('username', '', time() -1, "/");
        setcookie('token', '', time() -1, "/");
        setcookie('serial', '', time() -1, "/");
    }


    public static function createSession($user_username, $user_id, $token, $serial){

        if(!isset($_SESSION)){ # If there is no session initiated yet
            session_start();
        }

        $_SESSION['userid'] = $user_id;
        $_SESSION['token'] = $token;
        $_SESSION['serial'] = $serial;
        $_SESSION['username'] = $user_username;
    }

}

function consoleLog($input){
    echo "<script type=\"text/javascript\">";
    if(gettype(json_decode($input)) == "object" || gettype($input) == "object"){
        echo "console.log(JSON.parse('$input'));";
    } else if(gettype($input) != "string") {
        if(gettype($input) == "boolean"){
            if($input){
                echo "console.log(true);";
            } else if(!$input){
                echo "console.log(false);";
            }
        } else if(gettype($input) == "array"){
            echo "console.log(".json_encode($input).");";
        } else {
            echo "console.log($input);";
        }
    } else {
        echo "console.log('$input');";
    }
    echo "</script>";
}

function consoleWarn($input){
    echo "<script type=\"text/javascript\">
        console.warn('$input');
        </script>";
}

function makeVisible($selector,$onload){
    echo "<script>";
    if($onload){
        echo "window.onload = ()=>{";
    }

    echo "
    if(document.querySelector('$selector') == null || document.querySelector('$selector') == undefined){
        console.log('Undefined lol');
    }
    document.querySelector('$selector').style.visibility = 'visible';";

    if($onload){
        echo "}";
    }
    
    echo "</script>";
}

function redirect($url){
    if(gettype($url) == "string"){
        header("location:$url");
    } else {
        consoleLog("Incorrect type of input for redirect. You entered $url which is a ".gettype($url).".");
    }
}

function generateCode(){
    return str_pad(rand(1,999999), 6, '0', STR_PAD_LEFT);
}

function emptyArray(?array $array){
    $error = false;

    foreach($array as $value){

        if(empty($value) && !is_numeric($value)){

            $error = true;
            break;
        }
    }
    return $error;
}

function isNumber(?array $array){

    $isInt = true;

    foreach($array as $value){

        if(!is_numeric($value)){

            $isInt = false;
            break;
        }
    }
    
    return $isInt;
}

function transformToArray($str){
    $array = explode(",",$str);
    return $array;
}

function uploadFile($file,$path){

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.',$fileName);
    $fileLoweredExt = strtolower(end($fileExt));
    $fileExt = $fileLoweredExt;
    
    $allowed = array('jpg','jpeg','png','tiff','pdf','psd','mp4','mov');

    if(in_array($fileExt, $allowed)){
        if($fileError == 0){

            if($fileSize < 500000000 /* 500 MB */){

                $fileNameNew = uniqid('',true).".".$fileExt; // Unused for this case
                $fileDestination = $path.$fileName;

                move_uploaded_file($fileTmpName,$fileDestination);
                echo "success";

            } else {
                echo "FILE TOO HEAVY";
            }
        } else {
            echo "ERROR";
        }
    } else {
        echo "WRONG";
    }
}

?>