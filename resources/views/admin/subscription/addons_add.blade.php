@extends('layouts.admin')
@section('content')
<style>
.error{
	color:#ff0000;
}
</style>

	<div class="animated fadeIn">
		<div class="row"></div><!--/.col-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>{{__('Subscription Addons')}}</strong><small> {{__('Form')}}</small> <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.subscription.addons',['subscription_id'=>$subscription_id])}}">Back <i class="fa fa-arrow-circle-left"></i></a></div></div>
					<div class="card-body card-block">
					 <form method="post" action="{{route('admin.subscription.addons.add.post',['subscription_id'=>$subscription_id])}}" enctype="multipart/form-data">
								@csrf 
								
                                
								<div class="form-group">
								<label for="company" class=" form-control-label">{{__('Addons Title')}}</label>
								<input type="text" value="{{old('title',optional(@$model)->title)}}" name="title" placeholder="Enter Addons Title" class="form-control" >
								<span class="help-block is-invalid error">{{$errors->first('title')}}</span>
								</div>
								
								<div class="form-group">
								<label for="company" class=" form-control-label">{{__('Addons Price')}}</label>
								<input type="text" value="{{old('price',optional(@$model)->price)}}" name="price" placeholder="Enter Addons Price" class="form-control" >
								<span class="help-block is-invalid error">{{$errors->first('price')}}</span>
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