@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="container-fluid">
        <div class="py-4">
            <p class="page-title">Dashboard</p>
        </div>
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 mb-2">
                <div class="bg-pink">
                    <div class="info-box">
                        <div class="info-icon">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="info-content">
                            <p>New Tasks</p>
                            <h3>125</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-2">
                <div class="bg-cyan">
                    <div class="info-box">
                        <div class="info-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="info-content">
                            <p>New Tickets</p>
                            <h3>125</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-2">
                <div class="bg-light-green">
                    <div class="info-box">
                        <div class="info-icon">
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <div class="info-content">
                            <p>New Comments</p>
                            <h3>125</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-2">
                <div class="bg-orange">
                    <div class="info-box">
                        <div class="info-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="info-content">
                            <p>New Visitors</p>
                            <h3>125</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--Month wise chart--}}
        <div class="row">
            <div class="col-xl-12 charts mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Month Wise</h4>
                        <div class="chart-container">
                            <canvas id="month_wise" height="400" width="1595" style="display: block; box-sizing: border-box; height: 400px; width: 1595px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--Datatable--}}
        <div class="row mb-4">
            <div class="col-xl-8 col-lg-12 mb-4">
                <div class="card rounded-0">
                    <div class="p-3 border-bottom">
                        <h4>TASK INFOS</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th>Manager</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Task A</td>
                                    <td><span class="data-status bg-cyan">Doing</span></td>
                                    <td>Salik Munir</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Task B</td>
                                    <td><span class="data-status bg-light-blue">To do</span></td>
                                    <td>Ibrahim Beaker</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Task C</td>
                                    <td><span class="data-status bg-light-green">Completed</span></td>
                                    <td>Ghulam Farid</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Task D</td>
                                    <td><span class="data-status bg-orange">On Hold</span></td>
                                    <td>Attia Naseer</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Task E</td>
                                    <td><span class="data-status bg-red">Suspended</span></td>
                                    <td>Umar Draz</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 charts">
                <div class="card rounded-0">
                    <div class="ps-3 pt-3 border-bottom">
                        <h4>Application Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="application_status" width="341" height="400" style="display: block; box-sizing: border-box; height: 400px; width: 341px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('admin/js/Chart.js')}}"></script>
    <script src="{{asset('admin/js/dashboard.js')}}"></script>
@endpush
