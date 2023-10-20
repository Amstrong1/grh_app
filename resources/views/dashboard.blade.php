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
                    <x-forms.create :fields="$my_fields" type="structure" />
                    <div class="mx-auto w-3/5 overflow-hidden">
                        <canvas
                          data-te-chart="pie"
                          data-te-dataset-label="Traffic"
                          data-te-labels="['Monday', 'Tuesday' , 'Wednesday' , 'Thursday' , 'Friday' , 'Saturday' , 'Sunday ']"
                          data-te-dataset-data="[2112, 2343, 2545, 3423, 2365, 1985, 987]"
                          data-te-dataset-background-color="['rgba(63, 81, 181, 0.5)', 'rgba(77, 182, 172, 0.5)', 'rgba(66, 133, 244, 0.5)', 'rgba(156, 39, 176, 0.5)', 'rgba(233, 30, 99, 0.5)', 'rgba(66, 73, 244, 0.4)', 'rgba(66, 133, 244, 0.2)']">
                        </canvas>
                      </div>
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
    </script>
