<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case ToDo = 'A faire';
    case InProgress = 'En cours';
    case Done = 'Fini';
}
