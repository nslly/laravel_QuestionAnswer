<div class="flex justify-center items-center flex-col">
    <a title="Click to mark as a favorite question" class="cursor-pointer"
    onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->slug }}').submit()">
    @auth
        <i class="fa fa-2x fa-solid fa-star {{ $model->is_favorited ? 'text-yellow-500' : 'text-gray-900' }}"></i>
    @else 
        <i class="fa fa-2x fa-solid fa-star text-gray-90"></i>
    @endauth
    </a>
    <span class="text-white mt-2">
        {{ $model->favorites_count }}
    </span>
    
</div>