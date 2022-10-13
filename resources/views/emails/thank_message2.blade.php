<html>
<head></head>
<body>
    <?php
    use Carbon\Carbon;
    ?>
{{$email_template->salutation}},
<br>
<br>
{!!$email_template->message!!}
	
<br><br>
<b>Email :   </b>  <?=$model->email?> <br/>
 <b>Message :   </b>  <?=$model->message?> <br/>
   <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y'); ?> <br/>
      
    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

