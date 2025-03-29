<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Girly Plan / Profil</title>
  <link rel="icon" href="../view/icon.png" type="image/png">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../style/main.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <style>
        body {
          background-color: rgba(195, 196, 195, 0.333);
            font-family: 'Arial', sans-serif;
        }
        .card {
            background-color: #fff5f5;
            border: 2px solid rosybrown;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            color: rosybrown;
            font-weight: bold;
        }
        .btn-primary {
            background-color: rosybrown;
            border-color: rosybrown;
        }
        .btn-primary:hover {
            background-color: #b78484;
            border-color: #b78484;
        }
        .btn-danger {
            background-color: #ffb6c1;
            border-color: #ffb6c1;
            color: white;
        }
        .btn-danger:hover {
            background-color: #e57373;
            border-color: #e57373;
        }
    </style>
</head>
<body>
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
          <li><a class="dropdown-item" href="../public/index.php?action=profile" style="color:rosybrown;font-family: 'Playfair Display', serif;
    font-style: italic;">Profil</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="../public/index.php?action=logout" style="color:rosybrown;font-family: 'Playfair Display', serif;
    font-style: italic;">Déconnexion</a></li>
        </ul>
      </div>
  </section>
  <section class="d-flex flex-column mt-5">
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card p-4">
            <div class="card-body text-center">
            <img src="https://i.pinimg.com/736x/cf/17/69/cf1769f499bed0b34d0608086e865b76.jpg" alt="user" width="50" height="50" class="rounded-circle mb-2">
                <h3 class="card-title mb-3">Mon Profil</h3>
                <p class="card-text"><strong style="font-family: 'Playfair Display', serif;font-style: italic; margin-right:5px; text-decoration:underline;">Nom d'utilisateur :</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p class="card-text"><strong style="font-family: 'Playfair Display', serif;font-style: italic; margin-right:5px;text-decoration:underline;">Email :</strong> <?php echo htmlspecialchars($user['mail']); ?></p>
               <!-- <?php if ($user['role']===1):
                  echo '<a href="../public/index.php?action=admin" class="btn btn-primary m-2">admin</a>';?>
                <?php endif;?>-->
          
                <a href="../public/index.php?action=edit_user&id=<?php echo $user['id_user']; ?>" class="btn btn-primary m-2">Modifier mes données</a>
                <a href="../public/index.php?action=delete_user&id=<?php echo $user['id_user']; ?>" class="btn btn-danger m-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">Supprimer mon compte</a>
            </div>
        </div>
    </div>
  </section>  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
