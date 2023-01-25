<?php

namespace App\Http\Enums;

enum Status : String{
    case NEW = "NEW";
    case DESIGN = "DESIGN";
    case DEVELOPMENT = "DEVELOPMENT";
    case FINISHED = "FINISHED";
    case FROZEN = "FROZEN";
}