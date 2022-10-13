 @extends('layouts.admin') @section('content')

<div class="animated fadeIn">


	<div class="row"></div>
	<!--/.col-->

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong>Page Title</strong><small> Update</small>
			</div>
			<div class="card-body card-block">
				@include('admin.page-title._form',['path'=>route('admin.page.title.update.post',['model'=>$model->id]),'model'=>$model])

			</div>
		</div>


	</div>

</div>
@endsection
