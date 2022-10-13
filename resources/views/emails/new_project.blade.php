<html>
<head></head>
<body>
{{$email_template->salutation}},
<br>
<br>
{!!$email_template->message!!}

<br><br>
 <b>Project Title :   </b>  <?=$model->title?> <br/>
  <b>Date :   </b> <?php echo $date = date('d-m-Y'); ?> <br/>

    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

