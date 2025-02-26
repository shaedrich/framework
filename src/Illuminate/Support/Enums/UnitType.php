<?php

namespace Illuminate\Support\Enums;

enum UnitType
{
    case Length;
    case Weight;
    case Percentage;
    case Currency;
    case FileSize;
}
