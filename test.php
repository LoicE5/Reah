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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="time"></div>
<script>
    function countdownTimer() {
    const difference = +new Date("2021-05-01") - +new Date();
    console.log(difference)

    let remaining = "Time's up!";
  
    if (difference > 0) {
      const parts = {
        j: Math.floor(difference / (1000 * 60 * 60 * 24)),
        h: Math.floor((difference / (1000 * 60 * 60)) % 24),
        min: Math.floor((difference / 1000 / 60) % 60),
      };
      remaining = Object.keys(parts).map(part => {
      return `${parts[part]}${part}`;
      }).join(" ");
    } else {
        console.log("coucou")

    }
  
    document.getElementById("time").innerHTML = remaining;
  }
  
//   console.log(countDownTimer());
  setInterval(countdownTimer, 1000);
</script>
</body>
</html>