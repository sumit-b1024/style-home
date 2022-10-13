<html>
<head></head>
<body>
{{$email_template->salutation}},
<br>
<br>
{!!$email_template->message!!}
<br/>
<a href="{{ url('reset-password-new/'.$model->email_token) }}">Reset Password Link</a>
<br>
<?php echo "If the above button does not work for you, copy and paste the following into your browser's address bar:" ?>
    <br/>
	{{ url('reset-password-new/'.$model->email_token) }}
	<br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

