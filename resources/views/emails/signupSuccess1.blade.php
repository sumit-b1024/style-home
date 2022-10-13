<html>
<head></head>
<body>
    <?php
    use Carbon\Carbon;
    ?>
{{$email_template_admin->salutation}},
<br>
<br>
{!!$email_template_admin->message!!}

<br><br>
 <b>First Name :   </b>  <?=$model->first_name?> <br/>
 <?php
 if($model->last_name){
 ?>
 <b>Last Name :   </b>  <?=$model->last_name?> <br/>
 <?php
 }
 ?>
  <b>Email :   </b> <?=$model->email?> <br/>
  <?php
  if($model->phone_number){
  ?>
  <b>Phone Number :   </b> <?=$model->phone_number?> <br/>
  <?php
  
  }
  ?>
  <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y'); ?> <br/>
   
      
    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

