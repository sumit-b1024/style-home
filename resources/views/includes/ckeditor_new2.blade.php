

<script type="text/javascript">

 

  var editor=  CKEDITOR.replace( '@if(isset($ckFieldId)){{$ckFieldId}}@else{{'default2'}}@endif',{
    	 filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
         filebrowserUploadMethod: 'form'
        }
     );
  
</script>
 