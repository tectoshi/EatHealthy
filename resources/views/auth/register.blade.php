<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nickname -->
            <div>
                <x-label for="nickname" :value="__('Nickname')" />

                <x-input id="nickname" class="block mt-1 w-full" type="text" name="nickname" :value="old('nickname')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required />
            </div>

            <!-- Height -->
            <div>
                <x-label for="height" :value="__('身長')" />

                <x-input id="height" class="block mt-1 w-full" type="text" name="height" :value="old('height')" required autofocus />
            </div>

            <!-- Weight -->
            <div>
                <x-label for="weight" :value="__('体重')" />

                <x-input id="weight" class="block mt-1 w-full" type="text" name="weight" :value="old('weight')" required autofocus />
            </div>

            <!-- Sex -->
            <div>
                <label>{{ __('性別') }}
                    <div class="form-check form-check-inline">
                        <input type="radio" name="sex" class="form-check-input" id="sex1" value="1" {{ old ('sex') == '男性' ? 'checked' : '' }} checked>
                        <label for="sex1" class="form-check-label">男性</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="sex" class="form-check-input" id="sex2" value="2" {{ old ('sex') == '女性' ? 'checked' : '' }}>
                        <label for="sex2" class="form-check-label">女性</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="sex" class="form-check-input" id="sex3" value="3" {{ old ('sex') == 'どちらでもない' ? 'checked' : '' }}>
                        <label for="sex3" class="form-check-label">どちらでもない</label>
                    </div>
                </label>            </div>

            <!-- birth -->
            <x-label for="birth" :value="__('誕生日')" />

            <x-input id="birth" class="block mt-1 w-full" type="date" name="birth" :value="old('birth')" required autofocus />

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('新規登録') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
