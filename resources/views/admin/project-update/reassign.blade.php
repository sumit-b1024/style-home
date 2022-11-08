@extends('layouts.admin')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">{{__('Assign Designer to Project')}}</strong>
           
        </div>
        <div class="card-body project_update">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('Designer Name')}}</th>
                        <th scope="col">{{__('Category')}}</th>
                        
                        <th scope="col">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>

                	@php 
                    	$designerUser=(@$projectDetail->detailForm->designerUser ); 
                    @endphp


					@if(count($designers)>0)
                    @foreach($designers as $model)

                    <tr>
                        <th class="align-middle" scope="row">{{$loop->iteration}}</th>
                        <td class="align-middle">{{$model->getFullName()}}</td>
                      <td class="align-middle">{{$model->designer->getStyles()}}</td>
                     
                    <td class="align-middle">
                   	@if($designerUser->id!=$model->id)
                     <a class="btn btn-warning" href="{{route('admin.customer.project.update.reassign',['projectDetail'=>$projectDetail->id,'user'=>$model->id])}}" onclick="return confirm('Are You Sure to assign this designer?');">Reassign</a>
                    
                    @else
                    	<span style="font-weight: 600">Assigned</span>
                     @endIf

					</td>

                    </tr>
                    @endforeach
					@endif
                </tbody>
            </table>

        </div>
    </div>
    {{ $designers->links() }}

</div>


@endsection
