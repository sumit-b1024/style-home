@extends('layouts.designer') 


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
			<strong class="card-title">{{__('Profile')}}</strong> 
			@if(session()->has('success'))
		<div class="alert alert-success" role="alert">{!!session('success')!!}</div>
		@endif
		@if(session()->has('error'))
		<div class="alert alert-danger" role="alert">{!!session('error')!!}</div>
		@endif
		</div>
		<div class="card-body">
		<div class="row">
		

<div class="col-xl-12 order-xl-1">
          <div class="card shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
            
              </div>
            </div>
            <div class="card-body">
              <form method="post" action="{{route('admin.designer.profile.post')}}" enctype="multipart/form-data">
                @csrf
               
                  <div class="row">
                    @if($user->profile_image)
                      <div class="row justify-content-center">
                      <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                          <a href="#">
                            <img src="{{asset("public/uploads/{$user->profile_image}")}}" class="rounded-circle">
                          </a>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">First Name</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="First Name" name="first_name" value="{{old('first_name',optional(@$user)->first_name)}}">
                        
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Last Name</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Last Name" name="last_name" value="{{old('last_name',optional(@$user)->last_name)}}">
                        
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="Email" value="{{old('email',optional(@$user)->email)}}">
                        
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Profile Image</label>
                        <input type="file" name="profile_image" id="input-location" class="form-control form-control-alternative" placeholder="Location" value="{{old('profile_image',optional(@$user)->profile_image)}}">
                        
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Language</label>
                        <select name="language" class="form-control form-control-alternative">
                            <option value="">Select Language</option>
                            <option value="English" {{(old('language',optional(@$user)->language)=="English")?'selected':''}}>English</option>
                            <option value="Arabic" {{(old('language',optional(@$user)->language)=="Arabic")?'selected':''}}>Arabic</option>
                            </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Location</label>
                        <input type="text" name="location" id="input-email" class="form-control form-control-alternative" placeholder="Location" value="{{old('location',optional(@$user)->location)}}">
                        
                      </div>
                    </div>
                  </div>
           
                <hr class="my-4">
                <!-- Address -->
                 <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" name="city" id="input-city" class="form-control form-control-alternative" placeholder="City" value="{{old('city',optional(@$user)->city)}}">
                        
                      </div>
                    </div>
              
			    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Phone Number</label>
                        <input type="text" name="phone_number" id="input-email" class="form-control form-control-alternative" placeholder="Phone Number" value="{{old('phone_number',optional(@$user)->phone_number)}}">
                        
                      </div>
                    </div>
              
                  </div>
				
				
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="input-address" name="address" class="form-control form-control-alternative" placeholder="Home Address" value="{{old('address',optional(@$user)->address)}}" type="text">
                      </div>
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Account Number</label>
                        <input type="text" name="account_number" id="input-email" class="form-control form-control-alternative" placeholder="Account Number" value="{{old('account_number',optional(@$user)->account_number)}}">
                        
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">IFSC Code</label>
                        <input type="text" name="ifsc_code" id="input-email" class="form-control form-control-alternative" placeholder="IFSC Code" value="{{old('ifsc_code',optional(@$user)->ifsc_code)}}">
                        
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Bank Name</label>
                        <input type="text" name="bank_name" id="input-email" class="form-control form-control-alternative" placeholder="Bank Name" value="{{old('bank_name',optional(@$user)->bank_name)}}">
                        
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Branch</label>
                        <input type="text" name="branch" id="input-email" class="form-control form-control-alternative" placeholder="Branch" value="{{old('branch',optional(@$user)->branch)}}">
                        
                      </div>
                    </div>
                  </div>
                 
                <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{__('Submit')}}</button>
    </div>
               
               
              </form>
            </div>
          </div>
        </div>
</div>
		</div>
	</div>
	

</div>


@endsection 