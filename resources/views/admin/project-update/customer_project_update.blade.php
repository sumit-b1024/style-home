@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">{{__('Project Update')}}</strong>
            <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.customer.project')}}">Back <i class="fa fa-arrow-circle-left"></i></a></div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Date')}}</th>
                        <th scope="col">{{__('Image')}}</th>
                        <th scope="col">{{__('Project Status')}}</th>
                        
                    </tr>
                </thead>
                <tbody>
					@if(count($models)>0)
                    @foreach($models as $model)
                    <tr>
                        <th class="align-middle" scope="row">{{$loop->iteration}}</th>
                        <td class="align-middle">{{$model->date}}</td>
                        <td class="align-middle"><img src ="{{$model->getProjectUpdateImage()}}" width="82px;"></td>
                        <td class="align-middle">{{$model->project_status}}</td>
                    

                    </tr>
                    @endforeach
					@endif
                </tbody>
            </table>

        </div>
    </div>
    {{ $models->links() }}

</div>


@endsection
