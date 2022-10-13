@extends('layouts.frontend')@section('content')
<!---<section class="banner_inner"><div class="bannerParallax_inner"></div>    </section>-->
<?php
use App\Models\QuizCategory;
?>
<section class="designer_cont project_main mb-5 tittle_no_banner">
    <div class="designer_banner"></div>
    <h4 class="purple">{{ $page_title->title }} </h4>

    <div class="about-wrapper">
        <div class="container">

            <div class="row">


                <div class="col-lg-4">
                    <div class="thumbnail">
                        <img class="w-100" src="{{ asset("public/uploads/{$designer->profile_image}") }}"
                            alt="{{ $designer->first_name }}">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="about-inner inner">
                        <div class="section-title">
                            <h2 class="title text-capitalize">{{ $designer->first_name }}</h2>
                            <p class="description">{!! $designer->description !!}</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="about-us-list">
                                    {{-- <h5 class="title">First Name</h5> --}}
                                    {{-- <p>{{ $designer->first_name }}</p> --}}
                                    <h2 class="title">Favorite Design Styles</h2>
                                    @if ($designer->bio_type)
                                        @php
                                            $type = [];
                                            $bio_ids = explode(',', $designer->bio_type);
                                            $bio_types = QuizCategory::where('status', 1)
                                                ->whereIn('id', $bio_ids)
                                                ->get();
                                        @endphp
                                        @if (count($bio_types) > 0)
                                            @foreach ($bio_types as $bio_type)
                                                @php
                                                    $type[] = $bio_type->title;
                                                @endphp
                                            @endforeach
                                        @endif
                                        <ul>
                                            @foreach ($type as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <!--<div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="about-us-list">
                                        <h5 class="title">Last Name</h5>
                                        <p>{{ $designer->last_name }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="about-us-list">
                                        <h5 class="title">Email</h5>
                                        <p>{{ $designer->email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="about-us-list">
                                        <h5 class="title">Phone Number</h5>
                                        <p>{{ $designer->phone_number }}</p>
                                    </div>
                                </div>-->
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="designer_profile_titlle col-sm-12">
                    <h2 class="title">Recent Work</h2>
                    <p class="description">There are many variations of passages of Lorem Ipsum available, <br> but the
                        majority have suffered alteration.</p>


                </div>

            </div>


            <div class="row">
                @if (count($designer_images) > 0)
                    @foreach ($designer_images as $designer_image)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="im_portfolio text-center mt--40">
                                <div class="thumbnail_inner">
                                    <div class="thumbnail">
                                        <a href="portfolio-details.html">
                                            <img src="{{ $designer_image->getDesignerImage() }}"
                                                alt="{{ $designer_image->title }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="inner">
                                        <div class="portfolio_heading">
                                            <div class="category_list">{{ $designer_image->title }} </div>
                                            <!--<h4 class="title">Web Design</h4>-->
                                        </div>
                                        <div class="portfolio_hover">
                                            <!--<p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit.</p>-->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
                <!--<div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="im_portfolio text-center mt--40">
                            <div class="thumbnail_inner">
                                <div class="thumbnail">
                                    <a href="portfolio-details.html">
                                        <img src="public/img/gallery1.jpg" alt="React Creative Agency">
                                    </a>
                                </div>
                            </div>
                            <div class="content">
                                <div class="inner">
                                    <div class="portfolio_heading">
                                        <div class="category_list">Development </div>
                                        <h4 class="title">Web Design</h4>
                                    </div>
                                    <div class="portfolio_hover">
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


<div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="im_portfolio text-center mt--40">
                            <div class="thumbnail_inner">
                                <div class="thumbnail">
                                    <a href="portfolio-details.html">
                                        <img src="public/img/gallery1.jpg" alt="React Creative Agency">
                                    </a>
                                </div>
                            </div>
                            <div class="content">
                                <div class="inner">
                                    <div class="portfolio_heading">
                                        <div class="category_list">Development </div>
                                        <h4 class="title">Web Design</h4>
                                    </div>
                                    <div class="portfolio_hover">
                                        <p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>	-->


            </div>

            <!--<a class="btn btn-secondary brown_btn designer_bt" >Select Designer</a>-->
        </div>
    </div>
    @extends('layouts.modal')
</section>
@endsection
