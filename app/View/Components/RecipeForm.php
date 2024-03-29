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

    public $tags;

    public $attachedtags;

    public function __construct($recipe, $route, $state, $tags, $attachedtags)
    {

        $this->recipe = $recipe;

        $this->route = $route;

        $this->state = $state;

        $this->tags = $tags;

        $this->attachedtags = $attachedtags;

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
