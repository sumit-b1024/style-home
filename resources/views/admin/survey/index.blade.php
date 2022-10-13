@extends('layouts.admin')


@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('Survey') }}</strong>
                {{-- <div class="pull-right"><a class="btn btn-warning" href="{{route('admin.survey.add')}}">Add <i class="fa fa-plus"></i></a></div> --}}
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">{{__('Image')}}</th> --}}
                            <th scope="col">{{ __('Customer Name') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('Created At') }}</th>
                            {{-- <th scope="col">{{__('Action')}}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer_quizs as $quiz)
                            <tr>
                                <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                <td class="align-middle">
                                    @isset($quiz->users->first_name)
                                        {{ $quiz->users->first_name }}
                                    @endisset
                                    @isset($quiz->users->last_name)
                                        {{ $quiz->users->last_name }}
                                    @endisset
                                </td>

                                <td class="align-middle">@isset($quiz->users->email){{ $quiz->users->email }}@endisset</td>
                                <td class="align-middle">{{ $quiz->created_at }}</td>

                                {{-- <td class="align-middle"><a href="{{route('admin.products.update',['product'=>$product])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a><a href="{{route('admin.products.delete',['product'=>$product])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td> --}}

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        {{ $customer_quizs->links() }}

    </div>
@endsection
