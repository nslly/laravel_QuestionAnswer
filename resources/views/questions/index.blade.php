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
        <div class="mx-auto p-4 flex justify-between">
            <h2 class="font-semibold text-xl p-2 text-gray-800 dark:text-gray-200 leading-tight">
                ALL QUESTIONS
            </h2>
            <a class="text-md border-gray-900 bg-gray-900 shadow-md rounded-lg p-2 text-gray-800 dark:text-gray-200" href="{{ route('questions.create') }}">ADD QUESTIONS</a>
        </div>

        <hr>

        <div class="w-full">
            @include('layouts._messagesSuccess')
        </div>
    
        <div class="flex justify-around mt-12">
            @foreach ($questions as $question)
                <div class="p-5 bg-gray-700 flex">
                    <div class="px-5 py-4 bg-white dark:bg-gray-800 flex flex-col justify-between shadow-md rounded-lg max-w-lg">
                        <div class="flex mb-4 justify-start">
                            <img class="w-12 h-12 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"/>
                            <div class="ml-2 mt-0.5">
                                <span class="block font-medium  text-xl leading-snug text-black dark:text-gray-100"><a href="{{ route("questions.show", $question->id) }}">{{ $question->title }}</a></span>
                                <span class="block text-md py-1 text-gray-500 dark:text-gray-400 font-bold leading-snug"><a href="{{ $question->user->url }}">{{ $question->user->name }}</a></span>
                                <span class="block text-sm text-gray-500 dark:text-gray-500 font-light leading-snug">{{ $question->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="text-gray-800 dark:text-gray-100 leading-snug md:leading-normal">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <div class="flex justify-between mt-5">
                            <div class="flex">
                                @if($question->answers > 0)
                                    <div class="{{ $question->best_answer_id ? 'text-white border-green-500 bg-green-500 dark:text-white' : 'text-green-500 border-green-400  dark:text-green-400'}} p-2 border-2  font-light">{{ $question->answers }} Answers</div>
                                @else 
                                    <div class=" text-gray-500 p-2 border-2 dark:text-gray-400 font-light">{{ $question->answers }} Answers</div>
                                @endif
                                <span class="ml-4 text-gray-500 dark:text-gray-400  py-2 font-light">{{ $question->votes }} votes</span>
                            </div>  
                            <div class="ml-1 text-gray-500 py-2 dark:text-gray-400 font-light">{{ $question->views }} views</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="py-5  mt-12 mx-auto flex justify-center w-full items-center">
            {{ $questions->links() }}
        </div>
    </div>
    

</x-guest-layout>