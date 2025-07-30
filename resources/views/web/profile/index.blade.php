@extends('web.app')
@php $user=Auth::guard('customer')->user(); @endphp
@section('title', 'Ramco | My Account ')
@section('css')
    <style>
        .section-title {
            color: #444;
            font-size: 30px;
            font-style: normal;
            font-weight: 700;
            line-height: 69px;
        }
        .profile-title{
            font-size: 20px;
            font-weight: bold;
        }
        .color-danger{
            color: red;
        }
    </style>
@endsection
@section('content')
    <section class="my-5">
        <div class="container">
            <div class="mb-2">
                <span class="muted-color">Home</span> / <span class="text-black">Profile</span>
            </div>
            <div class="d-flex gap-2 align-items-center my-4">
                <a href="{{ route('web.profile.index') }}" class="main-btn main-btn-sm">Account</a>
                <a  href="{{ route('web.profile.orders') }}" class="main-btn-no-bg main-btn-sm">My Orders</a>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="section-title">My Account</div>
                <div>
                    <a href="{{ route('web.profile.edit') }}" class="main-btn main-btn-sm">Edit <i class="fa-solid fa-pencil"></i></a>
                </div>
            </div>

            <div class="mb-3">
                <div class="mb-2">Full Name</div>
                <div class="profile-title">{{ $user->name }}</div>
            </div>

            <div class="mb-3">
                <div class="mb-2">Contact Number</div>
                <div class="profile-title  {{ $user->phone ? ' ' : 'color-danger' }}">{{ $user->phone ?? "No phone added yet." }}</div>
            </div>
            <div class="mb-3">
                <div class="mb-2">Email Address</div>
                <div class="profile-title">{{ $user->email}}</div>
            </div>
            <div class="mb-3">
                <div class="mb-2">Address</div>
                <div class="profile-title {{ $user->address ? ' ' : 'color-danger' }}" style="white-space: pre-line;">{{ $user->address ?? "No address added yet." }}</div>
            </div>

        </div>
    </section>
@endsection
@section('js')

@endsection
