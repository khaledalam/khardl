<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order PDF</title>
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

    @foreach($data as $order)
    <div class=" mt-5">

        <div class="mb-4">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                       <th class="text-left">Order ID</th>
                        <th class="text-left">Transaction ID</th>
                        <th class="text-left">User #{{ $order->user_id }} </th>
                        <th class="text-left">Branch #{{ $order->branch_id }}</th>
                        <th class="text-left">Payment Method</th>
                        <th class="text-left">Total</th>
                        <th class="text-left">Delivery Type</th>
                        <th class="text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Order #{{ $order->id }}</td>
                        <td>{{ $order->transaction_id }}</td>
                        <td> {{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                        <td>{{ $order->branch->name }}</td>
                        <td>{{ $order->payment_method->name }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ str_replace('_', ' ', $order->delivery_type) }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-left">#</th>
                        <th class="text-left">Item Name</th>
                        <th class="text-left">Quantity</th>
                        <th class="text-left">Price</th>
                        <th class="text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $index => $cart)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $cart->item->description }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>{{ $cart->price }}</td>
                        <td>{{ $cart->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach

</body>

</html>