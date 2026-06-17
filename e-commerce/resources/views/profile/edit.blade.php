<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
                <div class="mt-4">
    <label>Alamat</label>
    <input
        type="text"
        name="alamat"
        value="{{ old('alamat', $user->alamat) }}"
        class="border w-full p-3 rounded-xl"
    >
</div>

<div class="mt-4">
    <label>Instagram</label>
    <input
        type="text"
        name="instagram"
        value="{{ old('instagram', $user->instagram) }}"
        class="border w-full p-3 rounded-xl"
    >
</div>
            </div>
        </div>
    </div>
</x-app-layout>
