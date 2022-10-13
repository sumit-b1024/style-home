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
                            <div class="card-header"><strong>Banner</strong><small> Form</small></div>
                            <div class="card-body card-block">
                             @include('admin.banner._form',['path'=>route('admin.banner.add')]) 
                                    
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    </div>
 @endsection