<table>
    <thead>
        <th
            style="font-size: 14px;
                   font-weight:600;"
            colspan="4">
            Sultanalfouzanco
        </th>
    </thead>
    <tbody>
        <tr></tr>
        <tr></tr>
        <tr>
            <td
            style="font-size: 10px;
                   font-weight:500;"
            >
            Year: {{ $year }}
        </td>
        </tr>
        <tr>
            <td
                style="font-size: 10px;
                       font-weight:600;"
                >
                Total {{ $product }}: {{ $data->count() }}
            </td>
        </tr>

    </tbody>
</table>
<table style="border-collapse: collapse; border-bottom: 1px solid black !important;">
    <thead>
    <tr>
        <th style="text-align:center; width:30px;height:30px;vertical-align:center;font-weight:600;font-size:12px;border-top: 1px solid black; border-bottom: 1px solid black;">#</th>
        <th style="height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Product</th>
        <th colspan="3" style=" height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Chassis Number</th>
        <th style="height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Year Model</th>
        <th style="height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Purchased Date</th>
    </tr>
    </thead>
    <tbody style="border-bottom: 1px solid black;">
    @foreach($data as $value)
        <tr>
            <td  style="text-align:center;padding: 8px;height:25px;vertical-align:center;font-size:12px;font-weight:600;">{{ $loop->iteration }}</td>
            <td  style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $value->Product }}</td>
            <td  colspan="3" style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $value->ChassisNumber }}</td>
            <td  style="text-align:center;padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $value->YearModel }}</td>
            <td  style="text-align:center;padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $value->Order_Date }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

