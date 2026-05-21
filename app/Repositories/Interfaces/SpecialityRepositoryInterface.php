<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface SpecialityRepositoryInterface
{
    public function all(): Collection;
}
