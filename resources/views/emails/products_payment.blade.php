<html>
<head></head>
<body>
    {{$email_template_admin->salutation}},
    <br>
    <br>
    {!!$email_template_admin->message!!}
<?php
  echo  $name." purchase a following products:-";

?>

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
                <td>{{++$key}}</td>
                <td>{{$prd->products->title}}</td>
                <td>{{$prd->products->price}} AED</td>
            </tr>
            @php
                $total += $prd->products->price;
            @endphp
        @endforeach
        <tr>
            <td colspan="2">Total</td>
            <td>{{$total}} AED</td>
        </tr>
    </tbody>
</table>
@endif
    <br/>
    <br/>
Thanks,<br>
style-a-home
</body>
</html>

