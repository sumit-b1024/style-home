@extends('layouts.admin')


@section('content')

<div class="col-lg-12">
	<div class="card">
		<div class="card-header">
            <strong class="card-title">{{__('Product')}}</strong>
        <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.products.add')}}">Add <i class="fa fa-plus"></i></a></div>
		</div>
		<div class="card-body">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						{{-- <th scope="col">{{__('Image')}}</th> --}}
						<th scope="col">{{__('Title')}}</th>
						<th scope="col">{{__('Price')}}</th>
						<th scope="col">{{__('Available Stock')}}</th>
						<th scope="col">{{__('Description')}}</th>
						<th scope="col">{{__('Created At')}}</th>
                        <th scope="col">{{__('Action')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
					<tr>
						<th class="align-middle" scope="row">{{$loop->iteration}}</th>
                        {{-- <td class="align-middle"><img width="80px" src="{{asset("
							public/uploads/product/{$product->image}")}}"/></td> --}}
						<td class="align-middle">{{$product->title}}</td>
						<td class="align-middle">{{$product->price}}</td>
						<td class="align-middle">{{$product->available_qty}}</td>
						<td class="align-middle">{{$product->description}}</td>
						<td class="align-middle">{{$product->created_at}}</td>

					<td class="align-middle"><a href="{{route('admin.products.update',['product'=>$product])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a><a href="{{route('admin.products.delete',['product'=>$product])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>

					</tr>

					@endforeach

				</tbody>
			</table>

		</div>
	</div>
	{{ $products->links() }}

</div>


@endsection
