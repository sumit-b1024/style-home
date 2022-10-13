@extends('layouts.frontend')
@section('content')
    <style>
        .error {
            color: #ff0000;
        }

        .error1 {
            color: #e9940e;
        }
    </style>
    <section class="banner_inner">
        <div class="bannerParallax_inner privacy">

        </div>
    </section>

    <section class="designer_cont project_main">
        <h4>{{ $page_title->title }}</h4>
        @inject('payments', 'App\Models\Payment')
        @php
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
                    @if (isset($payment->products->document))
                        <a href="{{ asset('public/product_document').'/'.$payment->products->document }}" download="{{$payment->products->title}}"
                            class="btn btn-primary btn-sm">Download File</a>
                    @endif
                @endforeach
            @endif
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{!! session('success') !!}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <form action="{{ route('frontend.project.detail.post') }}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <div class="room_design">
                            <h4>Please tell us a little bit more about the room you want to improve</h4>
                            <div class="form-group">
                                <label> Project Title <span class="asterisk" aria-hidden="true">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                <span class="help-block is-invalid error">{{ $errors->first('title') }}</span>
                            </div>
                            <div class="form-group">
                                <label> Can you tell us a little bit more about the room and who it's for and its current
                                    state? (If it's a kid's room, please mention their age so the designer can propose age
                                    appropriate designs)</label>
                                <textarea class="form-control" name="about_room" rows="5" id="comment">{{ old('about_room') }}</textarea>
                                <span class="help-block is-invalid error">{{ $errors->first('about_room') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Please attach a few pictures of the room <span class="asterisk"
                                        aria-hidden="true">*</span></label>

                                <div class="video_upload">
                                    <div class="input-group control-group increment" id="increment">
                                        <label class="custom-file-upload"><span id="room_picture1">Upload</span><input
                                                value="{{ old('room_picture') }}" name="room_picture[]" type="file"
                                                id="room_picture" multiple /></label>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" id="success" type="button"><i
                                                    class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div>
                                    </div>
                                    <div class="clone hide"></div>
                                    <span class="help-block is-invalid error">{{ $errors->first('room_picture') }}</span>
                                    <!--<span class="error1" id="room_picture_name"></span>-->
                                    <div id="room_picture_name"></div>
                                    <p class="text-danger">File Size : Not more than 10 MB.</p>
                                    <p class="text-danger">Supported File Type : jpeg,png,jpg,gif.</p>
                                </div>


                            </div>
                            <div class="form-group">
                                <label>What are the dimensions of the room? </label>
                                <input type="text" name="room_dimension" value="{{ old('room_dimension') }}"
                                    class="form-control">
                                <span class="help-block is-invalid error">{{ $errors->first('room_dimension') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Which items in the room you want to keep? Please attach pictures of the items if they
                                    are not shown in the pictures you uploaded in </label>
                                <textarea class="form-control" name="room_item_keep" rows="5" id="comment">{{ old('room_item_keep') }}</textarea>

                                <div class="video_upload">
                                    <div class="input-group1 control-group2 increment2" id="increment2">
                                        <label class="custom-file-upload"><span
                                                id="room_item_keep_picture1">Upload</span><input
                                                value="{{ old('room_item_keep_picture') }}" name="room_item_keep_picture[]"
                                                type="file" id="room_item_keep_picture" multiple /></label>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" id="success2" type="button"><i
                                                    class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div>
                                    </div>
                                    <div class="clone hide"></div>
                                    <span
                                        class="help-block is-invalid error">{{ $errors->first('room_item_keep_picture') }}</span>
                                    <div id="room_item_keep_picture_name"></div>
                                    <!--<span class="error1" id="room_item_keep_picture_name"></span>-->
                                    <p class="text-danger">File Size : Not more than 10 MB.</p>
                                    <p class="text-danger">Supported File Type : jpeg,png,jpg,gif.</p>
                                </div>



                            </div>
                        </div>
                        <div class="room_design">
                            <h4>Now, let's talk about the project</h4>
                            <div class="form-group">
                                <label>What is the vision you have for this room?</label>
                                <input type="text" name="room_vision" value="{{ old('room_vision') }}"
                                    class="form-control">
                                <span class="help-block is-invalid error">{{ $errors->first('room_vision') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Any specific areas you want the designer to focus on?</label>
                                <input type="text" name="specific_area" value="{{ old('specific_area') }}"
                                    class="form-control">
                                <span class="help-block is-invalid error">{{ $errors->first('specific_area') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Do you have inspiration images you want to upload to give us a better idea of your
                                    style?</label>



                                <div class="video_upload">
                                    <div class="input-group control-group3 increment3" id="increment3">
                                        <label class="custom-file-upload"><span
                                                id="inspiration_image1">Upload</span><input name="inspiration_image[]"
                                                value="{{ old('inspiration_image') }}" type="file"
                                                id="inspiration_image" multiple /></label>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" id="success3" type="button"><i
                                                    class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div>
                                    </div>
                                    <div class="clone hide"></div>
                                    <span
                                        class="help-block is-invalid error">{{ $errors->first('inspiration_image') }}</span>
                                    <div id="inspiration_image_name"></div>
                                    <!--<span class="error1" id="inspiration_image_name"></span>-->
                                    <p class="text-danger">File Size : Not more than 10 MB.</p>
                                    <p class="text-danger">Supported File Type : jpeg,png,jpg,gif.</p>
                                </div>


                            </div>
                            <div class="form-group">
                                <label>Do you have a pinterest board link you want to share with us?</label>
                                <input type="text" name="pinterest_board" value="{{ old('pinterest_board') }}"
                                    class="form-control">
                                <span class="help-block is-invalid error">{{ $errors->first('pinterest_board') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Any color schemes you have in mind?</label>
                                <input type="text" name="color_schemes" value="{{ old('color_schemes') }}"
                                    class="form-control">
                                <span class="help-block is-invalid error">{{ $errors->first('color_schemes') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Any specific items or material you want us to make sure we include in the
                                    design?</label>
                                <input type="text" name="specific_item" value="{{ old('specific_item') }}"
                                    class="form-control">
                                <span class="help-block is-invalid error">{{ $errors->first('specific_item') }}</span>
                            </div>
                            <div class="form-group">
                                <label>What is your budget for this project?</label><input type="text" name="budget"
                                    value="{{ old('budget') }}" class="form-control">
                                <span class="help-block is-invalid error">{{ $errors->first('budget') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Any other considerations we need to keep in mind (kids, pets, preferences, likes or
                                    dislikes) ?</label><input type="text" name="other_consideration"
                                    value="{{ old('other_consideration') }}" class="form-control"><span
                                    class="help-block is-invalid error">{{ $errors->first('other_consideration') }}</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 style_submit">Submit</button>
                    </form>
                </div>
                <div class="col-sm-4">
                    <img src="{{ asset('/public/img/right_img.jpg') }}" alt="style-A-home">
                </div>
            </div>
        </div>
        @extends('layouts.modal')
    </section>

    <script>
        var upload_in_progress = false;
        $("#room_picture").change(function(e) {
            $("#room_picture1").text("Uploaded");
            var names = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                names.push($(this).get(0).files[i].name);
            }
            var x = names.toString();
            //alert(x);
            //$("#room_picture_name").text(x+ ' is the selected file.');
            var images = $('#room_picture_name').html();
            var xx1 = " <span class='error1' >" + x + "</span>";
            var xx2 = images + xx1;
            $("#room_picture_name").html(xx2);
        });
        $("#room_item_keep_picture").change(function(e) {
            $("#room_item_keep_picture1").text("Uploaded");
            var names1 = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                names1.push($(this).get(0).files[i].name);
            }
            var x1 = names1.toString();
            //alert(x1);
            //$("#room_item_keep_picture_name").text(x1+ ' is the selected file.');
            var images2 = $('#room_item_keep_picture_name').html();
            var xx5 = " <span class='error1' >" + x1 + "</span>";
            var xx6 = images2 + xx5;
            $("#room_item_keep_picture_name").html(xx6);
        });
        $("#inspiration_image").change(function(e) {
            $("#inspiration_image1").text("Uploaded");
            var names2 = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                names2.push($(this).get(0).files[i].name);
            }
            var x2 = names2.toString();
            //alert(x2);
            var images3 = $('#inspiration_image_name').html();
            var xx9 = " <span class='error1' >" + x2 + "</span>";
            var xx10 = images3 + xx9;
            $("#inspiration_image_name").html(xx10);
            //$("#inspiration_image_name").text(x2+ ' is the selected file.');
        });

        function test(elem) {
            var dataId = $(elem).data("id");
            $("#" + dataId).text("Uploaded");
            var names4 = [];
            for (var i = 0; i < $(elem).get(0).files.length; ++i) {
                names4.push($(elem).get(0).files[i].name);
            }
            var x3 = names4.toString();
            var images = $('#room_picture_name').html();
            var xx1 = ", <span class='error1' >" + x3 + "</span>";
            //$("#room_picture_name").text(x+ ' is the selected file.');
            var xx2 = images + xx1;
            $("#room_picture_name").html(xx2);
        }

        function test2(elem) {
            var dataId1 = $(elem).data("id");
            $("#" + dataId1).text("Uploaded");
            var names7 = [];
            for (var i = 0; i < $(elem).get(0).files.length; ++i) {
                names7.push($(elem).get(0).files[i].name);
            }
            var x3 = names7.toString();
            var images = $('#room_item_keep_picture_name').html();
            var xx1 = ", <span class='error1' >" + x3 + "</span>";
            //$("#room_picture_name").text(x+ ' is the selected file.');
            var xx2 = images + xx1;
            $("#room_item_keep_picture_name").html(xx2);
        }

        function test3(elem) {
            var dataId2 = $(elem).data("id");
            $("#" + dataId2).text("Uploaded");
            var names9 = [];
            for (var i = 0; i < $(elem).get(0).files.length; ++i) {
                names9.push($(elem).get(0).files[i].name);
            }
            var x9 = names9.toString();
            var images = $('#inspiration_image_name').html();
            var xx10 = ", <span class='error1' >" + x9 + "</span>";
            //$("#room_picture_name").text(x+ ' is the selected file.');
            var xx12 = images + xx10;
            $("#inspiration_image_name").html(xx12);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#success").click(function() {
                var num = Math.floor(Math.random() * 999999) + 1;
                var id_val = 'room_picture' + num;
                //var xx = 'test("+id_val+")'
                var html1 =
                    "<div class='control-group input-group' style='margin-top:10px'><label class='custom-file-upload'><span id='room_picture" +
                    num + "'>Upload</span><input name='room_picture[]' type='file' data-id='room_picture" +
                    num +
                    "' onchange='test(this)' /></label><div class='input-group-btn'> <button class='btn btn-danger' type='button'><i class='glyphicon glyphicon-remove'></i> Remove</button></div></div>";
                var html = $(".clone").html();
                //alert(html);
                $("#increment").after(html1);
            });
            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });

            $("#success2").click(function() {
                var num2 = Math.floor(Math.random() * 999999) + 1;
                //var id_val = 'room_picture'+num;
                //var xx = 'test("+id_val+")'
                var html2 =
                    "<div class='control-group2 input-group' style='margin-top:10px'><label class='custom-file-upload'><span id='room_item_keep_picture" +
                    num2 +
                    "'>Upload</span><input name='room_item_keep_picture[]' type='file' data-id='room_item_keep_picture" +
                    num2 +
                    "' onchange='test2(this)' /></label><div class='input-group-btn'> <button class='btn btn-danger danger2' type='button'><i class='glyphicon glyphicon-remove'></i> Remove</button></div></div>";

                $("#increment2").after(html2);
            });
            $("body").on("click", ".danger2", function() {
                $(this).parents(".control-group2").remove();
            });

            $("#success3").click(function() {
                var num3 = Math.floor(Math.random() * 999999) + 1;
                //alert();
                var html3 =
                    "<div class='control-group3 input-group' style='margin-top:10px'><label class='custom-file-upload'><span id='inspiration_image" +
                    num3 +
                    "'>Upload</span><input name='inspiration_image[]' type='file' data-id='inspiration_image" +
                    num3 +
                    "' onchange='test2(this)' /></label><div class='input-group-btn'> <button class='btn btn-danger danger3' type='button'><i class='glyphicon glyphicon-remove'></i> Remove</button></div></div>";

                $("#increment3").after(html3);
            });
            $("body").on("click", ".danger3", function() {
                $(this).parents(".control-group3").remove();
            });
        });
    </script>
@endsection
