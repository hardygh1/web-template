<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface BloodTypeRepositoryInterface
{
    public function all(): Collection;
}
