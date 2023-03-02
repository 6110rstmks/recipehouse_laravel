<section>

    <div class="flex">

        <h2 class="text-2xl">{{$recipe->name }}</h2>

        <div class="flex flex-rowmin-h-screen pt-2 min-w-screen text-[13px]">
            <div class="p-1">
                {{-- <button onclick="showDropdownOptions()" class="flex flex-row justify-between w-48 px-2 py-2 text-gray-700 bg-white border-2 border-white rounded-md shadow focus:outline-none focus:border-blue-600"> --}}
                <a onclick="showDropdownOptions()" class="flex flex-row justify-between w-24 px-2 py-2 text-gray-700 bg-white border-2 border-white rounded-md shadow focus:outline-none focus:border-blue-600">
                    <span class="select-none">Select an Tag</span>
                    <svg id="arrow-down" class="hidden w-3 h-3 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    <svg id="arrow-up" class="w-3 h-3 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                </a>
                <div id="options" class="hidden w-24 py-1 bg-white rounded-lg shadow-xl">
                    <a href="#" class="block px-1 py-1 text-gray-800 hover:bg-indigo-500 hover:text-white">Item 1</a>
                    <a href="#" class="block px-1 py-1 text-gray-800 hover:bg-indigo-500 hover:text-white">Item 2</a>
                    <a href="#" class="block px-1 py-1 text-gray-800 hover:bg-indigo-500 hover:text-white">Item 3</a>
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

<script>
    function showDropdownOptions() {
        document.getElementById("options").classList.toggle("hidden");
        document.getElementById("arrow-up").classList.toggle("hidden");
        document.getElementById("arrow-down").classList.toggle("hidden");
    }
</script>
