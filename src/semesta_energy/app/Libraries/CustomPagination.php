<?php

namespace app\Libraries;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPagination extends LengthAwarePaginator
{
    public function toArray(): array
    {
        return [
            'data' => $this->items->values()->toArray(),

        ];
    }
}
