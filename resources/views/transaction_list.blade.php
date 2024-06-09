@php use App\Models\TransactionType; @endphp
@extends('template')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0 d-inline">Available Transaction List</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Full Name</th>
                                <th>E-mail Address</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Transaction Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($count = 0)
                            @foreach($data as $tran)
                                <tr>
                                    <td>{{ $tran->id }}</td>
                                    <td>{{ $tran->wallet->user->name }}</td>
                                    <td>{{ $tran->wallet->user->email }}</td>
                                    <td>
                                        <div
                                            class="badge {{ TransactionType::getPill($tran->type) }}">{{ $tran->type }}</div>
                                    </td>
                                    <td>{{ number_format($tran->amount, 2) }}</td>
                                    <td>{{ $tran->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
