<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $append = ['formatted_assign_to_all'];

    public function getFormattedAssignToAllAttribute()
    {
        $value = "";
        if ($this->assign_to_all === 1) {
            $value = 'Oui';
        } else {
            $value = 'Non';
        }
        return $value;
    }
}
