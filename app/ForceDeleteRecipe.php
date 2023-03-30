<?php

namespace App;

use App\Models\Recipe;
use Log;

class ForceDeleteRecipe {

    public function __invoke() {


        $recipes = Recipe::onlyTrashed()->where('expiration', '<', now())->get();

        foreach ($recipes as $recipe)
        {
            $recipe->forceDelete();
        }

    }

}
