<style>
    table,
    th,
    td {
        border: 1px solid black;
        background-color: #96D4D4;
    }
</style>
<table>
    <tbody>
        <tr>
            <td colspan="13"><img width="377" height="76" src="https://alesnaad.com/wp-content/uploads/2023/11/14-377x76.jpg" class="custom-logo" alt="شركة الاسناد الماسي" decoding="async" srcset="https://alesnaad.com/wp-content/uploads/2023/11/14-377x76.jpg 377w, https://alesnaad.com/wp-content/uploads/2023/11/14-300x61.jpg 300w, https://alesnaad.com/wp-content/uploads/2023/11/14-768x155.jpg 768w, https://alesnaad.com/wp-content/uploads/2023/11/14.jpg 976w" sizes="(max-width: 377px) 100vw, 377px">
            </td>
        </tr>
        <tr>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="100px">company_cr</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">contact_person</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">phone_no</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">email</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">address</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">note</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">brand_name</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="100px">kilometers</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="100px">hour</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="80px">warranty</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">others</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">vin_no</th>
            <th style="border: 1px solid black; background-color: #96D4D4;" width="150px">remarks</th>
        </tr>
        @foreach ($maintenance as $item)
            <tr>
                <td>{{ $item->company_cr }}</td>
                <td>{{ $item->contact_person }}</td>
                <td>{{ $item->phone_no }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->note }}</td>
                <td>{{ $item->brand_name }}</td>
                <td>{{ $item->kilometers }}</td>
                <td>{{ $item->hour }}</td>
                <td>{{ $item->warranty }}</td>
                <td>{{ $item->others }}</td>
                <td>{{ $item->vin_no }}</td>
                <td>{{ $item->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
