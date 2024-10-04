<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

      
        <div class="mt-4">
            <x-input-label for="usertype" :value="__('User Type')" />
            <select id="usertype" name="usertype" class="block mt-1 w-full" required>
                <option value="" disabled selected>Select User Type</option>
                <option value="internal" {{ old('usertype') === 'internal' ? 'selected' : '' }}>Internal User</option>
                <option value="external" {{ old('usertype') === 'external' ? 'selected' : '' }}>External User</option>
            </select>
            <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
        </div>

        
        <div id="department-field" class="mt-4 hidden">
            <x-input-label for="department" :value="__('Department')" />
            <x-text-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department')" autocomplete="department" />
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        
        <div id="company-field" class="mt-4 hidden">
            <x-input-label for="company" :value="__('Company')" />
            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" autocomplete="company" />
            <x-input-error :messages="$errors->get('company')" class="mt-2" />
        </div>

        
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

       
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userTypeSelect = document.getElementById('usertype');
            const departmentField = document.getElementById('department-field');
            const companyField = document.getElementById('company-field');

            userTypeSelect.addEventListener('change', function () {
                if (this.value === 'internal') {
                    departmentField.classList.remove('hidden');
                    companyField.classList.add('hidden');
                } else if (this.value === 'external') {
                    departmentField.classList.add('hidden');
                    companyField.classList.remove('hidden');
                } else {
                    departmentField.classList.add('hidden');
                    companyField.classList.add('hidden');
                }
            });
        });
    </script>
</x-guest-layout>
