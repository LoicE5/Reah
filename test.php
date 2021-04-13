<?php 
require_once('assets/getid3/getid3.php');
// phpinfo();
    
    if(isset($_POST['btn'])){
        echo  $_FILES["video"]['tmp_name'];
        echo  $_FILES["video"]['error'];
        $name =  $_FILES["video"]['tmp_name'];

        $filename= $name;
        $getID3 = new getID3;
        $file = $getID3->analyze($filename);
        echo("Duration: 00:".$file['playtime_string'].
        " / Dimensions: ".$file['video']['resolution_x']." wide by ".$file['video']['resolution_y']." tall".
        " / Filesize: ".$file['filesize']." bytes<br />");

    }
    ?>


<form action="" method="POST" enctype="multipart/form-data">
<input type="file" name="video" id="">
<input type="submit" name='btn' value="envoyer">

</form>