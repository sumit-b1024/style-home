{{-- @if (count($errors) > 0)
    <ul id="login-validation-errors" class="validation-errors">
        @foreach ($errors->all() as $error)
            <li style="color:red;" class="validation-error-item">{{ $error }}</li>
        @endforeach
    </ul>
@endif --}}
<form method="post" action="{{ $path }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="title" class=" form-control-label">{{ __('Product Title') }}</label>

        <input type="text" value="{{ old('title', optional(@$product)->title) }}" name="title"
            placeholder="Enter title" class="form-control">
        <span class="help-block is-invalid text-danger">{{ $errors->first('title') }}</span>

    </div>

    {{-- <div class="form-group">fff
        @isset($product)
            <img src="{{asset("public/uploads/product/{$product->document}")}}" width="150px" />
           
        @endisset
        <label for="file-input" class=" form-control-label">Product document</label>
        <input name="document" type="file" id="document" name="document" class="form-control-file"
            accept=".doc,.docx,application/msword,image/*">
        <span class="help-block is-invalid text-danger">{{ $errors->first('document') }}</span>
    </div> --}}

    <div class="form-group">
        <label for="document" class=" form-control-label">{{ __('Product document') }}</label>
        <input name="document[]" type="file" id="document" class="form-control-file"
            accept=".doc,.docx,application/msword,image/*" multiple>
        <span class="help-block is-invalid text-danger">{{ $errors->first('document') }}</span>
    </div>
     @if( isset($product) && file_exists("public/product_document/".@$product->product_document->document_name))
 <a class="btn btn-link" href="{{url("public/product_document/".@$product->product_document->document_name)}}">Download Document</a>
  @endif
    <div class="form-group">
        <label for="price" class=" form-control-label">{{ __('Price') }}</label>

        <input type="text" value="{{ old('price', optional(@$product)->price) }}" name="price"
            placeholder="Enter Price" class="form-control">
        <span class="help-block is-invalid text-danger">{{ $errors->first('price') }}</span>
    </div>
    <div class="form-group">
        <label for="available_qty" class=" form-control-label">{{ __('Available Quantity') }}</label>

        <input type="text" value="{{ old('available_qty', optional(@$product)->available_qty) }}"
            name="available_qty" placeholder="Enter Quantity" class="form-control">
        <span class="help-block is-invalid text-danger">{{ $errors->first('available_qty') }}</span>
    </div>
    <div class="form-group">
        <label for="description" class=" form-control-label">{{ __('Description') }}</label>

        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', optional(@$product)->description) }}</textarea>
        <span class="help-block is-invalid text-danger">{{ $errors->first('description') }}</span>
    </div>
    <div class="form-group">
        <label for="room_type" class=" form-control-label">{{ __('Room Type') }}</label>

        {{-- <input type="text" value="{{ old('room_type', optional(@$product)->room_type) }}" name="room_type"
            placeholder="Enter Room Type" class="form-control"> --}}
        <select name="room_type[]" id="room_type" class="form-control select2" multiple>
            @forelse ($room_types as $roomtype)
                @php
                    if (isset($roomtypes)) {
                        $check = $roomtypes->firstWhere('id', $roomtype->id);
                    } else {
                        $check = null;
                    }
                @endphp
                <option value="{{ $roomtype->id }}" @isset($check) selected @endisset>
                    {{ $roomtype->name }}</option>
            @empty
                <option value="">No list found</option>
            @endforelse
        </select>
        <span class="help-block is-invalid text-danger">{{ $errors->first('room_type') }}</span>
    </div>
    <div class="form-group">
        <label for="style_type" class=" form-control-label">{{ __('Style Type') }}</label>

        {{-- <input type="text" value="{{ old('style_type', optional(@$product)->style_type) }}" name="style_type"
            placeholder="Enter Style Type" class="form-control"> --}}
        <select name="style_type[]" id="style_type" class="form-control select2" multiple>
            @forelse ($style_types as $styletype)
                @php
                    if (isset($styletypes)) {
                        $check = $styletypes->firstWhere('id', $styletype->id);
                    } else {
                        $check = null;
                    }
                @endphp
                <option value="{{ $styletype->id }}" @isset($check) selected @endisset>
                    {{ $styletype->name }}</option>

            @empty

                <option value="">No list found</option>
            @endforelse
        </select>
        <span class="help-block is-invalid text-danger ">{{ $errors->first('style_type') }}</span>

    </div>
    <div class="form-group">
        <label for="room_layout" class=" form-control-label">{{ __('Room Layout') }}</label>

        {{-- <input type="text" value="{{ old('room_layout', optional(@$product)->room_layout) }}" name="room_layout"
            placeholder="Enter Room Layout" class="form-control"> --}}
        <select name="room_layout[]" id="room_layout" class="form-control select2" multiple>
            @forelse ($room_layouts as $roomlayout)
                @php
                    if (isset($roomlayouts)) {
                        $check = $roomlayouts->firstWhere('id', $roomlayout->id);
                    } else {
                        $check = null;
                    }
                @endphp
                <option value="{{ $roomlayout->id }}" @isset($check) selected @endisset>
                    {{ $roomlayout->name }}</option>

            @empty

                <option value="">No list found</option>
            @endforelse
        </select>
        <span class="help-block is-invalid text-danger">{{ $errors->first('room_layout') }}</span>
    </div>
    <div class="form-group">
        <label for="country" class=" form-control-label">{{ __('Country') }}</label>

        {{-- <input type="text" value="{{ old('country', optional(@$product)->country) }}" name="country"
            placeholder="Enter Country" class="form-control"> --}}
        <select name="country" id="country" class="form-control">
            <option value="" selected disabled>Select Country</option>
            @forelse ($countries as $country)
                <option value="{{ $country->id }}" @if (isset($product) && $country->id == $product->country) selected @endif>
                    {{ $country->name }}</option>

            @empty

                <option value="">No list found</option>
            @endforelse
        </select>
        <span class="help-block is-invalid text-danger">{{ $errors->first('country') }}</span>
    </div>
    <div class="form-group">
        <label for="color_scheme" class=" form-control-label">{{ __('Color Scheme') }}</label>

        <input type="text" value="{{ old('color_scheme', optional(@$product)->color_scheme) }}" name="color_scheme"
            placeholder="Enter Color" class="form-control">
        <span class="help-block is-invalid text-danger">{{ $errors->first('color_scheme') }}</span>
    </div>
    <div class="form-group">
        <label for="materials" class=" form-control-label">{{ __('Material') }}</label>

        <input type="text" value="{{ old('materials', optional(@$product)->materials) }}" name="materials"
            placeholder="Enter Materials" class="form-control">
        <span class="help-block is-invalid text-danger">{{ $errors->first('materials') }}</span>
    </div>
    <div class="form-group">
        <label for="dimensions" class=" form-control-label">{{ __('Dimensions') }}</label>

        <input type="text" value="{{ old('dimensions', optional(@$product)->dimensions) }}" name="dimensions"
            placeholder="Enter Dimensions" class="form-control">
        <span class="help-block is-invalid text-danger">{{ $errors->first('dimensions') }}</span>
    </div>
    <div class="form-group">
        @isset($product_images)
            @if (sizeof($product_images) > 0)
                <div class="d-flex">
                    @foreach ($product_images as $prd)
                        <div class="m-2 border border-2 p-2">
                            <img src="{{ asset("public/product/{$prd->image}") }}" width="150px" />
                        </div>
                    @endforeach
                </div>
            @endif
        @endisset
        <label for="images" class=" form-control-label">{{ __('Image') }}</label>
        <input name="images[]" type="file" id="images" class="form-control-file" accept="image/*" multiple>
        <span class="help-block is-invalid text-danger">{{ $errors->first('images') }}</span>
    </div>
    <div class="text-center">
        <strong>Additional Filters</strong>
    </div>
    <input type="hidden" value="{{ json_encode($filter_groups) }}" id="filter_groups">
    @isset($filterproducts)
        <input type="hidden" value="{{ json_encode($filterproducts) }}" id="filterproducts">
    @endisset
    <button class="btn btn-md btn-success float-right mb-2 btn-sm" id="addBtn" type="button">
        Add new Row
    </button>
    <div class="pt-4">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Select Group Title</th>
                        <th class="text-center">Select Group Items</th>
                        <th class="text-center">Remove Row</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @if (isset($filterproducts) && sizeof($filterproducts) > 0)
                        @foreach ($filterproducts as $key => $item)
                            <tr id="R{{ ++$key }}">
                                <td class="row-index">
                                    <select name="filters[{{ $key }}][group]"
                                        id="filter_group{{ $key }}" class="form-control select2"
                                        onchange="getgroupitems(this,{{ $key }})">
                                        @foreach ($filter_groups as $item1)
                                            <option value="{{ $item1->id }}"
                                                @if (isset($item) && $item1->id == $item->filter_group_id) selected @endif>{{ $item1->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="row-index">
                                    <select name="filters[{{ $key }}][item][]"
                                        id="filter_item{{ $key }}" class="form-control select2" multiple>
                                        @foreach ($item->filtergroupitem()->get() as $filtgrp)
                                            <option value="{{ $filtgrp->id }}" selected>{{ $filtgrp->item_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger remove" type="button">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
    </div>

</form>
