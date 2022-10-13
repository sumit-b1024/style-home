<html>
<head></head>
<body>
Hii {{$name}}
<br>
<br>
<p>Thank you for choosing style-a-home to help you with transforming your space. Your payment for the chosen package has been successfully completed.</p>
<p>Please proceed to the <a href="{{ url('project-detail') }}">project page</a> to complete the details needed for your design project.</p>
<br><br>
 <b>Package :   </b>  <?=$model->subscription_title?> <br/>
 
  <b>Amoount :   </b> <?=$amount?> AED<br/>
<?php
if(count($addons_list)>0){
    ?>
    <b>Addons :   </b> <br/>
    
        <?php
        foreach($addons_list as $addons){
        ?>
        <p>{{$addons->title}}</p>
        <?php
        }
        

}
?>
    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

