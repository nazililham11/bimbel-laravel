@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<div class="row">
    <h2 class="ml-3 text-gray-800">Dashboard</h2>
</div>

Welcome {{ get_user()->name }}<br>
<a href="{{ route('admin.logout') }}">Logout</a>

<div class="row">

    @component('components.custom_card', [
        'type' => 'primary',
        'title' => 'Active Teachers',
        'value' => "$user_count Teachers",
        'icon' => 'fas fa-user-tie',
    ])
    @endcomponent

    @component('components.custom_card', [
        'type' => 'success',
        'title' => 'Active Students',
        'value' => "$student_count Students",
        'icon' => 'fas fa-user-graduate',
    ])
    @endcomponent

    @component('components.custom_card', [
        'type' => 'info',
        'title' => 'Reports This Week',
        'value' => "$report_count New Reports",
        'icon' => 'fas fa-tasks',
    ])
    @endcomponent

    @component('components.custom_card', [
        'type' => 'info',
        'title' => 'Exams',
        'value' => "$exam_count Exams",
        'icon' => 'fas fa-file-alt',
    ])
    @endcomponent

</div>
@endsection

