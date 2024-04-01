@extends('admin.layout.app')

@section('title', 'Subscription')

@section('page_name', 'Subscription')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Subscription</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('plans.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" name="price" id="price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>API Calls</label>
                                    <input type="number" class="form-control" name="api_calls" id="api_calls" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Billing Period</label>
                                    <select name="billing_period" id="billing_period" class="form-control" required>
                                        @foreach ($periods as $item)
                                            <option value="{{ $item }}">{{ $item->label() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration (Months)</label>
                                    <input type="number" class="form-control" name="duration" id="duration" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stripe Product ID</label>
                                    <input type="text" class="form-control" name="stripe_id" id="stripe_id" required>
                                    @error('stripe_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                                            <a href="{{ route('plans.edit', $item->id) }}" class="btn btn-info">
                                                Edit
                                            </a>
                                            <form action="{{ route('plans.destroy', $item->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
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
