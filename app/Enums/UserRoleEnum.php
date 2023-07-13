<?php 

namespace App\Enums;

enum UserRoleEnum:string {
    case SuperAdmin = 'superadmin';
    case Admin = 'admin';
    case Supervisor = 'supervisor';
    case User = 'user';
}