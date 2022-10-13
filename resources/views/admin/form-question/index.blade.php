@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Form Question')}}</strong> 
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Question Title')}}</th>
						<th scope="col">{{__('Posted On')}}</th>
                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle">{{$model->title}}</td>
						<td class="align-middle">{{$model->created_at}}</td>
						<td class="align-middle"><a href="{{route('admin.form.question.update',['model'=>$model])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
						<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-sm btn-primary btn-white dropdown-toggle" aria-expanded="false">
							Click
							<!--<i class="ace-icon fa fa-angle-down icon-on-right"></i>-->
						</button>
						<ul class="dropdown-menu" style="left:-70px;">
							
							<li>
								<li><a href="{{route('admin.form.answer',['question_id'=>$model])}}">Form Answer</a></li>
							</li>
						</ul>
					</div>
						</td>
					</tr>


					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $models->links() }}

</div>


@endsection 