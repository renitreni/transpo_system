<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
    <td colspan="4">Company : {{ $company }}</td>
</tr>
<tr>
    <td colspan="3">Supplier : {{ $supplier }}</td>
</tr>
<tr>
    <td colspan="2">Year : {{ $year }}</td>
</tr>
<tr></tr>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">#</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">Description</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">VIN #</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">Date Services</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">Labor Cost</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">Total Price</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">Remarks</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($data as $value )
        <tr>
            <td align="center" style="border:1px solid black" colspan="1">{{ $loop->iteration }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $value->description }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $value->vin }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ date('F d, Y',strtotime($value->date_services)) }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $value->labor_cost }} USD</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $value->total_price }} USD</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $value->remarks }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="border:1px solid black">Empty Records</td>
        </tr>
        @endforelse
    </tbody>
</table>

