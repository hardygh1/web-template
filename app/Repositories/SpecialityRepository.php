<?php

namespace App\Repositories;

use App\Models\Speciality;
use App\Repositories\Interfaces\SpecialityRepositoryInterface;
use Illuminate\Support\Collection;

class SpecialityRepository implements SpecialityRepositoryInterface
{
    public function all(): Collection
    {
        return Speciality::all();
    }
}
