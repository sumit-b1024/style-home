<html>
<head></head>
<body>
Dear Admin,
<br>
<br>
<?php
  echo  $name." purchase a following subscription plan:-";

?>

<br><br>
 <b>Subscription :   </b>  <?=$model->subscription_title?> <br/>
 
  <b>Amount :   </b> <?=$amount?> AED<br/>
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

