<?php
// Check authentication
$token = $_COOKIE['receptionist_token'] ?? '';
if (empty($token)) {
    header('Location: ../');
    exit;
}

// Modular Receptionist Dashboard
// All components are in the dashboard/ subdirectory
?>
<?php require_once __DIR__ . '/dashboard/header.php'; ?>

<?php require_once __DIR__ . '/dashboard/sidebar.php'; ?>

<!-- Main Content -->
<main class="flex-1 flex flex-col overflow-hidden relative">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/70 via-slate-800/60 to-slate-900/70 backdrop-blur-3xl"></div>
    <div class="absolute top-10 right-20 w-2 h-2 bg-cyan-400 rounded-full blur-sm opacity-40 animate-bounce" style="animation-duration: 3s;"></div>
    <div class="absolute top-40 right-60 w-3 h-3 bg-cyan-400 rounded-full blur-sm opacity-30 animate-pulse" style="animation-duration: 4s;"></div>
    <div class="absolute bottom-40 right-40 w-2 h-2 bg-vital-orange rounded-full blur-sm opacity-40 animate-bounce" style="animation-duration: 5s;"></div>

    <?php require_once __DIR__ . '/dashboard/topbar.php'; ?>

    <!-- Content Area -->
    <div class="flex-1 overflow-y-auto p-6 relative z-10 scrollbar-thin scrollbar-thumb-cyan-500/20 scrollbar-track-transparent">

        <?php require_once __DIR__ . '/dashboard/dashboard-tab.php'; ?>

        <?php require_once __DIR__ . '/dashboard/messages-tab.php'; ?>

    </div>
</main>

<?php require_once __DIR__ . '/dashboard/scripts.php'; ?>

<?php require_once __DIR__ . '/dashboard/modals.php'; ?>

<?php require_once __DIR__ . '/dashboard/footer.php'; ?>

