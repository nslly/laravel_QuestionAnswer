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
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                EDIT QUESTION
            </h2>
        </div>

        <hr>
        <div class="mt-12">
            <div class="p-5 text-white bg-gray-700">
                <form action="{{ route('questions.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @include('questions._form', ['buttonText' => 'Edit Question'])
                </form>
            </div>
        </div>
    </div>
    

</x-guest-layout>