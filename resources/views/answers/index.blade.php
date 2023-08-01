@if($questions_count > 0) 
    <div class="bg-gray-700 m-16 mt-20" v-cloak>
        <div class="mx-auto p-4 flex justify-between">
            <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $questions_count }} Answers
            </h2>
        </div>
    
        <hr>
    
        @include('layouts._messagesSuccess');
        @foreach ($answers as $answer)
            @include('answers._answer', [
                'answer'    => $answer,
            ])
            <hr>
        @endforeach
    </div>
@endif
