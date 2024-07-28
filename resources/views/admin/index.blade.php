<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>
<body>
<h1>Subscription Transactions</h1>
<table id="subscriptions-table" class="display">
    <thead>
    <tr>
        <th>ID</th>
        <th>Device ID</th>
        <th>Product ID</th>
        <th>Receipt Token</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#subscriptions-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/api/admin/subscriptions',
            columns: [
                { data: 'id' },
                { data: 'device_id' },
                { data: 'product_id' },
                { data: 'receipt_token' },
                { data: 'created_at' },
                { data: 'updated_at' },
            ]
        });
    });
</script>
</body>
</html>
