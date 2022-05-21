<?php

namespace App\Enums;

enum TaskStatus: string
{
    case STARTED = 'started';
    case NOT_STARTED = 'not_started';
    case PAUSED = 'paused';
    case DONE = 'done';
}