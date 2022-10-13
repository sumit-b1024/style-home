@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Email Template')}}</strong> 
        
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">{{__('Salutation')}}</th>
						<th scope="col">{{__('Type')}}</th>
                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($models as $model)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
						<td class="align-middle">{{$model->salutation}}</td>
						<td class="align-middle">{{$model->getEmailType()}}</td>
					<td class="align-middle"><a href="{{route('admin.email.template.update',['model'=>$model])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
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