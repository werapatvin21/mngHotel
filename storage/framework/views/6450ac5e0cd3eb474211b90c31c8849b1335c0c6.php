<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
     m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <?php $__currentLoopData = config('mainmenu'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($submenu = array_get($menu, 'submenu', [])): ?>
                <?php if($menu['title'] && \Illuminate\Support\Facades\Auth::user()->staff_role === 'admin'): ?>
                <li class="m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded"
                    aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        
                        <i class="m-menu__link-icon <?php echo e($menu['icon']); ?>"></i>
                        <span class="m-menu__link-text"><?php echo e($menu['title']); ?></span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>

                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                        class="m-menu__link"><span
                                            class="m-menu__link-text"><?php echo e($menu['title']); ?></span></span></li>
                            <?php $__currentLoopData = $submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li id="m-menu__item--<?php echo e($sub['url']); ?>"
                                    class="m-menu__item <?php echo e((starts_with(\Illuminate\Support\Facades\Route::currentRouteName(),$sub['url']) || ($menu['url'] == 'manage' && $sub['url'] == 'project' && starts_with(\Illuminate\Support\Facades\Route::currentRouteName(), ["project", "building", "room"]))) ? 'm-menu__item--active' : ''); ?>  "
                                    aria-haspopup="true">
                                    
                                    <a href="<?php echo e(route($sub['url'] . '.index')); ?>" class="m-menu__link ">
                                        <?php if(array_get($sub, 'icon')): ?>
                                            <i class="m-menu__link-icon <?php echo e($sub['icon']); ?>"></i>
                                        <?php else: ?>
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                        <?php endif; ?>
                                        <span class="m-menu__link-text"><?php echo e($sub['title']); ?></span></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                </li>
                <?php endif; ?>
            <?php else: ?>
                <li class="m-menu__item <?php echo e(starts_with(\Illuminate\Support\Facades\Route::currentRouteName(),$menu['url']) ? 'm-menu__item--active' : ''); ?>"
                    aria-haspopup="true">
                    <a href="<?php echo e(route($menu['url'] . '.index')); ?>" class="m-menu__link ">
                        <i class="m-menu__link-icon <?php echo e($menu['icon']); ?>"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text"><?php echo e($menu['title']); ?></span>
                            </span>
                        </span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH C:\Users\aommy\hotel\resources\views/layouts/menu.blade.php ENDPATH**/ ?>