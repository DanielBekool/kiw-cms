@php
    use Datlechin\FilamentMenuBuilder\Models\Menu;
    $menu = Menu::location('header');
@endphp
@pushOnce('before_head_close')
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpushOnce
<!--Start Header Menu-->
<div x-data="{ open: false, openSubMenu: null }"
     x-effect="document.body.classList.toggle('off-canvas-open', open)"> 

    <header class="absolute top-0 left-1/2 -translate-x-1/2 w-full lg:w-[1200px] z-50 lg:p-0 sm:p-6 px-4 pt-2">
        <div class="lg:max-w-[1200px] mx-auto flex lg:pt-5 sm:pt-1 pt-1 justify-between gap-10">
    
            <!--Logo-->
            <div class=" flex items-center ">
                    <a href="/"><img class="!w-12 sm:!w-14 lg:!w-20 mr-20 filter brightness-0 invert" src="{{ asset('storage/media/logo.png') }}" alt="logo"></a>
            </div>

            <div class="flex flex-col justify-between w-full grow">
                
                <!--Above Header-->
                <div class="hidden lg:flex lg:flex-row lg:justify-end gap-5">
                        
                    <!--Button-->
                    <a class=" btn5 group w-fit" href="#" target="_blank" rel="noopener noreferrer">
                        Hubungi Kami
                        <span class="gradient-icon">
                            <x-icon.pencil/>
                        </span>
                    </a>

                    <a class=" btn5 group w-fit" href="#" target="_blank" rel="noopener noreferrer">
                        Unduh Brosur
                    <span class="gradient-icon">
                        <x-icon.download-icon-current/>
                    </span>
                    </a>

                    <!--Translate-->
                    <div class="flex flex-row gap-5 items-center text-white ">
                            <a href="#" class="hover:text-[var(--color-lightblue)] border-r border-[var(--color-bordertransparent)] pr-5 flex flex-row gap-2 items-center">
                            <img class="w-5 h-4" src="{{ asset('storage/media/english.jpg') }}" alt="english">
                            English
                        </a>
                            <a href="#" class="hover:text-[var(--color-lightblue)] border-r border-[var(--color-bordertransparent)] pr-5 flex flex-row gap-2 items-center">
                            <img class="w-5 h-4" src="{{ asset('storage/media/mandarin.jpg') }}" alt="mandarin">
                            Mandarin
                        </a>
                        <a href="#" class="hover:text-[var(--color-lightblue)] border-r border-[var(--color-bordertransparent)] pr-5 flex flex-row gap-2 items-center">
                            <img class="w-5 h-4" src="{{ asset('storage/media/korea.jpg') }}" alt="korea">
                            Korea
                        </a>
                        <a href="#" class="hover:text-[var(--color-lightblue)] flex flex-row gap-2 items-center">
                            <img class="w-5 h-4" src="{{ asset('storage/media/indonesia.jpg') }}" alt="indonesia">
                            Indonesia
                        </a>
                    </div>

                </div>

                <!--Main Menu-->
                @if ($menu && $menu->menuItems)
                <nav class="hidden lg:flex lg:flex-row lg:justify-end">
                    <ul class="flex flex-row justify-between gap-2 items-end grow">
                        @foreach ($menu->menuItems as $item)
                            <li class="relative group">
                                @if ($item->children && count($item->children))
                                    <!-- Main Menu with Submenu -->
                                    <x-menu.parent-menu-have-sub
                                        menu="{!! $item->title !!}"
                                        url="{{ $item->url }}"
                                    />

                                    <!-- Submenu -->
                                    <ul class="absolute left-0 top-full mt-1 w-60 bg-white shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                                        @foreach ($item->children as $child)
                                            @if ($child->children && count($child->children))
                                                <!-- Submenu with Sub-submenu -->
                                                <li class="relative group/submenu">
                                                    <x-menu.sub-parent-menu
                                                        menu="{!! $child->title !!}"
                                                        url="{{ $child->url }}"
                                                    />
                                                    
                                                    <!-- Sub-submenu -->
                                                    <ul class="absolute left-full top-0 mt-0 w-40 bg-white shadow-lg opacity-0 invisible group-hover/submenu:opacity-100 group-hover/submenu:visible transition-all">
                                                        @foreach ($child->children as $subchild)
                                                            <x-menu.sub-sub-menu
                                                                menu="{!! $subchild->title !!}"
                                                                url="{{ $subchild->url }}"
                                                            />
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <!-- Submenu tanpa Sub-submenu -->
                                                <x-menu.sub-menu
                                                    menu="{!! $child->title !!}"
                                                    url="{{ $child->url }}"
                                                />
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <!-- Main Menu tanpa Submenu -->
                                    <x-menu.parent-menu
                                        menu="{!! $item->title !!}"
                                        url="{{ $item->url }}"
                                    />
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                @endif


            </div>

            


        <!-- Mobile Menu Button -->
        <div class="lg:hidden flex flex-col justify-center">
            <button @click="open = !open;"
                class="text-white focus:outline-none cursor-pointer"
            >
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Off-canvas Mobile Menu -->
        <div x-show="open" class="fixed inset-0 bg-black h-[100vh] bg-opacity-50 z-40 lg:hidden" @click="open = false"></div>

        <div x-show="open"
            class="fixed top-0 right-0 w-[90%] h-[100vh] bg-cover shadow-lg z-50 transform transition-transform duration-300 ease-in-out lg:hidden"
            style="background-image: linear-gradient(90deg, rgba(255, 255, 255, 0.95) 10%, rgba(255, 255, 255, 0.45) 100%), url({{ asset('storage/media/about-image.jpg') }});"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full">

            <div class="px-6 mt-5">
                <button @click="open = false" class="text-[var(--color-heading)] float-right">
                    ✕
                </button>

                <div class="pt-10 overflow-y-auto max-h-[95vh] scrollbar-hide">

                    <!--Logo-->
                    <div class=" flex items-center ">
                        <a href="/"><img class="w-15" src="{{ asset('storage/media/logo.png') }}" alt="logo"></a>
                    </div>

                    @if ($menu && $menu->menuItems)
                    <ul class="mt-10 flex flex-col gap-4">
                        @foreach ($menu->menuItems as $item)
                            @if ($item->children && count($item->children))
                                <!-- Parent menu with submenu -->
                                <x-menu-mobile.parent-menu-have-sub
                                    menu="{!! $item->title !!}"
                                    url="{{ $item->url ?? 'javascript:void(0)' }}"
                                >
                                    @foreach ($item->children as $child)
                                        @if ($child->children && count($child->children))
                                            <!-- Submenu that has sub-submenu -->
                                            <x-menu-mobile.sub-parent-menu
                                                menu="{!! $child->title !!}" 
                                                url="{{ $child->url ?? 'javascript:void(0)' }}"
                                            >
                                                @foreach ($child->children as $subchild)
                                                    <x-menu-mobile.menu
                                                        menu="{!! $subchild->title !!}"
                                                        url="{{ $subchild->url }}"
                                                    />
                                                @endforeach
                                            </x-menu-mobile.sub-parent-menu>
                                        @else
                                            <!-- Submenu item -->
                                            <x-menu-mobile.menu
                                                menu="{!! $child->title !!}" 
                                                url="{{ $child->url }}"
                                            />
                                        @endif
                                    @endforeach
                                </x-menu-mobile.parent-menu-have-sub>
                            @else
                                <!-- Simple parent menu -->
                                <x-menu-mobile.parent-menu
                                    menu="{!! $item->title !!}"
                                    url="{{ $item->url }}"
                                />
                            @endif
                        @endforeach
                    </ul>
                    @endif


                    <!-- Button -->
                     <div class="mt-10 flex flex-col gap-5">
                        <a class=" btn9 group w-fit" href="#" target="_blank" rel="noopener noreferrer">
                            Hubungi Kami
                            <span class="gradient-icon">
                                <x-icon.pencil/>
                            </span>
                        </a>

                        <a class=" btn9 group w-fit" href="#" target="_blank" rel="noopener noreferrer">
                            Unduh Brosur
                        <span class="gradient-icon">
                            <x-icon.download-icon-current/>
                        </span>
                        </a>
                     </div>

                    <!--Translate-->
                    <div class="mt-10 flex flex-row gap-5 items-center text-[var(--color-heading)] ">
                            <a href="#" class="hover:text-[var(--color-lightblue)] flex flex-row gap-2 items-center">
                            <img class="w-5 h-4" src="{{ asset('storage/media/english.jpg') }}" alt="english">
                            GB
                        </a>
                            <a href="#" class="hover:text-[var(--color-lightblue)] flex flex-row gap-2 items-center">
                            <img class="w-5 h-4" src="{{ asset('storage/media/mandarin.jpg') }}" alt="mandarin">
                            CN
                        </a>
                        <a href="#" class="hover:text-[var(--color-lightblue)] flex flex-row gap-2 items-center">
                            <img class="w-5 h-4" src="{{ asset('storage/media/korea.jpg') }}" alt="korea">
                            KR
                        </a>
                        <a href="#" class="hover:text-[var(--color-lightblue)] flex flex-row gap-2 items-center">
                            <img class="w-5 h-4" src="{{ asset('storage/media/indonesia.jpg') }}" alt="indonesia">
                            ID
                        </a>
                    </div> 

                </div>
            </div>
        </div>

    </header>
</div>   
<!--End Header Menu-->