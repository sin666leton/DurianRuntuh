<div class="space-y-4">
    @if(filled($errorMessage))
        <div class="bg-red-400 text-white rounded-sm border-2 border-red-500 px-4 py-2 font-bold">
            {{ $errorMessage }}
        </div>
    @endif
    <x-card>
        <div class="flex justify-center mb-6 mt-2">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Aplikasi" class="h-16 w-auto">
        </div>
        <form wire:submit="submit">
            <div class="flex flex-col gap-2">
                <x-input
                    wire:model="email"
                    type="email"
                    label="Email"
                    msg="{{ $errors->has('email') ? '* '.$errors->first('email') : '' }}"
                    required
                />
                <x-input
                    wire:model="password"
                    type="password"
                    label="Password"
                    msg="{{ $errors->has('password') ? '* '.$errors->first('password') : '' }}"
                    required
                />
                <div class="flex justify-center mt-7 space-y-4">
                    <button wire:loading.attr="disabled" class="flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed text-white w-2/3 min-h-10 text-sm font-bold bg-[#3e77f4] rounded-full hover:bg-[#3669d9] duration-100 cursor-pointer">
                        <span wire:loading.remove wire:target="submit" class="font-bold">Masuk</span>
                        
                        <span wire:loading wire:target="submit" class="">
                            <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path fill="rgb(255, 255, 255)" d="M272 112C272 85.5 293.5 64 320 64C346.5 64 368 85.5 368 112C368 138.5 346.5 160 320 160C293.5 160 272 138.5 272 112zM272 528C272 501.5 293.5 480 320 480C346.5 480 368 501.5 368 528C368 554.5 346.5 576 320 576C293.5 576 272 554.5 272 528zM112 272C138.5 272 160 293.5 160 320C160 346.5 138.5 368 112 368C85.5 368 64 346.5 64 320C64 293.5 85.5 272 112 272zM480 320C480 293.5 501.5 272 528 272C554.5 272 576 293.5 576 320C576 346.5 554.5 368 528 368C501.5 368 480 346.5 480 320zM139 433.1C157.8 414.3 188.1 414.3 206.9 433.1C225.7 451.9 225.7 482.2 206.9 501C188.1 519.8 157.8 519.8 139 501C120.2 482.2 120.2 451.9 139 433.1zM139 139C157.8 120.2 188.1 120.2 206.9 139C225.7 157.8 225.7 188.1 206.9 206.9C188.1 225.7 157.8 225.7 139 206.9C120.2 188.1 120.2 157.8 139 139zM501 433.1C519.8 451.9 519.8 482.2 501 501C482.2 519.8 451.9 519.8 433.1 501C414.3 482.2 414.3 451.9 433.1 433.1C451.9 414.3 482.2 414.3 501 433.1z"/>
                            </svg>
                        </span>
                    </button>
                    <!-- <span class="text-sm text-center">Belum punya akun? <a href="/register" class="text-[#3669d9] font-bold">Masuk</a></span> -->
                </div>
            </div>
        </form>
    </x-card>
</div>