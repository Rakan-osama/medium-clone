@props(['user' , 'size' => 'w-12 h-12'])

@if ($user->image)
    <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" class="{{ $size }} rounded-full">
@else
    <img src="https://www.un.org/pga/wp-content/uploads/sites/53/2018/09/Dummy-image-1.jpg" alt="Dammy Avatar"
        class="{{ $size }} rounded-full">
@endif
