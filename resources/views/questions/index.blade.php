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
            <index></index>
            <a class="text-md border-gray-900 bg-gray-900 shadow-md rounded-lg p-2 text-gray-800 dark:text-gray-200" href="{{ route('questions.create') }}">ADD QUESTIONS</a>
        </div>

        <hr>

        <div class="w-full">
            @include('layouts._messagesSuccess')
        </div>
    
        <div class="flex justify-around mt-12">
            @forelse($questions as $question)
                <div class="p-5 bg-gray-700 flex">
                    <div class="px-5 py-4 bg-white dark:bg-gray-800 flex flex-col justify-between shadow-md rounded-lg max-w-lg">
                        <div class="flex mb-4 justify-between">
                            <div class="ml-2 mt-0.5">
                                <span class="block font-medium  text-xl leading-snug text-black dark:text-gray-100"><a href="{{ route("questions.show", $question->slug) }}">{{ $question->title }}</a></span>
                                <span class="block text-md py-1 text-gray-500 dark:text-gray-400 font-bold leading-snug">Created By <a class="text-slate-100 text-lg cursor-point font-bolder" href="{{ $question->user->url }}">{{ $question->user->name }}</a></span>
                                <span class="block text-sm text-gray-500 dark:text-gray-500 font-light leading-snug">{{ $question->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex flex-col ml-2">
                                @can('delete-question', $question)
                                    <form class="flex justify-end" action="{{ route('questions.destroy', $question->slug) }}" method="POST" enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="text-blue font-bold text-red-300 border-2 py-2 px-3 border-red-300">X</button>
                                    </form>
                                @endcan
                                @can('update-question', $question)
                                    <a class="mt-3" href="{{ route('questions.edit', $question->slug) }}"><span class="text-blue text-cyan-300 border-2 py-2 px-4 border-cyan-300">Edit</span></a>
                                @endcan
                            </div>
                        </div>
                        <div class="excerpt">
                            <p class="text-gray-800 dark:text-gray-100 leading-snug md:leading-normal">{{ $question->excerpt }}</p>
                        </div>
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
            @empty 
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                        <div>
                            <p class="font-bold">No records</p>
                            <p class="text-sm">There are no questions.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="py-5  mt-12 mx-auto flex justify-center w-full items-center">
            {{ $questions->links() }}
        </div>
    </div>
    

</x-guest-layout>