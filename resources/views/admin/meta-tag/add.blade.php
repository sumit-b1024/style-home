<?php
use App\Models\MetaTag;
?>
@extends('layouts.admin')


@section('content')

 <div class="animated fadeIn">


                <div class="row">
                   

                    </div><!--/.col-->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Meta Tag</strong><small> Form</small></div>
                            <div class="card-body card-block">
                             @include('admin.meta-tag._form',['path'=>route('admin.metaTag.add.post')]) 
                                    
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    </div>
 @endsection