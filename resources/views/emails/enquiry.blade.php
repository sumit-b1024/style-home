<html>
<head></head>
<body>
{{$email_template_admin->salutation}},
<br>
<br>
{!!$email_template_admin->message!!}

<br><br>
 <b>Name :   </b>  <?=$model->name?> <br/>
 
  <b>Email :   </b> <?=$model->email?> <br/>
  
   
    
     <?php 
   if(!empty($model->subject))
   {
   ?>
   <b>Subject :  </b> <?=$model->subject?>  <br/>
     <?php 
   }
    ?>
	 <?php 
   if(!empty($model->message))
   {
   ?>
   <b>Message :   </b> <?=$model->message?>  <br/>
     <?php 
   }
    ?>
   
  
      
      
    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

