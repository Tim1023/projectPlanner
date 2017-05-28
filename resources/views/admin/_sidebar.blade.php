<div class="col-sm-2">
    <div class="list-group">
        @foreach($sidebarMenuList as $menu)
            <a href="{{ route($menu->route) }}"
               class="list-group-item {{ ($activeSidebarMenuItem == $menu->active) ? 'active' : '' }}">{{  $menu->title }}</a>
        @endforeach
    </div>
</div>
