@php
use App\Models\TransactionType; @endphp

@extends('template')
@section('content')
    <div class="row">
        <div class="col-md-4 chat-aside border-lg-right ">
            <div class="aside-content">
                <div class="aside-body">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <center><img alt="Profile Image" style="border-radius: 50%" class="profile-pic"
                                             src="{{ asset('images/default_profile.png') }}" height="100px"
                                             width="100px"></center>
                            </div>
                            <div class="form-group">
                                    <label class="control-label">Full Name</label>
                                    <input readonly type="text" class="form-control" placeholder="Enter name"
                                           value="{{  $data->name }}" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email Address</label>
                                <input readonly type="text" class="form-control" placeholder="Enter description"
                                       value="{{  $data->email }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Date Registered</label>
                                <input readonly type="text" class="form-control" placeholder="Enter description"
                                       value="{{  $data->created_at }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">User Role</label>
                                <input readonly type="text" class="form-control" placeholder="Enter description"
                                       value="{{  $data->type }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0 d-inline">Available Transaction List</h6>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($data->wallet->transactions))
                                @foreach($data->wallet->transactions as $tran)
                                    <tr>
                                        <td>{{ $tran->id }}</td>
                                        <td>
                                            <div
                                                class="badge {{ TransactionType::getPill($tran['type'])  }}">{{ $tran['type']}}
                                            </div>
                                        </td>
                                        <td>
                                            {{ number_format($tran->amount, 2) }}
                                        </td>
                                        <td>{{ $tran->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center text-uppercase mt-3 mb-4">Wallet Balance</h5>
                            <h3 class="text-center font-weight-light">
                                NGN {{ number_format($data->wallet->balance, 2) }}</h3>

                            <form method="post" id="walletOp">
                                @csrf
                                <div class="form-group">
                                    <input type="number" class="form-control" name="amount" id="amount">
                                    <input type="hidden" class="form-control" name="wallet_id" value="{{ $data->wallet->id  }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-success text-white btn-block"
                                                onclick="walletOperation('/wallet/credit')"><i data-feather="plus"
                                                                                                 class="icon-sm mr-sm-2"></i>
                                            Fund Wallet
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger text-white btn-block"
                                                onclick="walletOperation('/wallet/debit')"><i data-feather="minus"
                                                                                                    class="icon-sm mr-sm-2"></i>Remove
                                            Fund
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function walletOperation($url) {
            const $amount = $("#amount").val();
            if ($amount === '') {
                alert("Invalid Amount");
                return;
            }
            const formData = $("form#walletOp").serialize();
            $.ajax({
                type: "POST",
                url: $url,
                data: formData,
                success: function(response) {
                    alert(response.message); // Alert the user with the response message
                    location.reload(); // Refresh the page
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    alert('Insufficient Fund!!!.');
                }
            });
        }
    </script>
@endsection


