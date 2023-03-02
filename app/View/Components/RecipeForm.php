<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RecipeForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $recipe;

    public $route;

    public $state;

    public function __construct($recipe = null, $route, $state)
    {
        // if ($state === "edit")
        // {
        // }
        $this->recipe = $recipe;

        $this->route = $route;

        $this->state = $state;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.recipe-form');
    }
}
