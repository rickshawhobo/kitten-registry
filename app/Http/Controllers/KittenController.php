<?php

namespace App\Http\Controllers;

use App\Models\Kitten;
use Illuminate\Http\Request;

/**
 * Class KittenController
 * Resource controller for kittens resource
 * @package App\Http\Controllers
 */
class KittenController extends Controller
{
    /**
     * List all kittens by filters
     * If no filters are given it lists all kittens
     *
     * Paginate by default 100 results
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {

        $perPage = $request->input('perPage') ?? 100;
        $query = Kitten::select();

        $filters = $request->input('filters');

        if (isset($filters['age'])) {
            $query->age($filters['age'], $filters['maxAge'] ?? null);

        }
        if (isset($filters['firstName'])) {
            $query->firstNameLike($filters['firstName']);
        }
        if (isset($filters['lastName'])) {
            $query->lastNameLike($filters['lastName']);
        }
        if (isset($filters['color'])) {
            $query->whereColor($filters['color']);
        }
        if (isset($filters['gender'])) {
            $query->whereGender($filters['gender']);
        }
        if (isset($filters['id'])) {
            $query->whereId($filters['id']);
        }

        return $query->paginate($perPage);
    }
}