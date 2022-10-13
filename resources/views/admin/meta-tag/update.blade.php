 @extends('layouts.admin') @section('content')

<div class="animated fadeIn">


	<div class="row"></div>
	<!--/.col-->

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<strong>Meta Tag</strong><small> Update</small>
			</div>
			<div class="card-body card-block">
				@include('admin.meta-tag._form',['path'=>route('admin.metaTag.update.post',['model'=>$model->id]),'model'=>$model])

			</div>
		</div>


	</div>

</div>
@endsection
