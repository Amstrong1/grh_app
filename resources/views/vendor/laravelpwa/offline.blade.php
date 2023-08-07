{{-- @extends('layouts.guest')

@section('content')

    <h1>You are currently not connected to any networks.</h1>

@endsection --}}

<x-guest-layout>
    <img src="{{ asset('assets/img/offline.svg') }}" alt="offline">
    <h1>Vous n'avez pas accès à internet</h1>
</x-guest-layout>