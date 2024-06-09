@php use App\Models\UserRoles; @endphp
@extends('template')
@section('content')


    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0 d-inline">Available User List</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>E-mail Address</th>
                                <th>Type</th>
                                <th>Created Date</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php($count = 0)
                                @foreach($data as $user)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ substr($user->name, 0, 50) }}</td>
                                    <td>{{ substr($user->email, 0, 50) }}</td>
                                    <td>
                                        <div class="badge {{ UserRoles::getPill($user->type) }}">{{ $user->type }}</div>
                                    </td>
                                    <td>{{ substr($user->created_at, 0, 50) }}</td>
                                    <td>{{ number_format($user->wallet ? $user->wallet->balance : 0, 2) }}</td>
                                    <td>
                                        @if($user->type == UserRoles::user)
                                            <a class="p-md-1" href="/users/{{ $user->id }}"><i data-feather="eye" class="icon-sm mr-sm-2"></i>Detail</a>
                                        @endif
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

@endsection
