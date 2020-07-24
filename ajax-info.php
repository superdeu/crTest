<?php
$time1 = (int)strtotime($_POST["start"]);
$time2 = (int)strtotime($_POST["end"]);

$in = json_decode(file_get_contents("http://{$_SERVER["SERVER_NAME"]}/api.php?start={$time1}&end={$time2}"));


?>
<span><b><?=$in[0]->sfrom?></b> --- <b><?=$in[0]->sto?></b></span>
<br>
<span>Users From FILE <b><?=$in[0]->data->file_st?></b></span>
<br>
<span>Users From Mysql <b><?=$in[0]->data->mysql_st?></b></span>
<br>
<span>Users From GA <b><?=$in[0]->data->google_st?></b></span>
<br>
<span>Users ALL <b><?=$in[0]->data->all_st?></b></span>
<br>
<span>Message:</span>
<br>
<span><b><?=$in[0]->message[0]?></b></span>
<br>
<span><b><?=$in[0]->message[1]?></b></span>
<br>
<span><b><?=$in[0]->message[2]?></b></span>
<br>