<!DOCTYPE html>
<html>
    <head>
        <style>
            .container {
                width: 100%;
                padding: 12px;
            }

            .invoice {
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 6px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .invoice-header {
                padding: 12px;
                border-bottom: 1px solid #ccc;
            }

            .invoice-header h2 {
                font-size: 18px;
                font-weight: bold;
            }

            .invoice-body {
                padding: 12px;
            }

            .customer-info {
                text-align: right;
                margin-right: 20px;
                margin-top: 6px;
            }

            .customer-info p {
                font-weight: bold;
            }

            .rentit-address {
                margin-left: 14px;
                margin-bottom: 12px;
            }

            .work-order {
                font-weight: bold;
                font-size: 14px;
                margin-left: 14px;
            }

            .reference {
                display: flex;
                margin-top: 8px;
            }

            .description,
            .amount {
                border-bottom: 1px solid #000;
            }

            .amount {
                display: flex;
                justify-content: center;
            }

            .payment-info {
                margin-left: 14px;
                margin-top: 32px;
                margin-bottom: 4px;
                float: left;
            }
        </style>
        <title>Werkbon</title>
    </head>
    <body>
        <div class="container">
            <div class="invoice">
                <div class="invoice-header">
                    <h2>Werkbon</h2>
                </div>
                <div class="invoice-body">
                    <div style="display: flex; justify-content: space-between;">
                        <div class="customer-info">
                            <p>{{ $data->Tenants->firstname }} {{ $data->Tenants->lastname }}</p>
                            <p>{{ $data->Tenants->email }}</p>
                            <p>{{ $data->Tenants->Properties[0]->street }}{{ $data->Tenants->Properties[0]->house_number }}</p>
                            <p>{{ $data->Tenants->Properties[0]->postal_code }} {{ $data->Tenants->Properties[0]->city }}</p>
                        </div>
                    </div>
                    <div class="rentit-address">
                        <p>RentIT</p>
                        <p>Knipplein 11</p>
                        <a>4702 GN Roosendaal</a>
                    </div>
                    <div class="work-order">
                        <p>Werkbon</p>
                        <div class="reference">
                            <p class="font-medium">Reference: &#160;</p>
                            <p>Offerte {{ $data->id }}</p>
                        </div>
                        <div>
                            <table class="mt-12 min-w-full">
                                <thead>
                                    <tr>
                                        <th class="description">Omschrijving</th>
                                        <th class="amount">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $data->MalfunctionsHandling->material }}</td>
                                        <td class="amount">€{{ $data->MalfunctionsHandling->cost }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kilometers: {{ $data->MalfunctionsHandling->mileage }}</td>
                                        <td class="amount">€{{ $data->MalfunctionsHandling->mileage * 0.21 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="payment-info">Te betalen binnen 14 dagen op rekeningnummer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    window.onload = function() {
        window.location.href = {{ route('workorder.index') }};
    };
</script>
