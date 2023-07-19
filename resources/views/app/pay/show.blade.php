<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:px-10 text-gray-900">
                    <div class="flex justify-between">
                        <div class="text-sm">
                            <div class="flex items-center align-middle">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center">
                                    <a href="{{ route('dashboard') }}">
                                        <img class="h-14" src="{{ url('storage/' . Auth::user()->structure->logo) }}"
                                            alt="{{ Auth::user()->structure->name }}" loading="lazy">
                                    </a>
                                </div>

                                <!-- Name -->
                                <div class="ml-2 md:flex">
                                    {{ Auth::user()->structure->name }}
                                </div>
                            </div>
                            <div class="my-4">
                                <p>
                                    Siège : {{ Auth::user()->structure->adresse }}
                                </p>
                                <p>
                                    IFU : {{ Auth::user()->structure->ifu }}
                                </p>
                                <p>
                                    RCCM : {{ Auth::user()->structure->rccm }}
                                </p>
                                <p>
                                    Email : {{ Auth::user()->structure->email }}
                                </p>
                                <p>
                                    Tel : {{ Auth::user()->structure->contact }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <h1>
                                BULLETIN DE PAIE
                            </h1>
                            <p>Du {{ $pay->period_start }} au {{ $pay->period_end }}</p>
                            <p>Payé le {{ $pay->pay_date }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div>
                            <p>
                                {{ $pay->user->name . ' ' . $pay->user->firstname }}
                            </p>
                            <p>
                                {{ $pay->user->career->adress }}
                            </p>
                            <p>
                                {{ $pay->user->career->contact }}
                            </p>
                        </div>

                        <div>
                            <p>
                                N° Sécurité Sociale : {{ $pay->user->career->social_security_number }}
                            </p>
                            <p>
                                Matricule : {{ $pay->user->career->matricule }}
                            </p>
                            <p>
                                Date d'entrée : {{ $pay->user->career->registration_date }}
                            </p>
                            <p>
                                Emploi : {{ $pay->user->career->place->name }}
                            </p>
                            <p>
                                Contrat : {{ $pay->user->career->contract }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col m-4">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-sm border">
                                        <thead class="font-medium border">
                                            <tr>
                                                <th scope="col" class="px-6 py-4 text-left">Libellé</th>
                                                <th scope="col" class="px-6 py-4 text-left">Unité</th>
                                                <th scope="col" class="px-6 py-4 text-left">Montant</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-4 font-bold">Salaire de base</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ $pay->user->career->place->basis_wage }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ $pay->user->career->place->basis_wage }}</td>
                                            </tr>

                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-4 font-bold">Montant horaire
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ $pay->user->career->place->hourly_rate }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ $pay->user->career->place->hourly_rate * $pay->hour_done }}</td>
                                            </tr>

                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-4 font-bold">Montant horaire
                                                    supplémentaire</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ $pay->user->career->place->overtime_rate }}
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ $pay->user->career->place->overtime_rate * $pay->overtime_done }}
                                                </td>
                                            </tr>

                                            @if ($payAds->count() !== 0)
                                                <tr>
                                                    <td colspan="3" class="whitespace-nowrap px-6 pt-4 font-semibold italic">
                                                        Avantages salariales</td>
                                                </tr>
                                            @endif
                                            @foreach ($payAds as $payAd)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                        {{ $payAd->name }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                        {{ $payAd->amount ?? $payAd->rate . '%' }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                        {{ $payAd->pivot->amount }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-4 font-bold">Salaire brut</td>
                                                <td class="whitespace-nowrap px-6 py-4 font-bold" colspan="2">{{ $pay->gross_wage }}</td>
                                            </tr>

                                            @if ($payFillers->count() !== 0)
                                                <tr>
                                                    <td colspan="3" class="whitespace-nowrap px-6 pt-4 font-semibold italic">
                                                        Imputations salariales</td>
                                                </tr>
                                            @endif
                                            @foreach ($payFillers as $payFiller)
                                                <tr>
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                        {{ $payFiller->name }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                        {{ $payFiller->amount ?? $payFiller->rate . '%' }}</td>
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                        {{ $payFiller->pivot->amount }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td class="whitespace-nowrap px-6 py-4 font-bold">Salaire net</td>
                                                <td class="whitespace-nowrap px-6 py-4 font-bold" colspan="2">
                                                    {{ $pay->net_wage }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
