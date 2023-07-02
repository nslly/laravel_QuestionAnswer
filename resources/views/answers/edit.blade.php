<x-guest-layout>
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
    

    <div class="bg-gray-700 m-16">
        <div class="mx-auto p-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
                Editing answer for question: <strong class="text-gray-200">{{ $question->title }}</strong>
            </h2>
        </div>

        <hr>
        <div class="mt-12">
            <div class="p-5 text-white bg-gray-700">
                <form action="{{ route('questions.answers.update', [$question->slug, $answer->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="w-full p-2 bg-gray-700">
                        <label for="answer_body" class="block mb-2">Answer</label>
                        <textarea class="bg-gray-800 w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" rows="10" placeholder="Enter your full code here" name="body" id="answer_body">{{ old('body') ?? $answer->body ?? '' }} </textarea>
                        @if ($errors->has('body'))
                        <p class="text-red-500 mt-2 text-sm">{{ $errors->first('body') }}</p>
                    @endif
                    </div>

                    <div class="mt-2 p-2">
                        <button type="submit" class="bg-gray-500 text-white rounded-md border p-3 shadow-sm cursor-pointer text-base font-medium transition hover:bg-gray-600  duration-0 hover:duration-450 ease-in-out focus:bg-gray-600 focus:ring-1 ">Edit Answer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

</x-guest-layout>