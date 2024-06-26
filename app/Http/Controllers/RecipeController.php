<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        // Get 2 fixed recipes (adjust IDs according to your data)
        $fixedRecipes = Recipe::whereIn('id', [1, 2])->get();

        // Get 3 random recipes
        $randomRecipes = Recipe::inRandomOrder()->limit(3)->get();

        // Combine fixed and random recipes into a single collection
        $allRecipes = $fixedRecipes->concat($randomRecipes);

        // Pass all recipes to the view
        return view('welcome', compact('allRecipes'));
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);

        return view('recipe.show', compact('recipe'));
    }

    // API method: Get paginated recipes
    public function getRecipesApi($page)
    {
        $perPage = 10;
        $recipes = Recipe::select('id', 'name', 'publication_date')
            ->orderBy('id')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return response()->json($recipes);
    }

    // API method: Get details of a recipe by ID
    public function getRecipeApi($id)
    {
        $recipe = Recipe::find($id);
        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found.'], 404);
        }

        return response()->json($recipe);
    }

    // API method: Get paginated recipes by category
    public function getRecipesByCategoryApi($id, $page)
    {
        $perPage = 10;

        // Fetch recipes related to the given category ID
        $recipes = Recipe::whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        })
            ->select('id', 'name', 'publication_date')
            ->orderBy('id')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($recipes);
    }
}
