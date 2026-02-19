@extends('dashboard.layout')

@php
    $initial = [
        'user' => $user,
        'role' => 'admin',
        'stats' => $stats,
        'pickups' => $pickups,
        'users' => $users,
    ];
@endphp

@section('content')
@endsection
