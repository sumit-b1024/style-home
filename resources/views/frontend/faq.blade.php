@extends('layouts.frontend')
@section('content')
	<!--<section class="banner_inner">
        <div class="bannerParallax_inner privacy">

        </div>
    </section>-->

    <section class="designer_cont project_main mb-5 tittle_no_banner">
        <h4 class="purple">{{$page_title->title}}</h4>
        <div class="container">
            <div class="row">
                <div class="faq_cont">

                    <div class="accordion" id="accordionExample">
                        @if(count($faqs))
                        @php
                        $i=1;
                        @endphp
                        @foreach($faqs as $faq)
                        
                        <div class="card">
                            <div class="card-header" id="heading{{$i}}">
                                <h2 class="mb-0">
                                    <button class="btn  btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true"
                                        aria-controls="collapse{{$i}}">
                                        {{$faq->question}}

                                        <span class="float-right"> <i class="far fa-question-circle"></i> </span>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse{{$i}}" class="collapse" aria-labelledby="heading{{$i}}"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    
                                        {!!$faq->answer!!}
                                    
                                </div>
                            </div>
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                        @endif
                        <!--<div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn  btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        How much will my interior design project cost?
                                        <span class="float-right"> <i class="far fa-question-circle"></i> </span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    We denounce with righteous indignation and dislike men who are so beguiled and
                                    demoralized by the charms of pleasure of the moment, so blinded by desire, that they
                                    cannot foresee the pain and trouble that are bound to ensue. We denounce with
                                    righteous indignation and dislike men who are so beguiled and demoralized by the
                                    charms of pleasure of the moment, so blinded by desire, that they cannot foresee the
                                    pain and trouble that are bound to ensue.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn  btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Why do you have a design fee and purchasing fee?
                                        <span class="float-right"> <i class="far fa-question-circle"></i> </span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    And lastly, the placeholder content for the third and final accordion panel. This
                                    panel is hidden by default.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        What should I have at our first meeting for my project?
                                        <span class="float-right"> <i class="far fa-question-circle"></i> </span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    And lastly, the placeholder content for the third and final accordion panel. This
                                    panel is hidden by default.
                                </div>
                            </div>
                        </div>-->
                    </div>

                </div>
            </div>
            <div class="row"><div class="col-sm-12"><div class="faq_txt"><span>Do you still have a question that was not addresses here.</span><a href="{{route('frontend.contact')}}" class="faq_cont_bt">contact us </a></div></div></div>
        </div>
        @extends('layouts.modal')
    </section>

    <!---<div class="flashBannerCont">
        <div class="container">
            <div class="row">
                <div class="flashBanner">
                    <h2>
                        Learn more about our Design packages
                    </h2>
                    <button class="btn btn-secondary brown_btn pl-5 pr-5">Read more</button>
                </div>
            </div>
        </div>
    </div>-->
@endsection
