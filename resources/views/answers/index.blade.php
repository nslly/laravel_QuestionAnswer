<div class="bg-gray-700 m-16 mt-20">
    <div class="mx-auto p-4 flex justify-between">
        <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $questions_count}} Answers
        </h2>
    </div>

    <hr>

    @include('layouts._messagesSuccess');
    @foreach ($answers as $answer)
        <div class="flex flex-col">
            <div class="flex justify-end items-center mt-6 mr-4">
                @can('update-answer', $answer)
                    <div class="bg-cyan-500 text-white border-2 mr-2 py-2 px-4 border-cyan-500">
                        <a href="{{ route('questions.answers.edit', [$question->slug, $answer->id]) }}"><span >Edit</span></a>
                    </div>
                @endcan
                @can('delete-answer', $answer)
                    <div class="text-white font-bold bg-red-500  border-2 py-2 px-3 border-red-500">
                        <form action="{{ route('questions.answers.destroy', [$question->slug, $answer->id]) }}" method="POST" enctype="multipart/form-data">
                            @method('delete')
                            @csrf
                            <button type="submit">X</button>
                        </form>
                    </div>
                @endcan
            </div>
            <div class="mt-6 flex px-4">
                <div class="flex flex-col px-2 justify-evenly items-center">
                    <a title="This helps to my question"
                    class="cursor-pointer"
                    onclick="event.preventDefault(); document.getElementById('answer-vote-up-{{ $answer->id }}').submit()">
                        <i class="fa fa-3x fa-caret-up "></i>
                    </a>
                    <form id="answer-vote-up-{{ $answer->id}}" action="/answers/{{ $answer->id }}/vote" method="POST" enctype="multipart/form-data" class="hidden">
                        @csrf
                        <input type="hidden" name="vote" value="1">
                    </form>
                    <span class="text-white">
                        {{ $answer->votes_count }}
                    </span>
                    <a title="This not helps to my question" 
                        class="cursor-pointer"
                        onclick="event.preventDefault(); document.getElementById('answer-vote-down-{{ $answer->id }}').submit()">
                        <i class="fa fa-3x fa-caret-down"></i>
                    </a>
                    <form id="answer-vote-down-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="POST" enctype="multipart/form-data" class="hidden">
                        @csrf
                        <input type="hidden" name="vote" value="-1">
                    </form>
                    @can ('accept-best-answer', $answer)
                        <a title="Mark this answer as best answer"
                            class="cursor-pointer"
                            onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit()">
                            <i class="fa fa-2x fa-solid fa-check {{ $answer->question->best_answer_id === $answer->id ? 'text-green-500' : ''  }} "></i>
                        </a>
                    @else
                        @if ($answer->best_answer)
                            <a title="This is the best answer according to {{ $question->user->name }}"
                                class="cursor-pointer">
                                <i class="fa fa-2x fa-solid fa-check {{ $answer->question->best_answer_id === $answer->id ? 'text-green-500' : ''  }} "></i>
                            </a>
                        @endif
                @endcan
                </div>
                <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}" method="POST" enctype="multipart/form-data" class="hidden">
                    @csrf
                </form>
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
</div>