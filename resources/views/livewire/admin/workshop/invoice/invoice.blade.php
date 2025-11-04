<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .page-break {
            page-break-after: always;
        }

        .w-fit {
            width: fit-content;
        }

        .h-8 {
            height: 2rem;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .text-xs {
            font-size: 0.75rem
                /* 12px */
            ;
            line-height: 1rem
                /* 16px */
            ;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-2xl {
            font-size: 1.5rem
                /* 24px */
            ;
            line-height: 2rem
                /* 32px */
            ;
        }

        .w-full {
            width: 100%;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;

        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #1d1d1d;
            color: white;
        }

        .pending {
            color: rgb(238, 25, 25);
        }

        .paid {
            color: rgb(87, 202, 87);
        }
    </style>
</head>

<body>
    <div class="w-full">
        {{-- <span  class="text-xs font-semibold" style="width: 100%;opacity:.7;">ORDER ID: {{ $customer->OrderTrackNumber }}</span>
        <span class="font-semibold" style="margin-left: 640px;opacity:.7;font-size:12px;">{{ $customer->MethodPayment }}</span> --}}
        <h3 style="margin-block: 1rem;" class="text-2xl">CUSTOMER INVOICE</h3>

        <div style="margin-bottom: 3rem;">
            <div class="w-full overflow-x-auto">
                <div style="display: flex;justify-content:space-between;align-items:center;width:640px;">
                    <p style="font-weight:600;font-size:1.4rem;">Services</p>
                </div>
                <table id="customers">
                    <tr>
                        <th>Service Fee (SAR)</th>
                        <th>Workshop Fee (SAR)</th>
                        <th>Unit Amount (SAR)</th>
                        <th>Total Amount (SAR)</th>
                    </tr>
                    @foreach ($services as $service)
                        <tr wire:key='{{ $service->id }}'>
                            <td>{{ $service->ServiceFee }}</td>
                            <td>{{ $service->WorkshopFee }}</td>
                            <td>{{ $service->UnitAmount }}</td>
                            <td>{{ $service->TotalAmount }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div style="margin-block: 3rem;">
            <p class="text-sm font-semibold">Invoice Information</p>
            <hr>
            <div style="opacity: .8; margin-top:1rem;" class="text-xs font-semibold">
                <p>CUSTOMER: {{ $customer->Customer_Name ?? '' }}</p>
                <p>SUBTOTAL: SAR {{ $customer->SubTotal ?? '' }}</p>
                <p>BALANCE AMOUNT: SAR {{ $customer->Balance_Amount ?? '' }}</p>
                <p>DATE:{{ date('Y-m-d', strtotime($customer->created_at)) }}</p>
                <br>
            </div>
        </div>

        <hr>
        <p style="font-size:12px; opacity:.7;font-weight:600;">alesnaad </p>

        {{-- <div class=".page-break ">Thank you for purchasing...</div> --}}
    </div>
</body>

</html>
