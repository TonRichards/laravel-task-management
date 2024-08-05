<?php

namespace App\Enums;

enum Status: string
{
   case TO_DO = 'to-do';
   case IN_PROGRESS = 'in-progress';
   case DONE = 'done';
}
