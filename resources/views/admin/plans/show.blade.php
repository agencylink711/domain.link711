@extends('admin.layout.app')

@section('title', 'Subscription')

@section('page_name', 'Subscription')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Subscription List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Billing Period</th>
                                <th>API Calls</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>${{ $item->price }}</td>
                                    <td>{{ $item->duration }} month(s)</td>
                                    <td>{{ $item->billing_period->label() }}</td>
                                    <td>{{ $item->api_calls }}</td>
                                    <td>
                                        <div class="d-flex" style="gap: 10px">
                                            @if (auth()->user()->subscription_id !== $item->id)
                                                <a href="{{ route('plans.subscribe', $item->id) }}" class="btn btn-info">
                                                    Subscribe
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        })
    </script>
@endsection
