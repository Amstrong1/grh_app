<?php 

namespace App\Enums;

enum PermissionStatusEnum:string {
    case Pending = 'En attente';
    case Allowed = 'Accordé sans modifier congé';
    case Denied = 'Refusé';
    case AllowedAndModify = 'Accordé et modifier congé';
}