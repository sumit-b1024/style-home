@extends('layouts.designer') 


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Support Email')}}</strong> 
			@if(session()->has('success'))
					<div class="alert alert-success" role="alert">{!!session('success')!!}</div>
					@endif
					@if(session()->has('error'))
					<div class="alert alert-danger" role="alert">{!!session('error')!!}</div>
					@endif
		</div>
		<div class="card-body">
			<div class="row">
                    <div class="col-lg-12">
                    <form method="post" action="{{route('admin.designer.support.email.post')}}" enctype="multipart/form-data">
								@csrf 
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-email">Support Email</label>
                        <input type="email" name="email" id="input-username" class="form-control form-control-alternative" placeholder="Email" value="{{$setting->admin_email}}" readonly>
                        <span class="help-block is-invalid">{{$errors->first('email')}}</span>
                      </div>
                      <div class=" form-group">
                        <label for="textarea-input" class=" form-control-label">{{__('Message')}}</label>
                        <div><textarea name="message" id="default1" rows="9"   class="form-control">{{old('message',optional(@$model)->message)}}</textarea></div>
                
                        <span class="help-block is-invalid">{{$errors->first('message')}}</span>
                
                    </div>
                      <div class="form-actions form-group">
									<button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
								</div>  
						</form>	
						@section("additional_scripts")

 @include("includes/ckeditor_new")

@endsection
                    </div>
                  
                  </div>

		</div>
	</div>
	

</div>


@endsection 