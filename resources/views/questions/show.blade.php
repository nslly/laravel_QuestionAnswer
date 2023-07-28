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
            <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $question->title }}
            </h2>
            <a href="{{ route('questions.index') }}" class="bg-gray-500 text-white rounded-md border p-3 shadow-sm cursor-pointer text-base font-medium transition hover:bg-gray-600  duration-0 hover:duration-450 ease-in-out focus:bg-gray-600 focus:ring-1 ">GO BACK TO QUESTIONS</a>
        </div>

        <hr>
        <div class="mt-12">
            <div class="flex px-4">
                <div class="flex flex-col px-2 justify-evenly items-center">
                    <a title="This helps to my question" 
                        class="cursor-pointer"
                        onclick="event.preventDefault(); document.getElementById('question-vote-up-{{ $question->slug }}').submit()">
                            <i class="fa fa-3x fa-caret-up "></i>
                    </a>
                    <form id="question-vote-up-{{ $question->slug }}" action="/questions/{{ $question->slug }}/vote" method="POST" enctype="multipart/form-data" class="hidden">
                        @csrf
                        <input type="hidden" name="vote" value="1">
                    </form>
                    <span class="text-white">
                        {{ $question->votes }}
                    </span>
                    <a title="This not helps to my question" 
                        class="cursor-pointer"
                        onclick="event.preventDefault(); document.getElementById('question-vote-down-{{ $question->slug }}').submit()">
                        <i class="fa fa-3x fa-caret-down"></i>
                    </a>
                    <form id="question-vote-down-{{ $question->slug }}" action="/questions/{{ $question->slug }}/vote" method="POST" enctype="multipart/form-data" class="hidden">
                        @csrf
                        <input type="hidden" name="vote" value="-1">
                    </form>
                    <a title="Click to mark as a favorite question" class="cursor-pointer"
                        onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->slug }}').submit()">
                        @auth
                            <i class="fa fa-2x fa-solid fa-star {{ $question->is_favorited ? 'text-yellow-500' : 'text-gray-900' }}"></i>
                        @else 
                            <i class="fa fa-2x fa-solid fa-star text-gray-90"></i>
                        @endauth
                    </a>
                    <span class="text-white">
                        {{ $question->favorites_count }}
                    </span>
                </div>
                <form id="favorite-question-{{ $question->slug }}" action="/questions/{{ $question->slug }}/favorites" method="POST" enctype="multipart/form-data" class="hidden">
                    @csrf
                    @if ($question->is_favorited)
                        @method('delete')
                    @endif
                </form>
                <div class="p-5 text-white bg-gray-700">
                    {{ $question->body}}
                </div>
            </div>
            <div class="flex flex-col ml-6 py-6">
                <user-info label='Asked' :model= "{{ $question }}" :model-user = "{{ $question->user }}"></user-info>
            </div>
        </div>
    </div>



    @include('answers.index', [
        'questions_count'   => $question->answers,
        'answers'           => $question->answers_for_questions
    ])

    @include('answers.create', [
        'buttonText' => 'Submit'
    ])

    {{-- <div class="bg-gray-700 m-16 mt-20">
        <div class="mx-auto p-4 flex justify-between">
            <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $question->answers }} Answers
            </h2>
        </div>

        <hr>
        @foreach ($question->answers_for_questions as $answer)
            <div class="flex flex-col">
                <div class="mt-6 flex px-4">
                    <div class="flex flex-col px-2 justify-evenly items-center">
                        <a title="This helps to my question" href="#">
                            <i class="fa fa-3x fa-caret-up"></i>
                        </a>
                        <span class="text-white">
                            140
                        </span>
                        <a title="This not helps to my question" href="#">
                            <i class="fa fa-3x fa-caret-down"></i>
                        </a>
                        <a title="Mark this answer as best answer" href="#">
                            <i class="fa fa-2x fa-solid fa-check text-green-500"></i>
                        </a>
                    </div>
                    <div class="p-5 text-white bg-gray-700">
                        <p>{{ $answer->body }}</p>
                    </div>
                </div>
                <div class="flex flex-col ml-6 py-6">
                    <div>
                        <span class="block text-xl py-1 text-gray-500 dark:text-gray-400 font-bold leading-snug">
                            Answered {{ $answer->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <div class="flex">
                        <img class="rounded-full w-9 h-9" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/karen-nelson.png" alt="profile picture">
                        <span class="text-md mt-1 ml-2 py-1 text-gray-500 dark:text-gray-500 font-bold leading-snug">
                            {{ $answer->user->name }}
                        </span>
                    </div>
                </div>
            </div>
            
            <hr>
        @endforeach
    </div> --}}


</x-guest-layout>