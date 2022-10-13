<html>
<head></head>
<body>
<?php
    use Carbon\Carbon;
    ?>
Hi {{$name1}},
<br>
<br>
<?php
  echo  "You just received a message from your designer: ".$name;

?>

<br><br>
<b>Message  :   </b>  <?=$model->message?> <br/>    
<b>Reply to chat :   </b> {{route('frontend.home')}} <br/>
 
  <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y H:i:a'); ?> <br/>

    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

