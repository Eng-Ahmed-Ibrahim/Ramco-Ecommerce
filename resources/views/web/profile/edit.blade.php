@extends('web.app')
@php $user=Auth::guard('customer')->user(); @endphp

@section('title', 'Ramco | Edit Account')
@section('css')
@endsection
@section('content')
    <section class="my-5">
        <div class="container">
                       <div class="mb-2">
                <span class="muted-color">Home</span> /  <span class="muted-color">Profile</span> / <span class="text-black">Profile</span>
            </div>
            <form action="{{ route('web.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{ old('phone', $user->phone) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-text">Leave empty if you don't want to change it.</div>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="5">{{ old('address', $user->address) }}</textarea>
                </div>

                <button type="submit" class="main-btn w-100">Update Profile</button>
            </form>

        </div>
    </section>
@endsection
@section('js')

@endsection
