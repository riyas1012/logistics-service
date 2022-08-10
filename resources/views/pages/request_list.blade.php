@extends('layouts.base')

@section('content')
    @push('stylesheet')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap.min.css" />
    @endpush
    @include('layouts.header', ['header_name' => 'Logistics Service Request Form'])
    <div class="container" style="padding:30px 0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Requestor Information
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('request.form') }}" class="btn btn-success pull-right">
                                    New Request Form
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('logout') }}" class="btn btn-success pull-right">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Service</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->user_service_request as $serviceRequestItem)
                                    <tr>
                                        <td>
                                            {{ $serviceRequestItem->name }}
                                        </td>
                                        <td>
                                            {{ $serviceRequestItem->mobile }}
                                        </td>
                                        <td>
                                            {{ $serviceRequestItem->email }}
                                        </td>
                                        <td>
                                            {{ $serviceRequestItem->service_id == 1 ? 'Warehouse Storage' : ($serviceRequestItem->service_id == 2 ? 'Transportation of Goods to Venues' : 'On-Venue Assistance') }}
                                        </td>
                                        <td>
                                            <a href="{{route('service.request.details',['service_request_id'=>$serviceRequestItem->unique_id])}}">
                                                <i class="fa fa-eye fa-1x text-info"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>

        <script>
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    responsive: true
                });

                new $.fn.dataTable.FixedHeader(table);
            });
        </script>
    @endpush
@endsection
