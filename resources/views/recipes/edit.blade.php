<x-layout>

    <x-recipe-form
        :recipe="$recipe"
        :tags="$tags"
        :attachedtags="$attachedtags"
        :route="route('recipes.edit', $recipe)"
        :state="$state"/>

</x-layout>
