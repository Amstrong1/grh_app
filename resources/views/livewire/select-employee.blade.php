<div>
    {{-- Do your work, then step back. --}}

    @if ($users !== null)
        <div @class(['form-group md:grid grid-cols-2 gap-2 mt-4'])>

            <div>
                <x-input-label for="employees" value="Sélectionner un employé" class="font-semibold">
                </x-input-label>
                <select id="user_id" name="user" wire:model="user_id" wire:click="selectUser($event.target.value)"
                    class="w-80 p-2 border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 rounded bg-white">
                    @foreach ($departments as $department)
                        <optgroup label="{{ $department->name }}">
                            @foreach ($users as $user)
                                @if ($user->career->place->department->id === $department->id)
                                    <option value="{{ $user->id }}">{{ $user->name . ' ' . $user->firstname }}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>

                {{-- display employee's post infos --}}
                <x-input-label for="" value="Poste" class="font-semibold pt-4 text-lg">
                </x-input-label>
                <input class="w-80 p-2 border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 rounded"
                    type="text" value="{{ $userPlaceName }}" readonly>

                <x-input-label for="" value="Salaire de base" class="font-semibold pt-4 text-lg">
                </x-input-label>
                <input class="w-80 p-2 border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 rounded"
                    type="text" value="{{ $userPlaceBasisWage }}" readonly>

                <x-input-label for="" value="Tarif horaire" class="font-semibold pt-4 text-lg"></x-input-label>
                <input class="w-80 p-2 border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 rounded"
                    type="text" value="{{ $userPlaceHourlyRate }}" readonly>

                <x-input-label for="" value="Tarif heure supplémentaire" class="font-semibold pt-4 text-lg">
                </x-input-label>
                <input class="w-80 p-2 border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 rounded"
                    type="text" value="{{ $userPlaceOvertimeRate }}" readonly>

            </div>

            <div class="sm:mt-4 md:mt-0">
                {{-- pay date --}}
                <x-input-label for="" value="Date de paiement" class="font-semibold pt-4 text-lg">
                </x-input-label>
                <input class="w-80 p-2 border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 rounded"
                    type="date" name="pay_date">

                {{-- period field --}}
                <x-input-label for="" value="Période" class="font-semibold pt-4">
                </x-input-label>
                <div class="relative flex flex-wrap items-stretch">
                    <div
                        class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 pb-[0.27rem] pt-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">
                        <span>Du</span>
                    </div>

                    <input id="period_start" type="date" aria-label="Debut Periode" name="period_start"
                        class="rounded-0 relative m-0 block w-[1px] min-w-0 flex-auto border border-r-0 border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" />

                    <div
                        class="flex items-center whitespace-nowrap border border-r-0 border-solid border-neutral-300 px-3 pb-[0.27rem] pt-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">
                        <span>au</span>
                    </div>

                    <input id="period_end" type="date" aria-label="Fin période" name="period_end"
                        class="relative m-0 -ml-px block w-[1px] min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" />
                </div>
                @error('period_start')
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                @enderror
                @error('period_end')
                    <x-input-error messages="{{ $message }}" class="mt-2" />
                @enderror

                {{-- work time done fields --}}
                <div>
                    <x-input-label for="" value="Heures normales éffectuées" class="font-semibold pt-4">
                    </x-input-label>
                    <input class="w-80 p-2 border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 rounded"
                        type="number" value="" name="hours_done">
                </div>
                <div>
                    <x-input-label for="" value="Heures supplémentaires éffectuées"
                        class="font-semibold pt-4 text-lg">
                    </x-input-label>
                    <input class="w-80 p-2 border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 rounded"
                        type="number" value="0" name="overtime_done">
                </div>

                {{-- salary advantage fields --}}
                <div class="mt-4">
                    <x-input-label for="advantage" value="Avantages" class="font-semibold">
                    </x-input-label>

                    @php
                        $advantageField = 0;
                    @endphp
                    @foreach ($salaryAdvantages as $salaryAdvantage)
                        <div class="relative flex flex-wrap items-stretch">

                            <div
                                class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 pb-[0.27rem] pt-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">

                                <input type="checkbox" value="" aria-label="Checkbox for following text input"
                                    name="advantageCheckbox{{ $advantageField }}"
                                    class="relative h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]" />
                            </div>

                            <input type="text" aria-label="Salary Advantage"
                                name="advantageName{{ $advantageField }}" value="{{ $salaryAdvantage->name }}"
                                readonly
                                class="rounded-0 relative m-0 block w-[1px] min-w-0 flex-auto border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" />

                            <input type="hidden" name="advantageId{{ $advantageField }}"
                                value="{{ $salaryAdvantage->id }}">

                            <input type="text" aria-label="Montant" name="advantageAmount{{ $advantageField }}"
                                value="{{ $salaryAdvantage->amount ?? ($salaryAdvantage->rate * $user->career->place->basis_wage) / 100 }}"
                                class="relative m-0 -ml-px block w-[1px] min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" />
                        </div>

                        @php
                            $advantageField++;
                        @endphp
                    @endforeach
                </div>

                {{-- filler fields --}}
                <div class="mt-4">
                    <x-input-label value="Imputations" class="font-semibold">
                    </x-input-label>
                    @php
                        $fillerField = 0;
                    @endphp
                    @foreach ($fillers as $filler)
                        <div class="relative mb-4 flex flex-wrap items-stretch">
                            <div
                                class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-3 pb-[0.27rem] pt-[0.25rem] text-center text-base font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">

                                <input type="checkbox" value="{{ $filler->id }}"
                                    name="fillerCheckbox{{ $fillerField }}" checked
                                    class="relative h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                    aria-label="Checkbox for following text input" />
                            </div>

                            <input type="text" value="{{ $filler->name }}" name="fillerName{{ $fillerField }}"
                                class="relative m-0 block w-[1px] min-w-0 flex-auto border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                                aria-label="Text input with checkbox" readonly />

                            <input type="hidden" name="fillerId{{ $fillerField }}"
                                value="{{ $filler->id }}">

                            <input type="text" aria-label="Montant" name="fillerAmount{{ $fillerField }}"
                                value="{{ $filler->amount ?? $filler->rate . '%' }}" readonly
                                class="relative m-0 -ml-px block w-[1px] min-w-0 flex-auto rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" />
                        </div>

                        @php
                            $fillerField++;
                        @endphp
                    @endforeach
                </div>
            </div>

        </div>
    @else
        Aucun employé enregistré
    @endif
</div>
