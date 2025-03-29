<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Girly Plan / Archive</title>
<link rel="icon" href="../view/icon.png" type="image/png">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="../style/main.css">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
  <main class="d-flex w-100">
    <!-- Sidebar -->
    <section class="d-flex flex-column flex-shrink-0 bg-light Sidebar">
      <ul class="nav flex-column mb-auto align-items-center">
        <li>
          <a href="../public/index.php" class="nav-link active py-4 border-bottom rounded-0">
                    <i class="bi bi-house-door"></i>
          </a>
        </li>
        <li>
          <a href="../view/archive.php" class="nav-link py-4 border-bottom rounded-0">
            <i class="bi bi-archive"></i>
          </a>
        </li>
        <li>
          <a href="../public/index.php?action=create" class="nav-link py-4 border-bottom rounded-0">
            <i class="bi bi-window-plus"></i>
          </a>
        </li>
        <li>
          <a href="../public/index.php?action=getTasksForMonth&month=${month}&year=${year}" class="nav-link py-4 border-bottom rounded-0">
            <i class="bi bi-calendar-week"></i>
          </a>
        </li>
      </ul>
      <div class="dropdown border-top">
        <a href="#" class="d-flex align-items-center justify-content-center p-4 link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://i.pinimg.com/736x/cf/17/69/cf1769f499bed0b34d0608086e865b76.jpg" alt="user" width="30" height="30" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow">
          <li><a class="dropdown-item" href="profile.html">Profil</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="../public/index.php?action=logout">Déconnexion</a></li>
        </ul>
      </div>
    </section>          
    <!-- Main section -->
    <section class="container-fluid py-4">
      <h3 class="text-center">Archives des tâches</h3>
       
      <?php if (!empty($tasks['tasks'])): ?>
    <?php 
    $currentDate = null;
    foreach ($tasks['tasks'] as $task): 
        $taskDate = date('Y-m-d', strtotime($task['end_time_task']));
        if ($taskDate !== $currentDate):
            if ($currentDate !== null): ?>
                </div>
            <?php endif; ?>
            <h5 class="text-center mb-2 mt-4"><?php echo date('d/m/Y', strtotime($taskDate)); ?></h5>
            <div class="d-flex flex-column align-items-center justify-content-center">
        <?php 
            $currentDate = $taskDate;
        endif; ?> 
        <div class="list-group-item task-item" style="width: 400px; background-color: rgb(222, 222, 222);">
            <div class="d-flex gap-2">
                <input class="form-check-input flex-shrink-0" type="checkbox" checked disabled>
                <span style="color: gray;">
                    <strong><?php echo htmlspecialchars($task['name_task']); ?></strong>
                    <small class="d-block text-body-secondary">
                        <?php echo htmlspecialchars($task['details_task']); ?>
                    </small>
                </span>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-center mt-4">Aucune tâche terminée.</p>
<?php endif; ?>

    </section>                   
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
