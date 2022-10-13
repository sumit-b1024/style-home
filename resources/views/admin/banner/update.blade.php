 @extends('layouts.admin') @section('content')

<div class="animated fadeIn">


	<div class="row"></div>
	<!--/.col-->

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong>Banner</strong><small> Update</small>
			</div>
			<div class="card-body card-block">
				@include('admin.banner._form',['path'=>route('admin.banner.update.post',['model'=>$model->id]),'model'=>$model])

			</div>
		</div>


	</div>

</div>
@endsection
