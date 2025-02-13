<?php

namespace App\Enums;

enum TableStatus : String  {
    case Pending = 'pendig';
    case Avalaiable= 'avaliable';
    case Unavaliable = 'unavaliable';
}
