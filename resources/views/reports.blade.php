<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

    </style>
</head>

<body>

    @include('nav')

    <div class="container mt-5">
        <h2 class="text-center mb-4">System Reports</h2>

        <ul class="nav nav-tabs" id="reportTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="fileType-tab" data-bs-toggle="tab" data-bs-target="#fileType"
                    type="button" role="tab" aria-controls="fileType" aria-selected="true"
                    style="color: #0d6efd; background-color:rgb(6, 126, 246); border: 1px solid #dee2e6; border-bottom: none; padding: 10px 16px; font-weight: 500;">
                    File Types
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="userRegistration-tab" data-bs-toggle="tab"
                    data-bs-target="#userRegistration" type="button" role="tab" aria-controls="userRegistration"
                    aria-selected="false"
                    style="color: #0d6efd; background-color:rgb(6, 126, 246); border: 1px solid #dee2e6; border-bottom: none; padding: 10px 16px; font-weight: 500;">
                    User Registration Trend
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="birthYear-tab" data-bs-toggle="tab" data-bs-target="#birthYear"
                    type="button" role="tab" aria-controls="birthYear" aria-selected="false"
                    style="color: #0d6efd; background-color:rgb(6, 126, 246); border: 1px solid #dee2e6; border-bottom: none; padding: 10px 16px; font-weight: 500;">
                    Users by Birth Year
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="fileUpload-tab" data-bs-toggle="tab" data-bs-target="#fileUpload"
                    type="button" role="tab" aria-controls="fileUpload" aria-selected="false"
                    style="color: #0d6efd;background-color:rgb(6, 126, 246); border: 1px solid #dee2e6; border-bottom: none; padding: 10px 16px; font-weight: 500;">
                    File Uploads Trend
                </button>
            </li>
        </ul>


        <!-- Tab Content -->
        <div class="tab-content" id="reportTabsContent">
            <div class="tab-pane fade show active" id="fileType" role="tabpanel" aria-labelledby="fileType-tab">
                <div class="mt-4">
                    <h5>File Types (Pie Chart)</h5>
                    <canvas id="fileTypeChart"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="userRegistration" role="tabpanel" aria-labelledby="userRegistration-tab">
                <div class="mt-4">
                    <h5>User Registration Trend (Line Chart)</h5>
                    <canvas id="userRegistrationChart"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="birthYear" role="tabpanel" aria-labelledby="birthYear-tab">
                <div class="mt-4">
                    <h5>Users by Birth Year (Bar Chart)</h5>
                    <canvas id="birthYearChart"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="fileUpload" role="tabpanel" aria-labelledby="fileUpload-tab">
                <div class="mt-4">
                    <h5>File Uploads Trend (Line Chart)</h5>
                    <canvas id="fileUploadChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // File Types Chart
        new Chart(document.getElementById('fileTypeChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($fileTypes->pluck('type')) !!},
                datasets: [{
                    data: {!! json_encode($fileTypes->pluck('count')) !!},
                    backgroundColor: ['#f87979', '#a2d5f2', '#b4f2e1', '#ffe066'],
                }]
            }
        });

        // User Registration Trend Chart
        new Chart(document.getElementById('userRegistrationChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($userRegistrations->pluck('month')) !!},
                datasets: [{
                    label: 'User Registrations',
                    data: {!! json_encode($userRegistrations->pluck('total')) !!},
                    borderColor: '#48A6A7',
                    fill: false
                }]
            }
        });

        // Users by Birth Year Chart
        new Chart(document.getElementById('birthYearChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($birthYears->pluck('year')) !!},
                datasets: [{
                    label: 'Users by Birth Year',
                    data: {!! json_encode($birthYears->pluck('count')) !!},
                    backgroundColor: '#2973B2'
                }]
            }
        });

        // File Uploads Trend Chart
        new Chart(document.getElementById('fileUploadChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($fileUploads->pluck('month')) !!},
                datasets: [{
                    label: 'File Uploads',
                    data: {!! json_encode($fileUploads->pluck('total')) !!},
                    borderColor: '#9ACBD0',
                    fill: false
                }]
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>