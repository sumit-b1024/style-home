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
<b>Link :   </b>  {{route('frontend.login')}} <br/>
 <b>First Name :   </b>  <?=$model->first_name?> <br/>
 <?php
 if($model->last_name){
 ?>
 <b>Last Name :   </b>  <?=$model->last_name?> <br/>
 <?php
 }
 ?>
  <b>Email :   </b> <?=$model->email?> <br/>
   {{-- <b>Password :   </b> <?=$password?> <br/> --}}
   <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y'); ?> <br/>

    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

