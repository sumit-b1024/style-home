@extends('layouts.admin')


@section('content')
    <link href="{{ asset('public/jquery-ui/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('public/select2/select2.min.css') }}" rel="stylesheet">
    <style>
        .select2{
            width: 100% !important;
        }
    </style>
    <div class="animated fadeIn">


        <div class="row">


        </div>
        <!--/.col-->

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><strong>{{ __('Product') }}</strong><small> {{ __('Form') }}</small></div>
                <div class="card-body card-block">
                    @include('admin.product._form', [
                        'path' => route('admin.products.update.post', ['product' => $product]),
                    ])

                </div>
            </div>


        </div>

    </div>
    <script src="{{ asset('public/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('public/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
    @endsection
@section('additional_scripts')
    <script src="{{ asset('public/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('public/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/jquery-ui/jquery-ui.js') }}"></script>
    <script>
        $('.select2').select2();

        function getgroupitems(e, id) {
            let group_id = $(e).val();
            $('#filter_item' + id).html('');
            if (group_id != null || group_id != "") {
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.products.getgroupitems') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "group_id": group_id,
                    },
                    success: function(data) {
                        // console.log(data.group_items);
                        let group_item_list = '';
                        $.each(data.group_items, function(key, val) {
                            // console.log(val);
                            group_item_list += '<option value="' + val.id + '">' + val.item_name +
                                '</option>';
                        });
                        $('#filter_item' + id).html(group_item_list);
                    },
                    error: function(err) {

                    },
                });
            }
        }

        $(document).ready(function() {
            let filter_groups = $("#filter_groups").val();
            let group_item = "<option value=''></option>";
            // console.log(filter_groups);
            $.each(JSON.parse(filter_groups), function(key, val) {
                group_item += '<option value="' + val.id + '">' + val.name + '</option>';
            });
            // Denotes total number of rows

            let filterproducts = $("#filterproducts").val();
            // console.log();
            var rowIdx = 0;
            if(JSON.parse(filterproducts).length > 0){
                rowIdx = JSON.parse(filterproducts).length;
                // for(let i = 1; i <= rowIdx; i++){
                //     getgroupitems(this,i);
                //     console.log(i);
                // }
            }
            else{
                rowIdx = 0;
            }

            // jQuery button click event to add a row
            $('#addBtn').on('click', function() {

                // Adding a row inside the tbody.
                $('#tbody').append(`<tr id="R${++rowIdx}">
         <td class="row-index">
         <select name="filters[${rowIdx}][group]" id="filter_group${rowIdx}" class="form-control" onchange="getgroupitems(this,${rowIdx})">
            ${group_item}
            </select>
         </td>
         <td class="row-index">
            <select name="filters[${rowIdx}][item][]" id="filter_item${rowIdx}" class="form-control" multiple>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
         </td>
          <td class="text-center">
            <button class="btn btn-danger remove"
              type="button">Remove</button>
            </td>
          </tr>`);
                $('select').select2();
            });

            // jQuery button click event to remove a row.
            $('#tbody').on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
