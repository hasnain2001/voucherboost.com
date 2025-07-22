@extends('employee.layouts.master')

@section('title')
   Employee Dashboard
@endsection

@section('main-content')
    <div class="content-wrapper">


        <!-- Main Content -->
        <div class="container-fluid py-4">
            <!-- Welcome Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-success shadow-sm">
                        <h4 class="mb-0">
                            Welcome back, <strong>{{ Auth::user()->name }}</strong>!
                        </h4>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-md-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-blog text-primary"></i> Blogs
                            </h5>
                            <p class="card-text fs-4">{{ $blogs->count() }}</p>
                            <a href="{{route('employee.blog.index')}}" class="text-primary">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-list text-info"></i> Categories
                            </h5>
                            <p class="card-text fs-4">{{ $categories->count() }}</p>
                            <a href="{{route('employee.category')}}" class="text-info">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-network-wired text-danger"></i> Networks
                            </h5>
                            <p class="card-text fs-4">{{ $networks->count() }}</p>
                            <a href="{{route('employee.network')}}" class="text-danger">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-ticket-alt text-success"></i> Coupons
                            </h5>
                            <p class="card-text fs-4">{{ $coupons->count() }}</p>
                            <a href="{{route('employee.coupon')}}" class="text-success">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-store text-warning"></i> Stores
                            </h5>
                            <p class="card-text fs-4">{{ $stores->count() }}</p>
                            <a href="{{route('employee.stores')}}" class="text-warning">View Details <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Charts Section -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Sales Overview</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Traffic Overview</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="trafficChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Example Chart.js configuration
        const salesChart = new Chart(document.getElementById('salesChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Sales',
                    data: [1200, 1900, 3000, 5000, 2500],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                responsive: true
            }
        });

        const trafficChart = new Chart(document.getElementById('trafficChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Direct', 'Referral', 'Social'],
                datasets: [{
                    data: [55, 25, 20],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endsection
