<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\SendsResponses;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, SendsResponses;


    public function paginate($resourceClass, LengthAwarePaginator $paginator): array
    {
        return [
            'items'      => $resourceClass::collection($paginator->items()),
            'pagination' => [
                'from'    => $paginator->firstItem(),
                'to'      => $paginator->lastItem(),
                'current' => $paginator->currentPage(),
                'last'    => $paginator->lastPage(),
                'total'   => $paginator->total(),
                'limit'   => $paginator->perPage(),
            ],
        ];
    }
}
