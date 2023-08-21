<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Auth;

class SelectEmployee extends Component
{
    public $users;
    public $fillers;
    public $structure;
    public $departments;
    public $holdingWages;
    public $salaryAdvantages;

    public $user_id;
    public $userPlaceName;
    public $userPlaceBasisWage;
    public $userPlaceHourlyRate;
    public $userPlaceOvertimeRate;
    public $userPlaceOvertimeRateWeek;

    protected $rules = [
        'user_id' => 'required',
    ];

    public function mount()
    {
        $this->structure = Auth::user()->structure;

        $getFirstUser = $this->structure->users()
            ->where('role', '!=', UserRoleEnum::Admin)
            ->where('role', '!=', UserRoleEnum::SuperAdmin)
            ->first();
        $this->user_id = $getFirstUser->id;

        $this->userPlaceName = $getFirstUser->career->place->name;
        $this->userPlaceBasisWage = $getFirstUser->career->place->basis_wage;
        $this->userPlaceHourlyRate = $getFirstUser->career->place->hourly_rate;
        $this->userPlaceOvertimeRate = $getFirstUser->career->place->overtime_rate;
        $this->userPlaceOvertimeRateWeek = $getFirstUser->career->place->overtime_rate_week;

        $this->users = $this->structure->users()
            ->where('role', '!=', UserRoleEnum::Admin)
            ->where('role', '!=', UserRoleEnum::SuperAdmin)
            ->get();

        $this->departments = $this->structure->departments()->get();
        $this->fillers = $this->structure->fillers()->get();
        $this->salaryAdvantages = $this->structure->salaryAdvantages()->get();
        $this->holdingWages = $this->structure->holdingWages()->get();
    }

    public function render()
    {
        return view('livewire.select-employee');
    }

    public function selectUser($value)
    {
        $this->user_id = $value;

        $getSelectedUser = $this->structure->users()
            ->where('id', $value)
            ->first();

        $this->userPlaceName = $getSelectedUser->career->place->name;
        $this->userPlaceBasisWage = $getSelectedUser->career->place->basis_wage;
        $this->userPlaceHourlyRate = $getSelectedUser->career->place->hourly_rate;
        $this->userPlaceOvertimeRate = $getSelectedUser->career->place->overtime_rate;
        $this->userPlaceOvertimeRateWeek = $getSelectedUser->career->place->overtime_rate_week;
    }
}
