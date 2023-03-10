<section>

    <div class="flex">

        <h2 class="text-2xl">{{$recipe->name }}</h2>

        <div class="pt-2 text-[13px]">
            <div class="p-1">
                <input class="w-24 px-2 py-2
                    border-2 border-white rounded-md shadow
                    focus:outline-none focus:border-blue-600"
                    type="text" onfocus="focusDropdownOptions()"
                    onblur="blurDropdownOptions()" placeholder="Select an Tag">
                <div id="options" class="hidden w-24 py-1 bg-white rounded-lg shadow-xl">
                    @foreach ($tags as $tag)
                        <a href="#" data-id="{{$tag->id}}" class="block px-1 py-1 text-gray-800 hover:bg-indigo-500 hover:text-white">{{$tag->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <span class="border rounded-xl px-1 -mt-2" title="テキストは自動保存されます。マークダウンに対応しています。">?</span>
    <form action="{{$route}}" method="POST">
        @csrf

        @if ($state === "create")
            <textarea name="body" cols="40" rows="15"></textarea>
        @elseif ($state === "edit")
            {{-- <textarea name="body" cols="40" rows="15">{{old('body')}}</textarea> --}}
            <textarea name="body" cols="40" rows="15">{{ $recipe->body }}</textarea>
        @endif


        @if ($errors->any())
            @foreach($errors->all() as $error)
                <div style="color: red">{{ $error }}</div>
            @endforeach
        @endif

        {{-- <p class="mt-5"><input type="file" name="image"></p>

        <p class="mt-5"><input type="file" name="image"></p>

        <p class="mt-5"><input type="file" name="image"></p>

        <p class="mt-5"><input type="file" name="image"></p> --}}

        <button class="btn-c">save</button>
    </form>

    @if ($state === "edit")
        <a href="{{route('categories.show', $recipe->categories[0])}}" class="btn-b">Back</a>
    @elseif ($state === "create")
        <a href="" class="btn-b">破棄する</a>
    @endif

</section>

<script src="{{ url('js/recipe_form.js') }}"></script>
