@extends('dashboard.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <x-email-alert />
        </div>
    </div>
    <div class="row ">
        <div class="col-12">
            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 col-md">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header-title">All Completed Supprts Request</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive ">
                    <table id=""
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th>Contest</th>
                                <th>Password</th>
                                <th>Winner</th>
                                <th>Create Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($participate as $row)
                                <tr>
                                    <td>
                                        <a class="media align-items-center" href="">
                                            <div class="media-body">
                                                <span class="d-block h5 text-hover-primary mb-0"> {{ $row->contest->contest }} </span>
                                            </div>
                                        </a>
                                    </td>
                                    
                                    <td>
                                        <span class="d-block h5 mb-0">{{ ($row->contest->status == "Complete" || $row->contest->status == "Investigate") ? $row->password : "*****************"  }}</span>
                                    </td>
                                    <td>
                                        <span class="d-block h5 mb-0">{{ ($row->winner == 1) ? "Yes" : "No" }}</span>
                                    </td>
                                    <td>
                                        <span class="d-block h5 mb-0">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($row->created_at))->diffForHumans() }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        {{ $participate->links() }}
                    </div>
                    <!-- End Pagination -->
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Card -->
        </div>
    </div>
@endsection
