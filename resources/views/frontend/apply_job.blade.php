@extends('layouts.frontend')
@section('content')
    <style>
        .error {
            color: red;
        }
    </style>
    <?php
    use App\Models\ApplyJob;
    use App\Models\ApplyFormOption;
    ?>

    <section class="designer_cont project_main mb-5 tittle_no_banner">
        <h4 class="purple">{{ $page_title->title }} for "{{ $job_detail->name }}"</h4>
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <div class="apply_area">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                        <div class="apply_form">
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">{!! session('success') !!}</div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
                            @endif

                            {{-- @if ($errors->any())
                                {!! implode('', $errors->all()) !!}
                            @endif --}}
                            <form action="{{ route('frontend.apply.job.post') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job_detail->id }}">
                                <div id="main_fields">
                                    <h2 class="heading">Apply for this Job</h2>
                                    <div class="row mb-3"><label for="inputname" class="col-lg-3 col-form-label">First Name
                                            <span class="asterisk" aria-hidden="true">*</span></label>
                                        <div class="col-lg-9"><input type="text" name="first_name"
                                                value="{{ old('first_name') }}" class="form-control" id="inputname"><span
                                                class="help-block is-invalid error">{{ $errors->first('first_name') }}</span>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputlastname" class="col-lg-3 col-form-label">Last Name <span
                                                class="asterisk" aria-hidden="true">*</span></label>
                                        <div class="col-lg-9"><input type="text" name="last_name"
                                                value="{{ old('last_name') }}" class="form-control" id="inputlastname">
                                            <span
                                                class="help-block is-invalid error">{{ $errors->first('last_name') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmail" class="col-lg-3 col-form-label">Email<span class="asterisk"
                                                aria-hidden="true">*</span></label>
                                        <div class="col-lg-9"><input type="text" name="email"
                                                value="{{ old('email') }}" class="form-control" id="inputEmail"><span
                                                class="help-block is-invalid error">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3"><label for="inputphone" class="col-lg-3 col-form-label">Phone<span
                                                class="asterisk" aria-hidden="true">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                                class="form-control" id="inputphone"><span
                                                class="help-block is-invalid error">{{ $errors->first('phone_number') }}</span>
                                        </div>
                                    </div>
                                    <!--<div class="row mb-3">
                    <label for="inputEmail" class="col-lg-3 col-form-label">Gender<span class="asterisk" aria-hidden="true"></span></label><div class="col-lg-9">
                    <select name="gender" id="job_application_gender" class="form-control"><option value="">Please select</option>
                    @foreach (ApplyJob::getGenders() as $key => $type)
    <option value="{{ $key }}" {{ old('gender') == $key ? 'selected' : '' }}>{{ $type }}</option>
    @endforeach
                    </select>
                    <span class="help-block is-invalid error">{{ $errors->first('gemder') }}</span></div>
                    </div>-->

                                    <div class="row mb-3"><label for="inputphone"
                                            class="col-lg-3 col-md-4 col-sm-4 col-6 col-form-label">Resume/CV<span
                                                class="asterisk" aria-hidden="true">*</span></label>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-6">
                                            <label class="custom-file-upload"><span id="cv1"><b><u>Upload</u> your
                                                        attachment</b>
                                                </span><input name="cv" value="{{ old('cv') }}" id="file-upload"
                                                    type="file">&nbsp;&nbsp;<b><span id="cv_name"></span></b></label>
                                            <!--<a data-source="paste" aria-labelledby="resume" href="#" class="attached_file dropbox">Paste</a>-->
                                            <p class="text-danger">File Size : Not more than 10 MB.</p>
                                            <p class="text-danger">Supported File Type : doc,docx,pdf.</p>
                                            <span class="help-block is-invalid error">{{ $errors->first('cv') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputphone"
                                            class="col-lg-3 col-md-4 col-sm-4 col-6 col-form-label">Cover Letter<span
                                                class="asterisk" aria-hidden="true"></span></label>
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-6">
                                            <!--<a href="#" class="attached_file"><label for="file-upload" class="custom-file-upload">Attach</label>
                    </a>-->
                                            <!--<a data-source="paste" aria-labelledby="resume" href="#" class="attached_file dropbox">Paste</a>-->
                                            <label class="custom-file-upload"><span id="cover_letter1"><b><u>Upload</u>
                                                        your attachment</b></span><input type="file" id="file-upload1"
                                                    name="cover_letter"
                                                    value="{{ old('cover_letter') }}">&nbsp;&nbsp;<span
                                                    id="cover_name"></span></label>
                                            <p class="text-danger">File Size : Not more than 10 MB.</p>
                                            <p class="text-danger">Supported File Type : doc,docx,pdf.</p>
                                            <span
                                                class="help-block is-invalid error">{{ $errors->first('cover_letter') }}</span>
                                        </div>
                                    </div>
                                    <!--profile image-->
                                    <!--<div class="row mb-3"><label for="inputphone" class="col-lg-3 col-md-4 col-sm-4 col-6 col-form-label">Profile Image<span class="asterisk" aria-hidden="true"></span></label>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-6"><label class="custom-file-upload"><span id="profile_image1">Attach</span><input name="profile_image" value="{{ old('profile_image') }}" id="file-upload2" type="file"></label>
                    <p class="text-danger">File Size : Not more than 10 MB.</p>
                    <p class="text-danger">Supported File Type : jpeg,png,jpg,gif.</p>
                    <span class="help-block is-invalid error">{{ $errors->first('profile_image') }}</span>
                    </div>
                    </div>-->
                                    <!--profile image-->
                                    <!--<div class="profile_career">
                    <div class="form-group">
                    <label>LinkedIn Profile<span class="asterisk" aria-hidden="true">&nbsp;*</span></label><input type="text" name="linkedin_profile" id="" value="{{ old('linkedin_profile') }}" class="form-control">
                    <span class="help-block is-invalid error">{{ $errors->first('linkedin_profile') }}</span>
                    </div>
                    <div class="form-group"><label>Do you or will you require any forms of sponsorship to work legally in the US?<span class="asterisk" aria-hidden="true">&nbsp;*</span></label>
                    <input type="text" name="sponsorship" value="{{ old('sponsorship') }}" id="" class="form-control">
                    <span class="help-block is-invalid error">{{ $errors->first('sponsorship') }}</span>
                    </div>
                    <div class="form-group"><label>If you are not located in Denver, CO, are you planning to move or open to relocation?<span class="asterisk" aria-hidden="true">&nbsp;*</span></label><input type="text" name="relocation" value="{{ old('relocation') }}" id="" class="form-control">
                    <span class="help-block is-invalid error">{{ $errors->first('relocation') }}</span>
                    </div>
                    <div class="form-group">
                    <label>What are the three most important things that you'd like your next career opportunity to offer you?<span class="asterisk" aria-hidden="true">&nbsp;*</span></label><textarea name="career_opportunity" id="job_application_answers_attributes_3_text_value" aria-required="true"
                        autocomplete="" class="form-control">{{ old('career_opportunity') }}</textarea>
                    <span class="help-block is-invalid error">{{ $errors->first('career_opportunity') }}</span>
                    </div>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <div class="row mb-3">
                    <label for="inputname" class="col-lg-5 col-form-label">Gender</label>
                    <div class="col-lg-7">
                    <select name="gender" id="job_application_gender" class="form-control"><option value="">Please select</option>
                    @foreach (ApplyJob::getGenders() as $key => $type)
    <option value="{{ $key }}" {{ old('gender') == $key ? 'selected' : '' }}>{{ $type }}</option>
    @endforeach
                    </select>
                    <span class="help-block is-invalid error">{{ $errors->first('gemder') }}</span>
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="inputname" class="col-lg-5 col-form-label">Are you Hispanic/Latino?</label>
                    <div class="col-lg-7">
                    <select name="hispanic_ethnicity" id="job_application_hispanic_ethnicity" class="form-control">
                    <option value="">Please select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Decline To Self Identify">Decline To Self Identify</option>
                    </select></div>
                    </div>
                    <a target="_blank" href="https://boards.cdn.greenhouse.io/docs/RaceEthnicityDefinitions.pdf"> Race &amp; Ethnicity Definitions</a>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <div class="form-group">
                    <label>Veteran Status<span class="asterisk" aria-hidden="true">&nbsp;*</span></label>
                    <input type="text" name="veteran_status" value="{{ old('veteran_status') }}" id="" class="form-control">
                    <span class="help-block is-invalid error">{{ $errors->first('veteran_status') }}</span>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                    <div class="form-group">
                    <label>Disability Status<span class="asterisk" aria-hidden="true">&nbsp;*</span></label>
                    <select name="disability_status" id="job_application_disability_status" class="form-control">
                    <option value="">Please select</option>
                    @foreach (ApplyJob::getDisabilityStatus() as $key => $type)
    <option value="{{ $key }}" {{ old('disability_status') == $key ? 'selected' : '' }}>{{ $type }}</option>
    @endforeach

                    </select>
                    <span class="help-block is-invalid error">{{ $errors->first('disability_status') }}</span>
                    </div>-->

                                    <!--Dynamic Apply Form-->
                                    @if (count($apply_forms) > 0)
                                        @foreach ($apply_forms as $key => $apply_form)
                                            <input type="hidden" name="form_questions[]" value="{{ $apply_form->id }}"
                                                class="form-control">
                                            @if ($apply_form->type == 2)
                                                <div class="form-group">
                                                    <label>{{ $apply_form->label }}</label>
                                                    <select name="form_answers[]" class="form-control">
                                                        <option value="">Please select</option>
                                                        <?php
                                                        $apply_form_options = ApplyFormOption::where('status', 1)
                                                            ->where('apply_form_id', $apply_form->id)
                                                            ->get();
                                                        ?>
                                                        @if (count($apply_form_options) > 0)
                                                            @foreach ($apply_form_options as $option)
                                                                <option value="{{ $option->option_value }}">
                                                                    {{ $option->option_value }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            @else
                                                @if (isset($job_detail) && $job_detail->id == 3)
                                                    <div class="form-group">
                                                        <label>{{ $apply_form->label }}</label>
                                                        <input type="text" name="form_answers[]" class="form-control">
                                                    </div>
                                                @else
                                                @if ($apply_form->id != 1)

                                                <div class="form-group">
                                                    <label>{{ $apply_form->label }}</label>
                                                    <input type="text" name="form_answers[]" class="form-control">
                                                </div>
                                                @endif
                                                @endif


                                                @if ($errors->has('form_answers.0') && $key == 0)
                                                    <div class="error">{{ $errors->first('form_answers.0') }}</div>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                    <!--Dynamic Apply Form-->

                                    <input type="submit" class="btn-block read_more" name="Submit Application"
                                        value="Submit Application">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @extends('layouts.modal')
    </section>
    <script>
        var upload_in_progress = false;
        $("#file-upload").change(function(e) {
            $("#cv1").css("display", "none");
            var cv_name = e.target.files[0].name;
            $("#cv_name").html(cv_name + ' is <u>uploaded</u>');
        });
        $("#file-upload1").change(function(e) {
            //$("#cover_letter1").text("Attached");
            $("#cover_letter1").css("display", "none");
            var cover_name = e.target.files[0].name;
            $("#cover_name").html(cover_name + ' is <u>uploaded</u>');
        });
        $("#file-upload2").change(function(e) {
            $("#profile_image1").text("Attached");
        });
    </script>
@endsection
