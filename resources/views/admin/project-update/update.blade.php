@extends('layouts.designer')
@section('content')
<?php 
use App\Models\ProductCategoryDocument;
?>
	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Project Update')}}</strong><small> {{__('Form')}}</small> <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.designer.project.update',['project_id'=>$project_id])}}">Back <i class="fa fa-arrow-circle-left"></i></a></div></div>
					<div class="card-body card-block">
					 <form method="post" action="{{route('admin.designer.project.update.post',['model'=>$model])}}" enctype="multipart/form-data">
								@csrf 
								
								<div class="form-group">
								<label for="company" class=" form-control-label">{{__('Date')}}</label>
								<input type="text" id="tbDate" value="{{old('date',optional(@$model)->date)}}" name="date" placeholder="Enter Date" class="form-control" >
								<span class="help-block is-invalid error">{{$errors->first('date')}}</span>
								<script>
									jQuery('#tbDate').datepicker({
									dateFormat: 'yy-mm-dd'
								});
								</script>
								</div>
								
								<div class="form-group">
								<label for="company" class=" form-control-label">{{__('Answer Image')}}</label>
								<input type="file" name="image" class="form-control">
								@if(!empty($model->image))
								<img width="120px" src="{{$model->getProjectUpdateImage()}}"/>
								@endif
								<span class="help-block is-invalid error">{{$errors->first('image')}}</span>
								</div>
								<div class="form-group">
									<label for="company" class=" form-control-label">{{__('Description')}}</label>
									<textarea   name="description" id="default1"  class="form-control">{{old('description',optional(@$model)->description)}}</textarea>
								   
									<span class="help-block is-invalid error">{{$errors->first('description')}}</span>
								</div>
								<div class="form-group">
                                <label for="company" class=" form-control-label">{{__('Status')}}</label>
                                <select class="form-control" name="project_status">
                                    <option value="">---{{__('Select')}}---</option>
                                        <option value="Pending" {{(old('project_status',optional(@$model)->project_status)=='Pending')?'selected':''}}>Pending</option>
                                        <option value="Work in Progress" {{(old('project_status',optional(@$model)->project_status)=='Work in Progress')?'selected':''}}>Work in Progress</option>
                                        <option value="Complete" {{(old('project_status',optional(@$model)->project_status)=='Complete')?'selected':''}}>Complete</option>
                                        
                                </select>
                                
                                <span class="help-block is-invalid error">{{$errors->first('project_status')}}</span>
                            </div>
								<div class="form-actions form-group">
									<button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
								</div>  
						</form>	
					</div>
				</div>
			</div>    
    </div>
	

@endsection