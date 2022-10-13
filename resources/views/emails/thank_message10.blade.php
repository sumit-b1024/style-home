<html>

<head></head>

<body>
    {{$email_template->salutation}}, {{ $name }}
    <br>
    <br>
    {!!$email_template->message!!}
    {{-- <p>Thank you for choosing style-a-home to help you with transforming your space. Your payment for the chosen package
        has been successfully completed.</p> --}}
    <p>Thanks alot for your purchase! Your design documents are attached. Please tag us on instagram once you completed
        furnishing your space!</p>
    <p>Please proceed to the <a href="{{ url('project-detail') }}">project page</a> to complete the details needed for
        your design project.</p>
    <br><br>
    @if (sizeof($purchase_data) > 0)
        <table border="2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($purchase_data as $key => $prd)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $prd->products->title }}</td>
                        <td>{{ $prd->products->price }} AED</td>
                    </tr>
                    @php
                        $total += $prd->products->price;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{ $total }} AED</td>
                </tr>
            </tbody>
        </table>
    @endif
    <br />
    <br />
    <p>If you face any issues with downloading the documents, please reach out to us on info@style-a-home.com"</p>
    <br />
    <br />
    Thanks,<br>
    style-a-home
</body>

</html>
