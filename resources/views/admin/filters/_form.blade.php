@if (count($errors) > 0)
    <ul id="login-validation-errors" class="validation-errors">
        @foreach ($errors->all() as $error)
            <li style="color:red;" class="validation-error-item">{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form method="post" action="{{ $path }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="group_name" class=" form-control-label">{{ __('Group Name') }}</label>

        <input type="text" value="{{ old('group_name', optional(@$group)->name) }}" name="group_name"
            placeholder="Enter Group Name" class="form-control">
        {{-- <span class="help-block is-invalid">{{ $errors->first('group_name') }}</span> --}}

    </div>
    <div class="form-group">
        <div class="">
            <label for="group_items" class=" form-control-label float-left">{{ __('Group Items') }}</label>

            <div class=" float-right"><button id="rowAdder" type="button" class="btn btn-dark">
                    <span class="bi bi-plus-square-dotted">
                    </span> ADD
                </button></div>


        </div>
        @if (isset($group_items) && sizeof($group_items) > 0)
            @foreach ($group_items as $item)
                <div id="row">
                    <div class="input-group m-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-danger" id="DeleteRow" type="button">
                                <i class="bi bi-trash"></i>
                                Delete
                            </button>
                        </div>
                        <input type="text" class="form-control m-input" value="{{ old('group_items', optional(@$item)->item_name) }}" name="group_items[]">
                    </div>
                </div>
            @endforeach
        @else
            <div id="row">
                <div class="input-group m-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-danger" id="DeleteRow" type="button">
                            <i class="bi bi-trash"></i>
                            Delete
                        </button>
                    </div>
                    <input type="text" class="form-control m-input" name="group_items[]">
                </div>
            </div>
        @endif
        <div id="newinput"></div>

        <span class="help-block is-invalid">{{ $errors->first('group_items') }}</span>
    </div>
    <div class="form-actions form-group">
        <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit') }}</button>
    </div>

</form>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $("#rowAdder").click(function() {
        newRowAdd =
            '<div id="row"> <div class="input-group m-3">' +
            '<div class="input-group-prepend">' +
            '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            '<i class="bi bi-trash"></i> Delete</button> </div>' +
            '<input type="text" class="form-control m-input" name="group_items[]"> </div> </div>';

        $('#newinput').append(newRowAdd);
    });

    $("body").on("click", "#DeleteRow", function() {
        $(this).parents("#row").remove();
    })
</script>
