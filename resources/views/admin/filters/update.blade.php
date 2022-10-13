<?php
use App\Models\Banner;
?>
@extends('layouts.admin')


@section('content')
    <div class="animated fadeIn">


        <div class="row">


        </div>
        <!--/.col-->

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('Additional Filters') }}</strong><small> {{ __('Form') }}</small>
                </div>
                <div class="card-body card-block">
                    @include('admin.filters._form', [
                        'path' => route('admin.filters.update.post', ['group' => $group]),
                    ])

                </div>
            </div>


        </div>

    </div>
@endsection
