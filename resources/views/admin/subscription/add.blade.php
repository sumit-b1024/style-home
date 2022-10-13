<?php
use App\Models\Banner;
?>
@extends('layouts.admin')


@section('content')

 <div class="animated fadeIn">


                <div class="row">
                   

                    </div><!--/.col-->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>{{__('Subscription')}}</strong><small> {{__('Form')}}</small></div>
                            <div class="card-body card-block">
                             @include('admin.subscription._form',['path'=>route('admin.subscription.add.post')]) 
                                    
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    </div>
 @endsection