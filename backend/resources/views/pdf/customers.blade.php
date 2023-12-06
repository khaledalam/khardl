<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer PDF</title>
    <style >
      /* Bootstrap 4.5 styles */
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
      
      /* Your additional styles */
      body {
          background-color: #f8f9fa;
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
  </style>
</head>

<body class="bg-light">

    @foreach($data as $customer)
    <div class=" mt-5">

        <div class="mb-4">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                       <th class="text-left">{{__('Customer ID')}}</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> #{{ $customer->id }}</td>
                        <td>{{ $customer->full_name }}</td>
                        <td> {{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

 
    </div>
    @endforeach

</body>

</html>