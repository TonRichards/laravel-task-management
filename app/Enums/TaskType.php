<?php

namespace App\Enums;

enum TaskType: string
{
   case MAIN_TASK = 'main_task';
   case SUB_TASK = 'sub_task';
}
