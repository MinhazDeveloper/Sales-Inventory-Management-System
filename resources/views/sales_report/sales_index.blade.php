<!-- resources/views/sales_report.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .report-container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
        }
        input[type="date"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }
        .btn-download {
            background-color: #800080; /* Purple color */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-download:hover {
            background-color: #5a005a; /* Darker purple on hover */
        }
    </style>
</head>
<body>

<div class="report-container">
    <h2>Sales Report</h2>
    <form action="{{ route('sales.report.generate') }}" method="POST">
        @csrf
        <label>Date From</label>
        <input type="date" name="date_from" required>

        <label>Date To</label>
        <input type="date" name="date_to" required>

        <button type="submit" class="btn-download">DOWNLOAD</button>
    </form>
</div>

</body>
</html>
