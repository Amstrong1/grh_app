<?php 

namespace App\Enums;

enum PermissionStatusEnum:string {
    case Pending = 'En attente';
    case Allowed = 'Accordé';
    case Denied = 'Refusé';
}