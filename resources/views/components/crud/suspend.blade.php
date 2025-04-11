<button type="submit"
    class="shadow-md shadow-yellow-400 hover:shadow-none focus:scale-95 duration-300 text-white p-2 rounded-full {{ $user->status_pelanggan === 'Banned' ? 'bg-gray-500 cursor-not-allowed opacity-50' : 'bg-yellow-500 hover:bg-yellow-600' }}"
    {{ $user->status_pelanggan === 'Banned' ? 'disabled' : '' }} title="Tangguhkan">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-5 md:size-4">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
    </svg>
</button>
