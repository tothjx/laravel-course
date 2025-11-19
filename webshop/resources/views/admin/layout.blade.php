<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ config('app.name', 'Webshop') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>&nbsp;<strong>ADMIN PANEL</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">
                            <i class="bi bi-cart-check"></i> Rendelések
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">
                            <i class="bi bi-person"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.password') ? 'active' : '' }}" href="{{ route('admin.password') }}">
                            <i class="bi bi-key"></i> Jelszó módosítása
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell"></i> Értesítések
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-badge" style="display: none;">
                                0
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown" id="notifications-list" style="min-width: 300px; max-height: 400px; overflow-y: auto;">
                            <li><span class="dropdown-item-text">Értesítések betöltése...</span></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}" target="_blank">
                            <i class="bi bi-box-arrow-up-right"></i> Webshop
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">
                                <i class="bi bi-box-arrow-right"></i> Kilépés
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Load notifications via AJAX
        function loadNotifications() {
            console.log('Loading notifications...');
            fetch('{{ route('admin.notifications') }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response received:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Notifications data:', data);
                const notificationsList = document.getElementById('notifications-list');
                const notificationBadge = document.getElementById('notification-badge');

                if (!notificationsList || !notificationBadge) {
                    console.error('Notification elements not found');
                    return;
                }

                // Update badge
                if (data.unread_count > 0) {
                    notificationBadge.textContent = data.unread_count;
                    notificationBadge.style.display = 'inline-block';
                } else {
                    notificationBadge.style.display = 'none';
                }

                // Update list
                if (data.notifications.length === 0) {
                    notificationsList.innerHTML = '<li><span class="dropdown-item-text">Nincs értesítés</span></li>';
                } else {
                    notificationsList.innerHTML = data.notifications.map(notification => {
                        // Data can be either string or object
                        const notifData = typeof notification.data === 'string'
                            ? JSON.parse(notification.data)
                            : notification.data;
                        const isUnread = !notification.read_at;
                        return `
                            <li>
                                <a class="dropdown-item ${isUnread ? 'bg-light fw-bold' : ''}" href="#" onclick="markAsRead('${notification.id}'); return false;">
                                    <div class="d-flex justify-content-between">
                                        <span>${notifData.message || 'Új rendelés érkezett'}</span>
                                        ${isUnread ? '<i class="bi bi-circle-fill text-primary" style="font-size: 8px;"></i>' : ''}
                                    </div>
                                    <small class="text-muted">${new Date(notification.created_at).toLocaleString('hu-HU')}</small>
                                </a>
                            </li>
                        `;
                    }).join('');
                }
            })
            .catch(error => {
                console.error('Error loading notifications:', error);
                const notificationsList = document.getElementById('notifications-list');
                if (notificationsList) {
                    notificationsList.innerHTML = '<li><span class="dropdown-item-text text-danger">Hiba az értesítések betöltésekor</span></li>';
                }
            });
        }

        function markAsRead(notificationId) {
            fetch(`/admin/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(() => loadNotifications())
            .catch(error => console.error('Error marking notification as read:', error));
        }

        // Load notifications on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing notifications...');
            loadNotifications();
        });

        // Refresh notifications every 30 seconds
        setInterval(loadNotifications, 30000);
    </script>
    @stack('scripts')
</body>
</html>
