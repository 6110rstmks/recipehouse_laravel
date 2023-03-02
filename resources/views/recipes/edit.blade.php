<x-layout>

    <x-recipe-form :recipe="$recipe"
        :route="route('recipes.edit', $recipe)"
        :state="$state"/>

</x-layout>
