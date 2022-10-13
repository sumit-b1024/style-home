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
  echo  "Designer ".$name." send you a email:-";

?>

<br><br>
 <b>Message :   </b>  <?=$model->message?> <br/>
  <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y'); ?> <br/>

    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

