<x-guest-layout>
    <img src="{{ asset('assets/img/500.svg') }}" alt="Not found">
    <h1>Une erreur est survenue lors du traitement de votre requête. Veullez contacter votre administrateur.</h1>
        <x-nav-link href="{{ url()->previous() }}">Retour</x-nav-link>
</x-guest-layout>
