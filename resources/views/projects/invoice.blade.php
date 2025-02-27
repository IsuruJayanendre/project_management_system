<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Project Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="header">Project Invoice</h2>
        <p><strong>Client Name:</strong> {{ $project->client_name }}</p>
        <p><strong>Project Name:</strong> {{ $project->project_name }}</p>
        <p><strong>Project Type:</strong> {{ $project->projectType->name }}</p>
        <p><strong>Subcategory:</strong> {{ $project->projectSubcategory->name ?? 'N/A' }}</p>
        <p><strong>Price:</strong> Rs.{{ number_format($project->price, 2) }}</p>
        <p><strong>Start Date:</strong> {{ $project->starting_date }}</p>
        <p><strong>Note:</strong> {{ $project->note }}</p>
    </div>
</body>
</html>
