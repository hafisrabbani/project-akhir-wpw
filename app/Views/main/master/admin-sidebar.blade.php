<li class="sidebar-item {{ ($_SERVER['REQUEST_URI'] == '/dashboard/manage-user/') ? 'active' : '' }}">
    <a href=" {{ route('manage-user') }} " class="sidebar-link">
        <i class="fas fa-users"></i>
        <span>Manage User</span>
    </a>
</li>