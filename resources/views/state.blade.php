<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <div class="mx-auto w-3/5 overflow-hidden">
                        <canvas
                          id="myChart"
                          data-te-chart="pie"
                          data-te-dataset-label="Traffic"
                          data-te-labels="{{ json_encode($states) }}"
                          data-te-dataset-data="{{ json_encode(array_values($statistics)) }}"
                          data-te-dataset-background-color="['rgba(79, 39, 176, 0.5)','rgba(150, 99, 196, 0.5)','rgba(96, 199, 116, 0.5)','rgba(16, 139, 106, 0.5)', 'rgba(233, 30, 99, 0.5)', 'rgba(66, 73, 244, 0.4)', 'rgba(66, 133, 244, 0.2)']">
                        </canvas>
                      </div>
                    {{-- <x-forms.create :fields="$my_fields" type="structure" /> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
// Initialization for ES Users
import {
  Chart,
  initTE,
} from "tw-elements";

initTE({ Chart });
// Récupérer le canvas par ID
const canvas = document.getElementById('myChart');

// Ajouter un gestionnaire de clics au canvas
canvas.onclick = function (event) {
    const points = Chart.getPointsAtEvent(this, event);

    if (points.length > 0) {
        // Redirection en fonction de l'élément cliqué
        const label = points[0].label;
        switch (label) {
            case 'Nombre utilisateurs':
                window.location.href = 'http://127.0.0.1:8000/dashboard';
                break;
            case 'Nombre de départements':
                window.location.href = 'http://127.0.0.1:8000/dashboard';
                break;
            case 'Nombre de postes':
                window.location.href = 'http://127.0.0.1:8000/dashboard';
                break;
            default:
                // Redirection par défaut ou aucune action
                break;
        }
    }
};
</script>