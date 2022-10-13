@extends('layouts.designer')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">{{__('Project Update')}}</strong>
            <div class="pull-right"><a class="btn btn-primary" href="{{route('admin.designer.project.update.add',['project_id'=>$project_id])}}">Add <i class="fa fa-plus"></i></a><a class="btn btn-warning" href="{{route('admin.designer.project.list')}}">Back <i class="fa fa-arrow-circle-left"></i></a></div>
        </div>
        <div class="card-body project_update">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Date')}}</th>
                        <th scope="col">{{__('Image')}}</th>
                        <th scope="col">{{__('Project Status')}}</th>
                        <th scope="col">{{__('Action')}}</th>
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
                    <td class="align-middle"><a href="{{route('admin.designer.project.update.view',['model'=>$model->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a><a href="{{route('admin.designer.project.update.delete',['model'=>$model->id])}}" class="btn btn-danger" onclick="return confirm('Are You Sure to Delete');"><i class="fa fa-trash"></i></a>
					</td>

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
