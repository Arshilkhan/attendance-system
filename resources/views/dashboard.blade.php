@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="main">
    <div class="hero-section">
        <div class="hero-left">
            <h1>Manage your attendance like clockwork</h1>
            <p>
                Boost workplace efficiency with a flexible attendance system that lets you check-in
                from the web and mobile app, allows policy customization according to changing work
                preferences, and manages all your attendance information accurately.
            </p>
            <button class="btn" onclick="window.location.href='{{ url('/account') }}'">
                Create Account
            </button>
        </div>

        <div class="hero-right">
            <img src="{{ asset('images/img-bg.webp') }}">
        </div>
    </div>

    <div class="sec-1">
        <div class="sec-1-left">
            <img src="{{ asset('images/img-1.webp') }}">
        </div>

        <div class="sec-1-right">
            <h1>Capture attendance in real time</h1>
            <p>
                Allow your teams to access work from any authorized location or device with IP and
                location-based attendance marking, making the entire process safe and secure.
            </p>
            <button class="btn" onclick="window.location.href='{{ url('/attendance') }}'">
                Get Started →
            </button>
        </div>
    </div>

    <div class="sec-2">
        <h1>Track Attendance</h1>
        <p>
            Incorporated graphs and charts into the record system to provide a clear, visual
            representation of students data.
        </p>

        <h1>Prevent False Entries</h1>
        <p>
            Protect your organization from unauthorized entries by integrating Zoho People with
            biometric attendance systems.
        </p>

        <h1>Quick and Easy to Use</h1>
        <p>
            Created for teachers to quickly and easily mark attendance of the students.
            User friendly and familiar as it uses traditional methods.
        </p>

        <h1>Export Student Data</h1>
        <p>
            Export a .CSV file of the record for each class of the students.
        </p>
    </div>
</div>
@endsection
