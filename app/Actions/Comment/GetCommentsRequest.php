<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Actions\Request;

class GetCommentsRequest extends Request
{
    protected ?string $direction;
    protected ?string $order_by;
    protected ?int $limit;

    public function __construct(
        ?string $direction,
        ?string $order_by,
        ?int $limit
    ) {
        $this->direction = $direction;
        $this->order_by = $order_by;
        $this->limit = $limit;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function getOrderBy(): ?string
    {
        return $this->order_by;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }


}
