@extends('layouts.restaurant-sidebar')

@section('title', __('messages.profile'))


@section('content')
    <h3>Edit profile</h3>
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    @if ($user->isApproved == 0)
    <div class="alert alert-warning">
      Your account is on pending, you will get e-mail notification once you get approved or denied.
    </div>
    @elseif ($user->isApproved == 1)
          <div class="alert alert-success">
            Your account is approved. Congratulations!
          </div>
    @endif
    <form action="{{ route('restaurant.profile-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
        </div>
        <div class="mb-3">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="last_name" value="{{ $user->last_name }}" name="last_name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone </label>
          <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
        </div>
        @if ($user->isApproved === 2)
            <div class="alert alert-danger">
                Your approval got denied, to apply again you will have to refill needed documents:
            </div>

            @if($user->commercial_registration_pdf == null)
              <div class="mb-3">
                <label for="commercial_registration" class="form-label">Commercial Registration</label>
                <input type="file" class="form-control" id="commercial_registration" name="commercial_registration" accept="image/*, application/pdf" required>
              </div>
            @endif

            @if($user->signed_contract_delivery_company == null)
              <div class="mb-3">
                <label for="delivery_contract" class="form-label">Delivery Contract</label>
                <input type="file" class="form-control" id="delivery_contract" name="delivery_contract" accept="image/*, application/pdf" required>
              </div>
            @endif
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>

      </form>
@endsection
