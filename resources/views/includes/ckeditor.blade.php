

<script type="text/javascript">

 

  var editor=  CKEDITOR.replace( '@if(isset($ckFieldName)){{$ckFieldName}}@else{{'html'}}@endif',{
    	 filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
         filebrowserUploadMethod: 'form'
        }
     );
  
</script>
 