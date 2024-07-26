<?php

namespace App\Enums;

enum Type: string
{
   case MAIN_SPACE = 'main_space';
   case SUB_SPACE = 'sub_space';

   case MAIN_TASK = 'main_task';
   case SUB_TASK = 'sub_task';
}
