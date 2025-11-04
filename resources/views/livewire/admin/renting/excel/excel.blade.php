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
            {{ $fleet->area }} <br> Area
        </th>

        <th height="30" valign="center" align="center" style="font-size: 12px;
                   font-weight:400;
                   border:1px solid black" colspan="2">
            {{ $fleet->date }} <br> Date
        </th>

        <th height="30" valign="center" align="center" style="font-size: 12px;
                   font-weight:400;
                   border:1px solid black" colspan="2">
            {{ $fleet->dayName }} <br> Day
        </th>
    </thead>

    <tbody>
        <tr></tr>
    </tbody>
</table>

<table style="border:1px solid black">
    <thead>
        <tr>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">#</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">الشركة<br>COMPANY</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">نوع المعدات<br>EQUIPMENT TYPE</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">رقم المعدات<br>EQUIPMENT NO.</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">الموقع<br>LOCATION</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">رقم الموظف<br>EMPLOYEE'S NO.</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1">اسم السائق<br>DRIVER'S NAME</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1"> ساعات العمل<br>WORKING HOURS</th>
            <th height="28" valign='center' align="center" style="border:1px solid black; font-weight:500;font-size:10px;" colspan="1"> الحالة<br>CONDITIONS</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($fleet->logs as $log )
        <tr>
            <td align="center" style="border:1px solid black" colspan="1">{{ $loop->iteration }}</td>
            <td align="center" style="border:1px solid black" colspan="1">{{ $fleet->rent->company_name }}</td>
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

<table>
    <thead>
        <th height="30" valign="center" align="center" style="font-size: 12px;
        font-weight:400;
        " colspan="3">
           {{ $fleet->branch_manager }} <br> Branch Manager
        </th>

        <th height="30" valign="center" align="center" style="font-size: 12px;
        font-weight:400;
       " colspan="2">
           {{ $fleet->motion_official }} <br>  Motion Official
        </th>


        <th height="30" valign="center" align="center" style="font-size: 12px;
        font-weight:400;
        " colspan="2">
           {{ $fleet->forman }} <br>  Forman
        </th>

    </thead>
</table>
