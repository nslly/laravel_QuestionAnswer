@csrf
<div class="w-full p-2 bg-gray-700">
    <label for="question_title" class="block mb-2">Title</label>
    <input type="text" value="{{ old('title', $question->title) }}" class="bg-gray-800 w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" placeholder="Enter the title" name="title" id="question_title">

    @if ($errors->has('title'))
        <p class="text-red-500 mt-2 text-sm">{{ $errors->first('title') }}</p>
    @endif
</div>
<div class="w-full p-2 bg-gray-700">
    <label for="question_body" class="block mb-2">Explanations</label>
    <textarea class="bg-gray-800 w-full leading-tight shadow-sm focus:border-white focus:ring-blue appearance-none focus:outline-none focus:shadow-outline" rows="10" placeholder="Enter your full code here" name="body" id="question_body">{{ old('body', $question->body) }} </textarea>
    @if ($errors->has('body'))
    <p class="text-red-500 mt-2 text-sm">{{ $errors->first('body') }}</p>
@endif
</div>

<div class="mt-2 p-2">
    <button type="submit" class="bg-gray-500 text-white rounded-md border p-3 shadow-sm cursor-pointer text-base font-medium transition hover:bg-gray-600  duration-0 hover:duration-450 ease-in-out focus:bg-gray-600 focus:ring-1 ">{{ $buttonText }}</button>
</div>