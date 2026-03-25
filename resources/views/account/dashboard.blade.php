{{-- Pivlu CE | Copyright (c) Iosif Gabriel Chimilevschi | AGPL-3.0 License | https://pivlu.com --}}
@extends('layouts.account')

@section('title', 'Dashboard - ' . config('app.name'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@endsection

@section('page-header')
    <h4 class="mb-0 fw-bold">Dashboard</h4>
@endsection

@section('content')

    <div class="row g-4">

        {{-- Welcome card --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Welcome back, {{ auth()->user()->name }}!</h5>
                    <p class="card-text" style="color: var(--pv-text-secondary);">
                        This is your Pivlu dashboard. As more apps are enabled, their widgets will appear here.
                    </p>
                </div>
            </div>
        </div>

    </div>

@endsection
