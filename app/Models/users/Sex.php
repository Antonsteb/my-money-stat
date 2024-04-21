<?php

namespace App\Models\users;

enum Sex: string
{
    const DEFAULT_SEX = 'male';

    case Male = 'male';
    case Female = 'female';
}
