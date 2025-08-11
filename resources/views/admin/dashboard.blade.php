@extends('admin.layouts.master')
@section('title')
    Dashboard
@endsection
@section('main-content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body text-center">
            <p class="lead text-success">
                <i class="fas fa-check-circle"></i> {{ __("You're logged in!") }}
            </p>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row text-center">
                    <div class="col-md-2">
                        <div class="card shadow-sm border-0">
                            <div class="card-body bg-dark">
                                <h5 class="card-title">
                                    <i class="fas fa-store text-warning"></i> Stores
                                </h5>
                                <p class="card-text fs-4">{{ $stores->count() }}</p>
                                <a href="{{route('admin.stores')}}" class="text-warning">View Details <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Blogs -->
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h5><i class="fas fa-blog text-white"></i> Blogs</h5>
                                <p>{{ $blogs->count() }}</p>
                            </div>
                            <a href="{{route('admin.blog.show')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h5><i class="fas fa-list text-info"></i> Categories</h5>
                                <p>{{ $categories->count() }}</p>
                            </div>
                            <a href="{{route('admin.category')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Networks -->
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h5><i class="fas fa-network-wired text-danger"></i> Networks</h5>
                                <p>{{ $networks->count() }}</p>
                            </div>
                            <a href="{{route('admin.network')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Coupons -->
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h5><i class="fas fa-ticket-alt text-success"></i> Coupons</h5>
                                <p>{{ $coupons->count() }}</p>
                            </div>
                            <a href="{{route('admin.coupon')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h5><i class="fas fa-language text-white"></i> Language</h5>
                                <p>{{ $langs->count() }}</p>
                            </div>
                            <a href="{{route('admin.lang')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                      <!-- Users -->
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h5><i class="fas fa-user text-white"></i> Users</h5>
                                <p>{{ $users->count() }}</p>
                            </div>
                            <a href="{{route('admin.user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>


                <div class="row">



                </div>

            </div>
        </section>

    </div>
@endsection
