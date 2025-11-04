<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        * {
            font-family: sans-serif;
        }

        #trackNum{
            font-size: 10px;
            color: #4d4d4d;
            line-height: 2px;

        }

        img {
            width: 700px;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            font-size: 12px;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .names{
            color: #4d4d4d;
            font-size: 14px;
            line-height: 5px;

        }

        .attachments{
            color: #4d4d4d;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div id="trackNum">
        <p >Track #: {{ $rent->track_number }} <span style="margin-left: 460px;">Entry Date: {{ $rent->entry_date }}</span></p>
        <p >Purchase #:{{ $rent->purchase_number }} </p>
    </div>
    <img width="377" height="76" src="https://alesnaad.com/wp-content/uploads/2023/11/14-377x76.jpg" class="custom-logo" alt="شركة الاسناد الماسي" decoding="async" srcset="https://alesnaad.com/wp-content/uploads/2023/11/14-377x76.jpg 377w, https://alesnaad.com/wp-content/uploads/2023/11/14-300x61.jpg 300w, https://alesnaad.com/wp-content/uploads/2023/11/14-768x155.jpg 768w, https://alesnaad.com/wp-content/uploads/2023/11/14.jpg 976w" sizes="(max-width: 377px) 100vw, 377px">

    <table>
        <h4>Client</h4>
        <thead>
            <tr>
                <th scope="col">Company</th>
                <th scope="col">Company C.R.</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Note</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $rent->company_name }}</td>
                <td>{{ $rent->company_cr }}</td>
                <td>{{ $rent->contact_person }}</td>
                <td>{{ $rent->mobile_number }}</td>
                <td>{{ $rent->contact_email }}</td>
                <td>{{ $rent->national_address }}</td>
                <td>{{ $rent->note }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <h4>Service Renting</h4>
        <thead>
            <tr>
                <th scope="col">Method</th>
                <th scope="col">Amount</th>
                <th scope="col">Advance Payment</th>
                <th scope="col">Total Amount(yearly)</th>
                <th scope="col">Number of units</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @php
                    $method = "";
                    if($rent->paymentMethod === 12){
                        $method = "Monthly";
                    }elseif($rent->paymentMethod === 56){
                        $method = "Weekly";
                    }else{
                        $method = "Daily";
                    }
                @endphp
                <td>{{ $method }}</td>
                <td>{{ $rent->service_amount }} SAR</td>
                <td>{{ $rent->advance_payment }} SAR</td>
                <td>{{ $rent->total_service_amount }} SAR</td>
                <td>{{ $rent->number_units }} units</td>
            </tr>
        </tbody>
    </table>

    @isset($rent->approvalFleet)
    <table>
        <h4>Requested Units</h4>
        <thead>
            <tr>
                <th scope="col">Brand</th>
                <th scope="col">Model</th>
                <th scope="col">Height</th>
                <th scope="col">VIN No.</th>
                <th scope="col">Plate No.</th>
                <th scope="col">Insurance</th>
                <th scope="col">Operator Name</th>
                <th scope="col">Location</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rent->approvalFleet as $fleet )
            <tr>
                <td>{{ $fleet->truck_brand }}</td>
                <td>{{ $fleet->truck_model	 }}</td>
                <td>{{ $fleet->truck_size }}</td>
                <td>{{ $fleet->truck_vin }}</td>
                <td>{{ $fleet->plate_number }}</td>
                <td>{{ $fleet->insurance }}</td>
                <td>{{ $fleet->operator_name }}</td>
                <td>{{ $fleet->current_location }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="8">Empty list</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @endisset
    <span class="attachments">{{ empty($rent->files ) ? "" : "This record has file attachments."  }}</span>


    @if(trim($rent->personSales) != "" || trim($rent->personFleet) != ""  || trim($rent->personWorkshop) != "" || trim($rent->personAccountant) != "")
    <div>
        <h5>This was approved by: </h5>
        @isset($rent->personSales)
        <p class="names">Sales &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :  {{ $rent->personSales  }}</p>
        @endisset
        @isset($rent->personFleet)
        <p class="names">Fleet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : {{ $rent->personFleet  }}</p>
        @endisset
        @isset($rent->personWorkshop)
        <p class="names">Workshop &nbsp;  : {{ $rent->personWorkshop  }}</p>
        @endisset
        @isset($rent->personAccountant)
        <p class="names">Accountant : {{ $rent->personAccountant  }}</p>
        @endisset
    </div>
    @endif
    <br>

    @if (trim($rent->receiver_name) != "" || trim($rent->receiver_mobile_number) != "" || trim($rent->receiver_national_id)  != "" || trim($rent->receiver_location)  != "" )
    <div>
        <h5>This will be received by: </h5>
        @isset($rent->receiver_name)
        <p class="names">Full Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :  {{ $rent->receiver_name  }}</p>
        @endisset
        @isset($rent->receiver_mobile_number)
        <p class="names">Mobile No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : {{ $rent->receiver_mobile_number  }}</p>
        @endisset
        @isset($rent->receiver_national_id)
        <p class="names">National ID No. &nbsp;  : {{ $rent->receiver_national_id  }}</p>
        @endisset
        @isset($rent->receiver_location)
        <p class="names">Final Location &nbsp; &nbsp;  : {{ $rent->receiver_location  }}</p>
        @endisset
    </div>
    @endif
    <br>
    <br>
    <br>
    <div>
        <span>___________________________</span><br>
        <span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Signature</span>
    </div>
</body>

</html>
