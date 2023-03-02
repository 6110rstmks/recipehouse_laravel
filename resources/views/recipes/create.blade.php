<x-layout>
    <x-recipe-form
        :recipe="$recipe"
        :tags="$tags"
        :route="route('recipes.store')"
        :state="$state"/>
</x-layout>
