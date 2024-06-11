<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('感謝您的註冊！在開始之前，請點擊我們剛剛發送到您信箱的連結來驗證您的電子郵件。如果您沒有收到信件，我們很樂意再發送一封給您。') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('新的驗證連結已發送至您註冊時提供的電子郵件。') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('重新發送驗證信件') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('登出') }}
            </button>
        </form>
    </div>
</x-guest-layout>
