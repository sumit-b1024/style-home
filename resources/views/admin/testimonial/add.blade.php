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
                            <div class="card-header"><strong>{{__('Testimonial')}}</strong><small> {{__('Form')}}</small></div>
                            <div class="card-body card-block">
                             @include('admin.testimonial._form',['path'=>route('admin.testimonial.add.post')]) 
                                    
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    </div>
 @endsection