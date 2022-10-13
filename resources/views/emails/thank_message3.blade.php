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
<b>Title :   </b>  <?=$model->title?> <br/>
 <b>Message :   </b>  <?=$model->message?> <br/>
   <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y'); ?> <br/>

    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

