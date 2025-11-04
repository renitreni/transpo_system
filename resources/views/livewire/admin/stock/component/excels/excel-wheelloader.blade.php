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
                style="font-size: 14px;
                       font-weight:600;"
                >
                Total Wheel Loaders: {{ $trucks->count() }}
            </td>
        </tr>
    </tbody>
</table>
<table style="border-collapse: collapse; border-bottom: 1px solid black !important;">
    <thead>
    <tr>
        <th style="text-align:center;  width:30px;height:30px;vertical-align:center;font-weight:600;font-size:12px;border-top: 1px solid black; border-bottom: 1px solid black;">#</th>
        <th colspan="2" style="  height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Model</th>
        <th colspan="3" style="  height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Chassis Number</th>
        <th style=" height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Type</th>
        <th style=" height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Stock</th>
        <th style=" height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Status</th>
        <th style=" height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Warehouse</th>
        <th style=" height:30px;vertical-align:center;font-weight:600;font-size:12px; border-top: 1px solid black; border-bottom: 1px solid black;">Date Added</th>
    </tr>
    </thead>
    <tbody style="border-bottom: 1px solid black;">
    @foreach($trucks as $truck)
        <tr>
            <td  style="text-align:center;padding: 8px;height:25px;vertical-align:center;font-size:12px;font-weight:600;">{{ $loop->iteration }}</td>
            <td  colspan="2" style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $truck->BrandModel }}</td>
            <td  colspan="3" style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $truck->ChassisNumber }}</td>
            <td  style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $truck->Type }}</td>
            <td  style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $truck->Stocks }}</td>
            <td  style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $truck->isActive }}</td>
            <td  style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ $truck->Warehouse }}</td>
            <td  style="padding: 8px;height:25px;vertical-align:center;font-size:12px;">{{ date('M d, Y',strtotime($truck->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

