<?php
namespace App\Http\Controllers;

use App\Models\Kitten;
use Illuminate\Http\Request;

class KittenController extends Controller
{
    public function index(Request $request) {

        $query = Kitten::select();

        $filters = $request->input('filters');

        if (isset($filters['age'])) {
            $query->age($filters['age'], $filters['maxAge'] ?? null);
        }
        if (isset($filters['firstName'])) {
            $query->firstNameLike($filters['firstName']);
        }
        return $query->paginate(10);
    }
}