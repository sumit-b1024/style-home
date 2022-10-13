@extends('layouts.frontend')
@section('content')

    <section class="designer_cont project_main tittle_no_banner">
        <h4 class="purple">Terms and Conditions</h4>
        <div class="container">
            <div class="row">
                {!!@optional($section1)->html!!}
            </div>
        </div>
    </section>

    <div class="flashBannerCont">
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
    </div>
@endsection
