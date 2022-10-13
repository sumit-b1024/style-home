@extends('layouts.frontend')
@section('content')
    <?php
    use App\Models\QuizAnswer;
    ?>
    <!--<section class="banner_inner">
    <div class="bannerParallax_inner"></div>
    </section>-->
    <section class="designer_cont project_main tittle_no_banner">

        <h4>{{ $page_title->title }} </h4>
        <div class="container">
            <div class="row">
                <div class="tabs_cont">
                    <!--<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
     <li class="nav-item" role="presentation"><a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all"  role="tab" aria-controls="pills-all" aria-selected="true">All</a></li>
     <li class="nav-item" role="presentation"><a class="nav-link" id="pills-living-tab" data-toggle="pill" href="#pills-living" role="tab" aria-controls="pills-living" aria-selected="false">Under Progress</a></li>
     <li class="nav-item" role="presentation"><a class="nav-link" id="pills-kitchen-tab" data-toggle="pill" href="#pills-kitchen" role="tab" aria-controls="pills-kitchen" aria-selected="false">Completed </a></li>
     </ul>-->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                            aria-labelledby="pills-all-tab">
                            <ul class="project_listing">
                                @if (count($models) > 0)
                                    @foreach ($models as $model)
                                        <li>
                                            <div class="project_details">
                                                <h4>{{ $model->project_status }}</h4>
                                                <span>{{ date('d-m-Y', strtotime($model->date)) }}</span>
                                            </div>
                                            @if($model->image != null)
                                                <div class="proj_img"><img src="{{ $model->getProjectUpdateImage() }}"
                                                        alt=""></div>
                                            @endif


                                        </li>
                                    @endforeach
                                @else
                                    <h5 class="text-center text-danger">No Project Update Found for this Project</h5>
                                @endif

                            </ul>

                        </div>
                    </div>
                    @extends('layouts.modal')
    </section>

    <div class="flashBannerCont">
        <div class="container">
            <div class="row">
                <div class="flashBanner">
                    <h2>Learn more about our Design package</h2><button class="btn btn-secondary brown_btn pl-5 pr-5">Read
                        more</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

@endsection
