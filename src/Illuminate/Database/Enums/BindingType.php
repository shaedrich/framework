<?php

namespace Illuminate\Database\Enums;

enum BindingType: string
{
    case Inner = 'inner';
    case Expression = 'Expression';
    case Basic = 'Basic';
    case JsonBoolean = 'JsonBoolean';
    case Bitwise = 'Bitwise';
    case Column = 'Column';
    case Like = 'Like';
    case In = 'In';
    case NotIn = 'NotIn';
    case InRaw = 'InRaw';
    case NotInRaw = 'NotInRaw';
    case Null = 'Null';
    case NotNull = 'NotNull';
    case Between = 'between';
    case BetweenColumns = 'betweenColumns';
    case Nested = 'Nested';
    case Sub = 'Sub';
    case Exists = 'Exists';
    case NotExists = 'NotExists';
    case RowValues = 'RowValues';
    case JsonContains = 'JsonContains';
    case JsonOverlaps = 'JsonOverlaps';
    case JsonContainsKey = 'JsonContainsKey';
    case JsonLength = 'JsonLength';
    case Fulltext = 'Fulltext';
    case Raw = 'Raw';
    case Where = 'where';
}
