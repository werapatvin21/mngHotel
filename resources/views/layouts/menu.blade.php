<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
     m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        @foreach(config('mainmenu') as $menu)
            @if($submenu = array_get($menu, 'submenu', []))
                @if($menu['title'] && \Illuminate\Support\Facades\Auth::user()->staff_role === 'admin')
                <li class="m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        {{--<i class="m-menu__link-icon flaticon-layers"></i>--}}
                        <i class="m-menu__link-icon {{$menu['icon']}}"></i>
                        <span class="m-menu__link-text">{{$menu['title']}}</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>

                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                        class="m-menu__link"><span
                                            class="m-menu__link-text">{{$menu['title']}}</span></span></li>
                            @foreach($submenu as $sub)
                                <li id="m-menu__item--{{$sub['url']}}"
                                    class="m-menu__item {{ (starts_with(\Illuminate\Support\Facades\Route::currentRouteName(),$sub['url']) || ($menu['url'] == 'manage' && $sub['url'] == 'project' && starts_with(\Illuminate\Support\Facades\Route::currentRouteName(), ["project", "building", "room"]))) ? 'm-menu__item--active' : '' }}  "
                                    aria-haspopup="true">
                                    {{--                                <li id="m-menu__item--{{$sub['url']}}" class="m-menu__item {{ (starts_with(\Illuminate\Support\Facades\Route::currentRouteName(),$sub['url']) || ($menu['url'] == 'manage' && $sub['url'] == 'project' && starts_with(\Illuminate\Support\Facades\Route::currentRouteName(), ["project", "building", "room"])) || ($menu['url'] == 'repair$services' && $sub['url'] == 'allServices' && starts_with(\Illuminate\Support\Facades\Route::currentRouteName(), ["allServices"]))) ? 'm-menu__item--active' : '' }}  " aria-haspopup="true">--}}
                                    <a href="{{ route($sub['url'] . '.index') }}" class="m-menu__link ">
                                        @if(array_get($sub, 'icon'))
                                            <i class="m-menu__link-icon {{$sub['icon']}}"></i>
                                        @else
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                        @endif
                                        <span class="m-menu__link-text">{{$sub['title']}}</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </li>
                @endif
            @else
                <li class="m-menu__item {{ starts_with(\Illuminate\Support\Facades\Route::currentRouteName(),$menu['url']) ? 'm-menu__item--active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route($menu['url'] . '.index') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon {{$menu['icon']}}"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">{{$menu['title']}}</span>
                            </span>
                        </span>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
