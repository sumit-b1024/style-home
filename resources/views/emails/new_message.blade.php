<html>
<head></head>
<body>
    <?php
    use Carbon\Carbon;
    ?>
Hi {{$name1}},
<br>
<br>
<?php
  echo  "You just received a message from your designer: ".$name;

?>

<br><br>
<a target='_blank' href="{{asset("public/uploads/{$file->path}")}}">{{$file->title}} <i class='fa fa-download'></i>Message</a><br/>
<b>Reply to chat :   </b> {{route('frontend.home')}} <br/>
 
  <b>Date :   </b> <?php echo $date = Carbon::now()->tz('Asia/Dubai')->format('d-m-Y H:i:a'); ?> <br/>

    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

