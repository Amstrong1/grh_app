<x-guest-layout>
    <img src="{{ asset('assets/img/404.svg') }}" alt="Not found">
    <h1>Vous tentez d'accéder à une ressource qui n'est pas disponible, contactez votre administrateur pour plus
        d'information</h1>
        <x-nav-link href="{{ route('dashboard') }}">Retour</x-nav-link>
</x-guest-layout>
