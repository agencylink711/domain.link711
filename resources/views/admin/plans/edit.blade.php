@extends('admin.layout.app')

@section('title', 'Subscription')

@section('page_name', 'Subscription')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Subscription</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('plans.update', $plan->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $plan->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" name="price" id="price"
                                        value="{{ $plan->price }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>API Calls</label>
                                    <input type="number" class="form-control" name="api_calls" id="api_calls"
                                        value="{{ $plan->api_calls }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Billing Period</label>
                                    <select name="billing_period" id="billing_period" class="form-control" required>
                                        @foreach ($periods as $item)
                                            <option value="{{ $item }}"
                                                @if ($plan->billing_period === $item) selected @endif>{{ $item->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Duration (Months)</label>
                                    <input type="number" class="form-control" name="duration" id="duration"
                                        value="{{ $plan->duration }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stripe Product ID</label>
                                    <input type="text" class="form-control" name="stripe_id" id="stripe_id"
                                        value="{{ $plan->stripe_id }}">
                                        @error('stripe_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control" required>{{ $plan->description }}</textarea>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
