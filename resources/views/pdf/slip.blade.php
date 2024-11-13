<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }

        .invoice-container {
            background-color: #fff;
            width: 70%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: right;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header h2 {
            margin: 0;
            font-size: 32px;
            color: #333;
        }

        .invoice-header p {
            margin: 5px 0;
            font-size: 16px;
            color: #888;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: right;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        td {
            color: #555;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2><img src="{{ asset('upload/logo/shahab.jpg') }}" height="200px" width="200px" alt="Logo" /></h2>
            <p>شهاب خیاطی و رخت فروشی</p>
        </div>

        <table>
            <tr>
                <th>نام</th>
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <th>کالیو نمبر</th>
                <td>{{ $data['clothNumber'] }}</td>
            </tr>
            <tr>
                <th>تلفن نمبر</th>
                <td>{{ $data['phone'] }}</td>
            </tr>
            <tr>
                <th>اندازه</th>
                <td>{{ $data['amount'] }}</td>
            </tr>
            <tr>
                <th>قیمت</th>
                <td>{{ $data['price'] }}</td>
            </tr>
            <tr>
                <th>وصول پیسی</th>
                <td>{{ $data['prepaid'] }}</td>
            </tr>
            <tr>
                <th>اخری نیټه</th>
                <td>{{ $data['due_price'] }}</td>
            </tr>
            <tr>
                <th>د سپارولو نیټه</th>
                <td>{{ $data['delivery_date'] }}</td>
            </tr>
            <tr>
                <th>د ثبت نیټه</th>
                <td>{{ $data['created_at'] }}</td>
            </tr>
            <tr>
                <th>د معلوماتو بدلون نیټه</th>
                <td>{{ $data['updated_at'] }}</td>
            </tr>
        </table>

        <div class="total">
            <p>مجموعه: {{ $data['price'] }}</p>
            <p>باقی پیسی: {{ $data['price'] - $data['prepaid'] }}</p>
        </div>

        <div class="footer">
            <p>له موږ سره د کاروبار کولو لپاره مننه!</p>
            <p>د چاپ نیټه: {{ date('d/m/Y') }}</p>
        </div>
    </div>
</body>

</html>