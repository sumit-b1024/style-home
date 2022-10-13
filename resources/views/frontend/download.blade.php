@extends('layouts.frontend')
@section('content')
    <section class="designer_cont project_main mb-5 tittle_no_banner">
        <h4 class="purple">Product</h4>
        <h3><a href="{{route('frontend.home')}}">Back</a></h3>
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{!! session('success') !!}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
        @endif
        <div class="container">
            <div class="row" style="min-height: 50%">
                <div class="col-sm-8 m-auto text-center">
                    <h3 class="text m-auto">Thanks alot for your purchase!</h3>
                </div>
                <div class="col-md-8 m-auto">
                    <p>Please click below to download your room's design.</p>
                    @inject('payments', 'App\Models\Payment')
                    @inject('settings', 'App\Models\Setting')
                    @php
                        $settings = $settings->select('instagram_page_link')->first();
                        $user_id = auth()->user()->id;
                        if (isset($user_id)) {
                            $payments = $payments
                                ->where('user_id', $user_id)
                                ->orderBy('id', 'DESC')
                                ->with('purchase_products.products')
                                ->first();
                        }
                    @endphp
                    @if (isset($payments))
                        @if (sizeof($payments->purchase_products) > 0)
                            @foreach ($payments->purchase_products as $payment)
                                @if (sizeof($payment->products->product_documents) > 0)

                                    @foreach ($payment->products->product_documents as $item)
                                        <a href="{{ asset('public/product_document') . '/' . $item->document_name }}"
                                            download="{{ $payment->products->title }}"
                                            class="btn btn-primary btn-sm">Download File</a>
                                    @endforeach

                                @endif
                            @endforeach
                        @endif
                    @endif
                    <br>
                    <br>
                    {{-- @if (isset($settings->instagram_page_link))
                            <li><a target="_blank" class="text-danger" href="{{$settings->instagram_page_link}}"><i
                                        class="fab fa-instagram" style="width: 20px;"></i></a></li>
                        @else --}}
                    {{-- <a target="_blank" class="text-danger" href="https://www.instagram.com/"><i
                                        class="fab fa-instagram" style="width: 20px;"></i></a> --}}
                    {{-- @endif --}}

                    <br>
                    <div class="d-flex">
                        <p class="mr-3 my-auto">Please tag us on instagram once you completed furnishing your space!</p> <a
                            target="_blank" class="text-danger" href="https://www.instagram.com/"><i
                                class="fab fa-instagram" style="font-weight: 700;"></i></a>
                    </div>
                    <p>If you face any issues with downloading the documents, please reach out to us on <a
                            href="info@style-a-home.com">info@style-a-home.com</a> </p>
                </div>
            </div>
        </div>

        @extends('layouts.modal')
    </section>
@endsection
