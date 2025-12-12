{{-- Vista Dashboard Blade Wrapper --}}
@extends('layouts.app')

@section('content')
<div id="vista-dashboard"></div>
@endsection

@push('scripts')
@vite('resources/js/dashboard/app.js')
@endpush
