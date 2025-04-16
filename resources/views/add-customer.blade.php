<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
@if(session('success'))
    <div style="color: green; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif
    <div class="container mt-5">
        <h2>Add New Customer</h2>
        <div style="text-align: right; margin-bottom: 20px;">
    <a href="{{ route('customers.index') }}" class="btn btn-primary">View Customers</a>
</div>
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Customer</button>
        </form>
    </div>
    </body>
</html>
