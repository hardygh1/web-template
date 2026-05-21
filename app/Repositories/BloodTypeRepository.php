<?php

namespace App\Repositories;

use App\Models\BloodType;
use App\Repositories\Interfaces\BloodTypeRepositoryInterface;
use Illuminate\Support\Collection;

class BloodTypeRepository implements BloodTypeRepositoryInterface
{
    public function all(): Collection
    {
        return BloodType::all();
    }
}
