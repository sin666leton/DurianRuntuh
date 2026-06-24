<nav class="bg-[#3e77f4] flex items-center justify-between min-h-16 max-h-16 px-6 sticky top-0 z-50" x-data="{ isDropdownOpen: false }" >
    <div @click="sidebar = !sidebar" class="w-10 h-10 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
            <path fill="rgb(255, 255, 255)" d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z"/>
        </svg>
    </div>
    
    <div class="flex justify-start items-center max-w-40 whitespace-nowrap text-ellipsis overflow-hidden gap-3 cursor-pointer" @click="isDropdownOpen = !isDropdownOpen">
        <div
            class="rounded-full"
            x-data="{ name: '{{ $name }}' }"
            x-html="avatarHTML(name, 30)"
        ></div>
        <h4 class="flex-1 text-white font-bold text-sm">{{ $name }}</h4>
        <div
            :class="isDropdownOpen ? 'rotate-0' : 'rotate-180'"
            class="w-4"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path fill="rgb(255, 255, 255)" d="M300.3 199.2C312.9 188.9 331.4 189.7 343.1 201.4L471.1 329.4C480.3 338.6 483 352.3 478 364.3C473 376.3 461.4 384 448.5 384L192.5 384C179.6 384 167.9 376.2 162.9 364.2C157.9 352.2 160.7 338.5 169.9 329.4L297.9 201.4L300.3 199.2z"/></svg>
        </div>
    </div>
    
    <!-- Dropdown -->
    <div x-show="isDropdownOpen" class="flex flex-col gap-4 bg-white max-w-60 w-60 absolute right-7 top-[80%] rounded-md shadow-sm border-gray-100 py-2">
        <!-- Header dropdown -->
        <div class="flex flex-col px-4 py-2">
            <h4 class="text-sm font-bold">{{ $name }}</h4>
            <h5 class="text-sm text-gray-400">{{ $email }}</h5>
        </div>

        <!-- Menu -->
        <div class="flex border-t border-gray-200 pt-3 px-3 rounded-md">
            <!-- Logout -->
            <div class="flex items-center gap-2 cursor-pointer w-full hover:bg-[#ff4949] hover:text-white text-gray-700 duration-100 px-3 py-2 rounded-md" wire:click="logout">
                <div class="w-5">
                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160zM566.6 342.6C579.1 330.1 579.1 309.8 566.6 297.3L438.6 169.3C426.1 156.8 405.8 156.8 393.3 169.3C380.8 181.8 380.8 202.1 393.3 214.6L466.7 288L256 288C238.3 288 224 302.3 224 320C224 337.7 238.3 352 256 352L466.7 352L393.3 425.4C380.8 437.9 380.8 458.2 393.3 470.7C405.8 483.2 426.1 483.2 438.6 470.7L566.6 342.7z"/></svg>
                </div>
                <div>
                    <h5 class="text-sm font-semibold">Keluar</h5>
                </div>
            </div>
        </div>
    </div>
</nav>