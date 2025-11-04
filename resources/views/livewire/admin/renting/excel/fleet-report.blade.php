<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>

<table>
    <thead>
        <th height="30" valign="center" align="center" style="font-size: 12px;
                   font-weight:400;
                   border:1px solid black" colspan="3">
            {{ $fleets[0]->area }} <br> Area
        </th>

        <th height="30" valign="center" align="center" style="font-size: 12px;
                   font-weight:400;
                   border:1px solid black" colspan="2">
            {{ $fleets[0]->date }} <br> Date
        </th>

        <th height="30" valign="center" align="center" style="font-size: 12px;
                   font-weight:400;
                   border:1px solid black" colspan="2">
            {{ $fleets[0]->dayName }} <br> Day
        </th>
    </thead>

    <tbody>
        <tr></tr>
    </tbody>
</table>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">#</th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">الشركة<br>COMPANY</th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">نوع المعدات<br>EQUIPMENT
                TYPE</th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">رقم المعدات<br>EQUIPMENT NO.
            </th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">الموقع<br>LOCATION</th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">رقم الموظف<br>EMPLOYEE'S NO.
            </th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">اسم السائق<br>DRIVER'S NAME
            </th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1"> ساعات العمل<br>WORKING
                HOURS</th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1"> الحالة<br>CONDITIONS</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($logs as $log )
        <tr>
            <td align="center" style="border:1px solid black" colspan="1">{{ $loop->iteration }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $company }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $log->equipment_type }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $log->equipment_no }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $log->location }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $log->employee_no ?? "Renting" }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $log->driver_name }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $log->working_hours }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $log->equipment_status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="border:1px solid black">Empty Logs</td>
        </tr>
        @endforelse
    </tbody>
</table>

<tr></tr>
<tr>
    <td style="font-weight:500;font-size:12px;">Equipment Summmary</td>
</tr>
<tr></tr>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">وحدات<br>UNITS</th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">العمل<br>WORKING</th>
            <th height="28" valign='center' align="center"
                style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">انهيار<br>BREAKDOWN</th>
        </tr>
    </thead>
    <tbody>
        @php
        $workingEquipment = $equipment_summary['Working'];
        $breakdownEquipment = $equipment_summary['Breakdown'];

        // Get all unique keys from both arrays
        $allEquipment = array_unique(array_merge(array_keys($workingEquipment), array_keys($breakdownEquipment)));
        @endphp

        @forelse ($allEquipment as $equipment)
        <tr>
            <td align="center" style="border:1px solid black" colspan="1">{{ $equipment }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $workingEquipment[$equipment] ?? 0 }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $breakdownEquipment[$equipment] ?? 0 }}
            </td>
        </tr>
        @empty
        <tr>
            <td align="center" style="border:1px solid black" colspan="3">No Equipment Data</td>
        </tr>
        @endforelse

    </tbody>
</table>
