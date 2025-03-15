<button type="submit"
    class="shadow-md shadow-red-400 hover:shadow-none focus:scale-95 duration-300 text-white p-2 rounded-full {{ $user->status_pelanggan === 'Suspended' ? 'bg-gray-500 cursor-not-allowed opacity-50' : 'bg-red-500 hover:bg-red-600' }}"
    {{ $user->status_pelanggan === 'Suspended' ? 'disabled' : '' }} title="Blokir">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-5">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
    </svg>
</button>
