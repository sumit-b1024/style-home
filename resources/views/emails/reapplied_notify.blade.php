<html>
<head></head>
<body>
    <?php
    use Carbon\Carbon;
    ?>
Hello,
<br>
<br>
<?php
 // echo  "Designer ".$name." send you a payment request:-";
echo "A project has been reassigned to you from another designer. Please access the details of the project from the below link:"
?>
<br/>
<a href="{{route('admin.designer.project.view',['project_id'=>$projectDetail->id])}}">{{route('admin.designer.project.view',['project_id'=>$projectDetail->id])}}</a>
 <br/>

Thanks,<br>
style-a-home
</body>
</html>

