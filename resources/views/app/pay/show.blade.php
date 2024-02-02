<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('message.payslip') }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .payslip {
            max-width: 600px;
            margin: 0 auto;
            border: none;
            padding: 20px;
        }

        .text-right {
            text-align: right;
        }

        h1 {
            /* text-align: center; */
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: none;
            padding: 5px;
        }

        th {
            padding-bottom: 20px;
            border-bottom: 2px solid #000;
        }

        .earnings {
            margin-top: 50px;
        }

        .earnings th,
        .deductions th,
        .net-pay th {
            text-align: left;
        }

        .earnings td:last-child,
        .deductions td:last-child,
        .net-pay td:last-child {
            text-align: right;
        }

        .sign {
            margin-top: 10px;
            border: #000 1px solid;
        }

        .signtd {
            height: 50px;
            border-bottom: #000 1px solid;
        }
    </style>
</head>

<body>
    <div class="payslip">
        <table class="">
            <tr>
                <td>
                    <div><h1>Fiche de paie</h1></div>
                    <div>{{ $pay->user->name . ' ' . $pay->user->firstname }}</div>
                </td>

                <td class="text-right">
                    <div>
                        <div><strong>Payé le</strong></div>
                        <small><div>{{ getFormattedDate($pay->pay_date) }}</div></small>
                    </div>
                    <div>
                        <div><strong>Période</strong></div>
                        <small><div>{{ getFormattedDate($pay->period_start) }} - {{ getFormattedDate($pay->period_end) }}</div></small>
                    </div>
                </td>
            </tr>
        </table>
        {{-- <table class="employee-details">
            <tr>
                <td><strong>Employé :</strong></td>
                <td>{{ $pay->user->name . ' ' . $pay->user->firstname }}</td>
            </tr>
            <tr>
                <td><strong>Poste :</strong></td>
                <td>{{ $pay->user->career->place->name }}</td>
            </tr>
        </table> --}}
        {{-- <table class="details">
            <tr>
                <td><strong>Période :</strong></td>
                <td>{{ getFormattedDate($pay->period_start) }} - {{ getFormattedDate($pay->period_end) }}</td>
            </tr>
            <tr>
                <td><strong>Payé le :</strong></td>
                <td>{{ getFormattedDate($pay->pay_date) }}</td>
            </tr>
        </table> --}}
        <table class="earnings">
            <tr>
                <th>Gains</th>
                {{-- <th>Unité</th> --}}
                <th>Montant</th>
            </tr>
            <tr>
                <td>Salaire de base</td>
                <td>{{ $pay->user->career->place->basis_wage }}</td>
            </tr>
            <tr>
                <td>Montant horaire</td>
                {{-- <td>{{ $pay->user->career->place->hourly_rate }}</td> --}}
                <td>{{ $pay->user->career->place->hourly_rate * $pay->hour_done }}</td>
            </tr>
            <tr>
                <td>Montant horaire
                    supplémentaire</td>
                {{-- <td>{{ $pay->user->career->place->overtime_rate }}</td> --}}
                <td>{{ $pay->user->career->place->overtime_rate * $pay->overtime_done }}</td>
            </tr>
            @foreach ($payAds as $payAd)
                <tr>
                    <td> {{ $payAd->name }}</td>
                    {{-- <td> {{ $payAd->amount ?? $payAd->rate . '%' }}</td> --}}
                    <td> {{ $payAd->pivot->amount }}</td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Salaire brut</strong></td>
                <td><strong>{{ $pay->gross_wage }}</strong></td>
            </tr>
        </table>
        <table class="deductions">
            <tr>
                <th>Deductions</th>
                {{-- <th>Unité</th> --}}
                <th>Montant</th>
            </tr>
            @php
                $fillers = 0;
                $holds = 0;
            @endphp
            @foreach ($payFillers as $payFiller)
                <tr>
                    <td> {{ $payFiller->name }}</td>
                    {{-- <td> {{ $payFiller->amount ?? $payFiller->rate . '%' }}</td> --}}
                    <td> {{ $payFiller->pivot->amount }}</td>
                </tr>
                @php
                    $fillers += $payFiller->pivot->amount;
                @endphp
            @endforeach
            @foreach ($payHolders as $payHolder)
                <tr>
                    <td> {{ $payHolder->name }}</td>
                    {{-- <td> {{ $payHolder->amount ?? $payHolder->rate . '%' }}</td> --}}
                    <td> {{ $payHolder->pivot->amount }}</td>
                </tr>
                @php
                    $holds += $payHolder->pivot->amount;
                @endphp
            @endforeach
            <tr>
                <td><strong>Total Deductions</strong></td>
                <td><strong>{{ $fillers + $holds }}</strong></td>
            </tr>
        </table>
        <table class="net-pay">
            <tr>
                <th>Salaire Net</th>
                <th>Montant</th>
            </tr>
            <tr>
                <td>Salaire Brut</td>
                <td>{{ $pay->gross_wage }}</td>
            </tr>
            <tr>
                <td>Total Deductions</td>
                <td>{{ $fillers + $holds }}</td>
            </tr>
            <tr>
                <td><strong>Salaire Net</strong></td>
                <td><strong>{{ $pay->net_wage }}</strong></td>
            </tr>
        </table>
        
        <table class="sign">
            <tr>
                <td class="signtd"><i>Signature</i></td>
            </tr>
            <tr>
                <td><i>Autorisé par le directeur</i></td>
            </tr>
        </table>
    </div>
</body>

</html>
