<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4">
    @if(!$registered)
        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md">
            <h2 class="text-xl font-bold mb-4 text-center">Регистрация на вебинар</h2>
            <form wire:submit.prevent="register" class="space-y-4">
                <input wire:model="name" type="text" placeholder="Ваше имя" class="w-full border px-4 py-2 rounded-lg">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <input wire:model="phone" type="text" placeholder="Телефон" class="w-full border px-4 py-2 rounded-lg">
                @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 w-full">Начать просмотр</button>
            </form>
        </div>
    @else
        <div class="w-full max-w-4xl mt-6">
            <iframe class="rounded-xl shadow-xl w-full h-[450px]" src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
        </div>
    @endif
</div>
