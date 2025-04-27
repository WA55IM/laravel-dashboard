<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ url('/dashboard') }}" class="app-brand-link"><x-app-logo /></a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
      <a class="menu-link" href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}</a>
    </li>

    <!-- Settings -->
    <li class="menu-item {{ request()->is('settings/*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog text-primary"></i>
        <div class="text-truncate">{{ __('Settings') }}</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('settings.profile') ? 'active' : '' }}">
          <a class="menu-link" href="{{ route('settings.profile') }}" wire:navigate>{{ __('Profile') }}</a>
        </li>
        <li class="menu-item {{ request()->routeIs('settings.password') ? 'active' : '' }}">
          <a class="menu-link" href="{{ route('settings.password') }}" wire:navigate>{{ __('Password') }}</a>
        </li>
      </ul>
    </li>

    <!-- Users -->
    <li class="menu-item">
      <a class="menu-link" href="{{ route('users.index') }}">
        <i class="fas fa-users text-primary me-2"></i>
        <span>{{ __('Users') }}</span>
      </a>
    </li>

    <!-- Comptes -->
    <li class="menu-item">
      <a class="menu-link" href="{{ route('comptes.index') }}">
        <i class="fas fa-university text-primary me-2"></i>
        <span>{{ __('Comptes') }}</span>
      </a>
    </li>

    <!-- Fournisseurs -->
    <li class="menu-item">
      <a class="menu-link" href=""> <!-- Update route if needed -->
        <i class="fas fa-truck text-primary me-2"></i>
        <span>{{ __('Fournisseurs') }}</span>
      </a>
    </li>

    <!-- Documents -->
    <li class="menu-item">
      <a class="menu-link" href=""> <!-- Update route if needed -->
        <i class="fas fa-file-upload text-primary me-2"></i>
        <span>{{ __('Documents') }}</span>
      </a>
    </li>
  </ul>
</aside>

<!-- / Menu -->

<script>
  // Toggle the 'open' class when the menu-toggle is clicked
  document.querySelectorAll('.menu-toggle').forEach(function(menuToggle) {
    menuToggle.addEventListener('click', function() {
      const menuItem = menuToggle.closest('.menu-item');
      // Toggle the 'open' class on the clicked menu-item
      menuItem.classList.toggle('open');
    });
  });
</script>
<style>/* Remove underline from menu links */
  #layout-menu .menu-link {
    text-decoration: none; /* Removes underline */
  }</style>