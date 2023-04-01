<x-layout>
    <x-recipe-form
        :recipe="$recipe"
        :tags="$tags"
        :attachedtags=null
        :route="route('recipes.store')"
        :state="$state"/>
</x-layout>
