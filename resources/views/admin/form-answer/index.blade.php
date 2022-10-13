@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">{{__('Form Question Answer')}}</strong>
            <div class="pull-right"><a class="btn btn-primary" href="{{route('admin.form.answer.add',['question_id'=>$question_id])}}">Add <i class="fa fa-plus"></i></a><a class="btn btn-warning" href="{{route('admin.form.question')}}">Back <i class="fa fa-arrow-circle-left"></i></a></div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Answer Title')}}</th>
                        <th scope="col">{{__('Posted On')}}</th>
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
					@if(count($models)>0)
                    @foreach($models as $model)
                    <tr>
                        <th class="align-middle" scope="row">{{$loop->iteration}}</th>
                        <td class="align-middle">{{$model->title}}</td>
                        <td class="align-middle">{{$model->created_at}}</td>
                    <td class="align-middle"><a href="{{route('admin.form.answer.update',['model'=>$model->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a><a href="{{route('admin.form.answer.delete',['model'=>$model->id])}}" class="btn btn-danger" onclick="return confirm('Are You Sure to Delete');"><i class="fa fa-trash"></i></a>
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
