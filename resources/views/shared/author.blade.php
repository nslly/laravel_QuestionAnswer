<div>
    <span class="block text-xl py-1 text-gray-500 dark:text-gray-400 font-bold leading-snug">
        {{ $label . ' ' . $model->created_at->diffForHumans() }}
    </span>
</div>
<div class="flex">
    <img class="rounded-full w-9 h-9" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/karen-nelson.png" alt="profile picture">
    <span class="text-md mt-1 ml-2 py-1 text-gray-500 dark:text-gray-500 font-bold leading-snug">
        {{ $model->user->name }}
    </span>
</div>