@extends('layouts.designer') 

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>
#img{
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-top: 10px;
  box-shadow: inherit;
 
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Bio')}}</strong> 
		</div>
		<div class="card-body">
		 <div class="row">
		<div class="col-sm-12">
  		@if(session()->has('success'))
    	<div class="alert alert-success" role="alert">{!!session('success')!!}</div>
    	@endif
    	@if(session()->has('error'))
    	<div class="alert alert-danger" role="alert">{!!session('error')!!}</div>
    	@endif
    	@if ($errors->any())
             @foreach ($errors->all() as $error)
                 <div style="color:#ff0000;">{{$error}}</div>
             @endforeach
         @endif
          <div class="card-profile">
           @if($model->profile_image)
			  <p class="card-text"><img class="card-img-top" id="img" src="{{asset("public/uploads/{$model->profile_image}")}}" alt="User Profile"></p>
			  @endif
            <div class="card-body pt-0 pt-md-4">
            <form method="post" action="{{route('admin.designer.bio.post')}}" enctype="multipart/form-data">
				@csrf
              <div class="row">
              
                    <div class="col-lg-12">
					<div class="form-group">
					<label for="company" class=" form-control-label">{{__('Bio Type')}}</label><br/>
					@if(count($quiz_categoryies)>0)
					<?php
					if(@$model->bio_type){
					    @$models = explode(",",$model->bio_type);
					}
					else{
					    @$models = [];
					}
					?>
					@foreach($quiz_categoryies as $quiz_categoryies)
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="bio_type[]" value="{{$quiz_categoryies->id}}" @if(in_array($quiz_categoryies->id,@$models)) checked @endif>
						<label class="form-check-label" for="inlineCheckbox1">{{$quiz_categoryies->title}}</label>
					</div>
					@endforeach
					@endif
					
					</div>
					<span class="help-block is-invalid text-danger">{{$errors->first('bio_type.0')}}</span>
					</div>

					<div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="project-sample" style="width:100%;">Description</label>
                      <textarea rows="4" name="description" class="form-control form-control-alternative" placeholder="A few words about you ...">{{$model->description}}</textarea>
                      <span class="help-block is-invalid text-danger">{{$errors->first('description')}}</span>
                      </div>
                    </div>
                    <!--Image-->
                    <div class="col-lg-12">
					 
                        <label class="form-control-label" for="project-sample" style="width:100%;">Recent Work Pictures</label>
                        <div class="form-actions form-group">
    					<div class="input-group control-group increment" >
						<div class="row">
    					<div class="col-md-5">
    					  <input type="file" name="filename[]" class="form-control">
    					  </div>
    					  <div class="col-md-5">
    					  <input type="text" name="title[]" class="form-control" placeholder="Title">
    					  </div>
    					  <div class="col-md-2">
    					  <div class="input-group-btn"> 
    						<button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
    					  </div>
    					  </div>
    					
						</div>
						</div>
    					<div class="clone hide">
    					  <div class="control-group input-group" style="margin-top:10px">
						  <div class="row">
    					  <div class="col-md-5">
    						<input type="file" name="filename[]" class="form-control">
    						</div>
    						<div class="col-md-5">
    					  <input type="text" name="title[]" class="form-control" placeholder="Title">
    					  </div>
    						<div class="col-md-2">
    						<div class="input-group-btn"> 
    						  <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
    						</div>
    						</div>
    					  </div>

						</div>
    					</div>
    					</div>
                        </div>
                    <!--Image-->
                    <div class="col-lg-12"><div class="form-actions form-group">
											<button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
										</div></div>
              </div>
              </form>
             
            </div>
            <!--Recent Work-->
            @if(count($designer_images)>0)
        	<table class="project_details1"><tr>
            
            <td><table class="details_table">
                
                <tr><td><b>Pictures of the Recent Work</b></td><td>
                    <div class="details_img">
                        
                            @foreach($designer_images as $designer_image)
                            <div class=" block_img"><a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img src="{{$designer_image->getDesignerImage()}}" alt="..."></a>
							
							<a class="clos cancel-rule1" href="{{route('admin.designer.image.delete',['model'=>$designer_image->id])}}" >
							<span class="icon_close"><i class="fa fa-times-circle" aria-hidden="true"></i></span></a>
                            </div>
                            @endforeach
                           
                            <div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"><div class="modal-dialog"><button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button><div class="modal-content"><div class="modal-body"><img src="" alt="" /></div></div></div></div>
							</div></td></tr>
            @endif
        </table></td></tr></table>
        <!--Recent Work-->
          </div>
    	</div>
					   
					   
					   </div>	

		</div>
	</div>
	

</div>

<script type="text/javascript">
		$(document).ready(function() {
		  $(".btn-success").click(function(){ 
			  var html = $(".clone").html();
			  $(".increment").after(html);
		  });
		  $("body").on("click",".btn-danger",function(){ 
			  $(this).parents(".control-group").remove();
		  });
		});
		</script>
		
		
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>

$(document).ready(function() {

    var $lightbox = $('#lightbox');

$('[data-target="#lightbox"]').on('click', function(event) {var $img = $(this).find('img'),             src = $img.attr('src'),            alt = $img.attr('alt'),            css = {                'maxWidth': $(window).width() - 100,                'maxHeight': $(window).height() - 100            };            $lightbox.find('.close').addClass('');        $lightbox.find('img').attr('src', src);        $lightbox.find('img').attr('alt', alt);        $lightbox.find('img').css(css);    });        $lightbox.on('shown.bs.modal', function (e) {        var $img = $lightbox.find('img');                    $lightbox.find('.modal-dialog').css({'width': $img.width()});        $lightbox.find('.close').removeClass('');

    

});

});

</script>		
		
@endsection 