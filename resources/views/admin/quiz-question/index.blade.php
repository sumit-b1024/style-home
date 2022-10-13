@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Quiz Question')}}</strong> 
            <div class="pull-right"><a class="btn btn-success" href="{{route('admin.quiz.question.add')}}">Add <i class="fa fa-plus"></i></a></div>
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
						<td class="align-middle"><a href="{{route('admin.quiz.question.update',['model'=>$model])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a href="{{route('admin.quiz.question.delete',['model'=>$model->id])}}" class="btn btn-danger" onclick="return confirm('Are You Sure to Delete');"><i class="fa fa-trash"></i></a>
						<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-sm btn-info btn-white dropdown-toggle" aria-expanded="false">
							Click
							<!--<i class="ace-icon fa fa-angle-down icon-on-right"></i>-->
						</button>
						<ul class="dropdown-menu" style="left:-70px;">
							
							<li>
								<li><a href="{{route('admin.quiz.answer',['question_id'=>$model])}}">Quiz Answer</a></li>
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