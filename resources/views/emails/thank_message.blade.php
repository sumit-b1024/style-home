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
<b>Link :   </b>  {{route('frontend.designer.login')}} <br/>
 <b>Name :   </b>  <?=$model->full_name?> <br/>
  <b>Email :   </b> <?=$model->email?> <br/>
  <b>Phone Number :   </b> <?=$model->phone_number?> <br/>
   <b>Password :   </b> <?=$password?> <br/>
   <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y'); ?> <br/>
      
    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

