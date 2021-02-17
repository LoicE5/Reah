<?php
require 'assets/vendor/autoload.php';
use Vimeo\Vimeo;

$client_id = "credential";
$client_secret = "credential";
$access_token = "credential";

$vimeo = new Vimeo($client_id, $client_secret, $access_token);

$response = $vimeo->request('/tutorial', array(), 'GET');
// print($response);
// print('Here');

?>
<script src="https://player.vimeo.com/api/player.js"></script>


<!-- <div data-vimeo-id="508788596" data-vimeo-width="500" id="video_1"></div>
<script>
    let video_1_player = new Vimeo.Player('video_1');

    let video_1_div = video_1_player.element;
    let video_1_iframe;
    
    let video_1_interval = setInterval(()=>{

        if(video_1_div.firstChild){

            video_1_iframe = video_1_div.firstChild;

            let doc = video_1_iframe.contentDocument ? video_1_iframe.contentDocument :
        video_1_iframe.contentWindow.document;

        console.log(doc);

        clearInterval(video_1_interval);
        }
    });

</script> -->
