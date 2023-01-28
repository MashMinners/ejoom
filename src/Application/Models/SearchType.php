<?php

declare(strict_types=1);

namespace Application\Models;

enum SearchType : string
{
    case Fast = 'Fast';
    case ByDate = 'ByDate';
    case ByParams = 'ByParams';
}