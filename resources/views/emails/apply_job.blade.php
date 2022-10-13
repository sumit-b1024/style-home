<html>
<head></head>
<body>
{{$email_template_admin->salutation}},
<br>
<br>
{!!$email_template_admin->message!!}

<br><br>
<b>Job Name :   </b>  <?=$job_detail->name?> <br/>
<b>First Name :   </b>  <?=$model->first_name?> <br/>
<b>Last Name :   </b>  <?=$model->last_name?> <br/>
<b>Email Name :   </b>  <?=$model->email?> <br/>
<b>Phone Number :   </b>  <?=$model->phone_number?> <br/>
@if($model->cv)
<b>CV :   </b>  <a target="_blank" href="{{asset("public/uploads/cv/{$model->cv}")}}" style="background: #2cd4d9;" class ="browse_bt"><span>View CV</span></a> <br/>
@endif
							  
    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

