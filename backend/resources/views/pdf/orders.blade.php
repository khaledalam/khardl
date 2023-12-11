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
        bottom: 0;
        left: 0;
        width: calc(100% - 200px); /* Adjust the width as needed */
        pointer-events: none; /* Prevent the fixed element from blocking clicks */
        z-index: 999; /* Ensure it's above other content */
    }

    .bottom-left img,
    .bottom-left div {
        display: inline-block;
        vertical-align: middle;
    }

    .bottom-left img {
        width: 30px; /* Adjust image width */
        height: 30px; /* Adjust image height */
        margin-right: 10px; /* Add margin between image and name */
    }

    .bottom-left div {
        line-height: 30px; /* Adjust line height for vertical alignment */
    }

    .copyright-container {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 200px; /* Adjust the width as needed */
        text-align: right;
        padding: 10px;
        font-size: 12px; /* Adjust font size */
        color: #555; /* Adjust text color */
    }
  </style>
</head>

<body class="bg-light">
    
    @foreach($data['orders'] as $order)
    <div class=" mt-5">

        <div class="mb-4">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th class="text-left">{{__('Order ID')}}</th>
                        <th class="text-left">{{__('Transaction ID')}}</th>
                        <th class="text-left">{{__('User')}} #{{ $order->user_id }} </th>
                        <th class="text-left">{{__('Branch')}} #{{ $order->branch_id }}</th>
                        <th class="text-left">{{__('Payment Method')}}</th>
                        <th class="text-left">{{__('Total')}}</th>
                        <th class="text-left">{{__('Delivery Type')}}</th>
                        <th class="text-left">{{__('Status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{__('order')}} #{{ $order->id }}</td>
                        <td>{{ $order->transaction_id }}</td>
                        <td> {{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                        <td>{{ $order->branch->name }}</td>
                        <td>{{ $order->payment_method->name }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->delivery_type->name }}</td>
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
                        <th class="text-left">{{__('Item Name')}}</th>
                        <th class="text-left">{{__('Quantity')}}</th>
                        <th class="text-left">{{__('Price')}}</th>
                        <th class="text-left">{{__('Total')}}</th>
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
        <div class="page-break"></div>
        <div class="bottom-left">
            <img src="{{ $data['logo'] }}" style="width: 20px; height: 20px;" />
            <div class="">{{ $data['restaurant_name'] }}</div>
        </div>

        <div class="copyright-container">
            All copyright reserved to khardl.com
        </div>
    </div>
  
    @endforeach

</body>

</html>