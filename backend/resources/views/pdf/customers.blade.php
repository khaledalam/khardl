<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer PDF</title>
    <style>
        /* Bootstrap 4.5 styles */
        .bg-light {
            position: relative;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody+tbody {
            border: 0;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }



        .mt-5 {
            margin-top: 3rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .display-4 {
            font-size: 2.5rem;
            font-weight: 300;
            line-height: 1.2;
        }

        .bottom-left {
            position: absolute;
            bottom: 40px;
            right: 0;
            z-index: 999;
            /* Ensure it's above other content */
        }

        .bottom-left div {
            display: inline-block;
            vertical-align: middle;
        }

        .bottom-left div {
            line-height: 30px;
            /* Adjust line height for vertical alignment */
        }

        .copyright-container {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 200px;
            /* Adjust the width as needed */
            text-align: right;
            padding: 10px;
            font-size: 12px;
            /* Adjust font size */
            color: #555;
            /* Adjust text color */
        }

    </style>
</head>
<body class="bg-light">
    <div class="table-responsive">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
            <!--begin::Table head-->
            <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="text-left">{{__('Customer ID')}}</th>
                    <th class="text-left">{{ __('Name') }}</th>
                    <th class="text-left">{{ __('Email') }}</th>
                    <th class="text-left">{{ __('Phone') }}</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-bold text-gray-600">
                @foreach($data['customers'] as $key => $customer)
                <!--begin::Table row-->
                <tr>
                    <td> #{{ $customer->id }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td> {{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <!--end::Action=-->
                </tr>
                <!--end::Table row-->
                @endforeach
            </tbody>
            <!--end::Table head-->
        </table>
        <!--end::Table-->
    </div>
    <div class="bottom-left">
        <img src="{{ $data['logo'] }}" style="max-width:50px;border-radius:10px!important;" />
        <div class="d-flex">{{ $data['restaurant_name'] }}</div>
    </div>
    <div class="copyright-container">
        {{ __('All copyright reserved to khardl.com') }}
    </div>
</body>
</html>
