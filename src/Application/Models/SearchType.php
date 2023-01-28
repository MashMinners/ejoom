<?php

declare(strict_types=1);

namespace Application\Models;

enum SearchType
{
    case FastSearch;
    case ByDate;
    case ByParams;
}