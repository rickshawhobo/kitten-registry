<?php

namespace App\Http\Controllers;

use App\Models\Kitten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * Class KittenController
 * Resource controller for kittens resource
 * @package App\Http\Controllers
 */
class KittenController extends Controller
{

    private $validFilters = [
        'age',
        'color',
        'firstName',
        'gender',
        'id',
        'lastName',
    ];


    /**
     * Searches kittens by valid filters. Filters will apply a query scope if it's a not trivial query
     * Providing no filter is a valid search/browse
     *
     * Pagination is defaulted to 100 results per page unless specified using ?perPage=num
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {

        $minutes = 10;

        $filters = $request->input('filters');
        foreach ($request->input('filters') as $filter => $value) {
            if (!in_array($filter, $this->validFilters)) {
                throw new \Exception("Invalid filter detected $filter");
            }
        }
        ksort($filters);

        // build the cache key out of the valid filters, page and per page numbers so the cache is consistent with the payload
        $key = "kittens?" . http_build_query($filters) . $request->input('page') . $request->input('perPage');
        $perPage = $request->input('perPage') ?? 100;

        $return = Cache::remember($key, $minutes, function () use ($request, $filters, $perPage) {


            $query = Kitten::select();


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
        });
        return $return;
    }
}