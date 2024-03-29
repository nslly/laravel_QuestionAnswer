{{-- <answer :answer="{{ $answer }}" :question="{{ $question }}" :model-user="{{ $answer->user }}"> --}}
    {{-- <div class="flex flex-col">
        <form action="" v-if="editing">
            <textarea v-model="body" cols="30" rows="10"></textarea>
            <button @click.prevent="editing = false">Update</button>
            <button @click.prevent="editing = false">Cancel</button>
        </form>
        <div v-else>
            <div class="flex justify-end items-center mt-6 mr-4">
                @can('update-answer', $answer)
                    <div class="bg-cyan-500 text-white border-2 mr-2 py-2 px-4 border-cyan-500">
                        <a @click.prevent="editing = true" ><span >Edit</span></a>
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
                <user-info label='Answered' :model= "{{ $answer }}" :model-user="{{ $answer->user }}"></user-info>
            </div>
        </div>
    </div> --}}
{{-- </answer> --}}

