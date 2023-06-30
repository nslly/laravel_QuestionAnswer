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
</div>