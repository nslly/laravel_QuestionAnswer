<div class="bg-gray-700 m-16 mt-20">
    <div class="mx-auto p-4 flex justify-between">
        <h2 class="font-semibold p-3 text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Your Answer
        </h2>
    </div>

    <hr>

    <form action="{{ route('questions.answers.store', $question->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full p-2 bg-gray-700">
            <label for="answers_body" class="block mb-2">Answer</label>
            <textarea class="bg-gray-800 text-white w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" rows="10" placeholder="Enter your full code here" name="body" id="answers_body">{{ old('body') ?? $answer->body ?? '' }} </textarea>
            @if ($errors->has('body'))
            <p class="text-red-500 mt-2 text-sm">{{ $errors->first('body') }}</p>
        @endif
        </div>

        <div class="mt-2 p-2">
            <button type="submit" class="bg-gray-500 text-white rounded-md border p-3 shadow-sm cursor-pointer text-base font-medium transition hover:bg-gray-600  duration-0 hover:duration-450 ease-in-out focus:bg-gray-600 focus:ring-1 ">{{ $buttonText }}</button>
        </div>
    </form>

</div>