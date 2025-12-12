{{-- Vista Dashboard Blade Wrapper --}}
@extends('layouts.app')

@section('content')
<div id="vista-app"></div>
@endsection

@push('scripts')
@vite('resources/js/dashboard/App.vue')
@endpush
