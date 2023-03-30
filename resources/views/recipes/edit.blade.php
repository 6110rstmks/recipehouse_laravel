<x-layout>

    <x-recipe-form
        :recipe="$recipe"
        :tags="$tags"
        :route="route('recipes.edit', $recipe)"
        :state="$state"/>

</x-layout>
