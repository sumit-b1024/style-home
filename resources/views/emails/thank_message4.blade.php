<html>
<head></head>
<body>
    <?php
    use Carbon\Carbon;
    ?>
Hello,
<br>
<br>
<?php
  echo  "Admin changed payment request status with ".$model->request_status." for following request:-";

?>

<br><br>
 <b>Title :   </b>  <?=$model->title?> <br/>
 <b>Message :   </b>  <?=$model->message?> <br/>
  <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y'); ?> <br/>

    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

