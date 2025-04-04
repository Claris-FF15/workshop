<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Girly plan / Dashboard</title>
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
          <a href="../public/index.php?action=create" class="nav-link py-4 border-bottom rounded-0">
            <i class="bi bi-window-plus"></i>
          </a>
        </li>
        <li>
          <a href="../view/calendar.php" class="nav-link py-4 border-bottom rounded-0">
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
    <!-- Main section -->
    <section class="container-fluid py-4">
      <h3 class="text-center title-list">Liste des tâches :</h3>
      <div class="row">
        <!-- list task day -->
        <div class="col-12 mb-4">
          <h5 class="text-center mb-1 mt-4 title_task">
            <script>
              var today = new Date();
              var date = today.toLocaleDateString();
              document.write(date);
            </script>
          </h5>
          <div class="d-flex flex-column align-items-center justify-content-center w-100">
            <div class="list-group mt-1">
              <?php
                $today = date("Y-m-d");
              ?>
              <?php foreach ($tasks as $task): ?>
                <?php if ($task['id_user'] == $_SESSION['id_user'] && $task['end_time_task'] == $today && $task['important_task'] == 1 && $task['repeat_task'] == 0 && $task['statut_task'] == 0): ?>
                    <div class="list-group-item d-flex gap-2 task-item" style="background-color:rgba(188, 143, 143, 0.48)">
                      <input class="form-check-input check flex-shrink-0 mt-1" type="checkbox" data-task-id="<?php echo $task['id_task']; ?>" data-repeat-task="0" value="">
                      <a style="text-decoration:none;" href="../public/index.php?action=details&id=<?php echo $task['id_task']; ?>">
                        <span class="text-center" style="color:rgb(255, 0, 123);">
                            <strong><?php echo htmlspecialchars($task['name_task']); ?></strong>
                            <i class="bi bi-star-fill" style="color: rgb(255, 0, 123); font-size: 15px; margin-left: 50px; justify-content:left;"></i>
                            <small class="d-block text-body-secondary"><?php echo htmlspecialchars($task['details_task']); ?></small>
                        </span>
                      </a>
                    </div>
                <?php elseif ($task['id_user'] == $_SESSION['id_user'] && $task['end_time_task'] == $today && $task['important_task'] == 0 && $task['repeat_task'] == 0 && $task['statut_task'] == 0): ?>
                    <div class="list-group-item d-flex gap-2 task-item">
                      <input class="form-check-input check flex-shrink-0 mt-1" type="checkbox" data-task-id="<?php echo $task['id_task']; ?>" data-repeat-task="0" value="">
                      <a style="text-decoration:none;color:rosybrown;" href="../public/index.php?action=details&id=<?php echo $task['id_task']; ?>">
                        <span>
                          <strong><?php echo htmlspecialchars($task['name_task']); ?></strong>
                          <small class="d-block text-body-secondary"><?php echo htmlspecialchars($task['details_task']); ?></small>
                        </span>
                      </a>
                    </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <!-- repetion task -->
        <div class="col-12 mb-4">
          <h5 class="text-center mb-2 mt-2 title-list">
            Tâches répétitives
            <button type="button" class="mx-2" id="resetRepeatTasksBtn"><i class="bi bi-arrow-repeat" style="font-size: 20px;"></i></button>
          </h5>
          <div class="d-flex flex-column align-items-center justify-content-center w-100">
            <div class="list-group mt-1 ">
              <?php foreach ($tasks as $task):?>
                <?php if ($task['id_user'] == $_SESSION['id_user'] && $task['repeat_task'] == 1 && $task['statut_task'] == 0): ?>
                  <div class="list-group-item d-flex gap-2 task-item">
                    <input class="form-check-input check flex-shrink-0 mt-1" type="checkbox" data-task-id="<?php echo $task['id_task']; ?>" data-repeat-task="1" value="">
                      <a style="text-decoration:none;color:rosybrown;"href="../public/index.php?action=details&id=<?php echo $task['id_task']; ?>">
                        <span>
                          <strong><?php echo htmlspecialchars($task['name_task']); ?></strong>
                          <small class="d-block text-body-secondary"><?php echo htmlspecialchars($task['details_task']); ?></small>
                        </span>
                      </a>
                  </div>
                <?php endif; ?>
              <?php endforeach;?>
            </div>
          </div>
        </div>
        <!-- finished task -->
        <div class="col-12 mb-4">
          <h5 class="text-center mb-2 mt-1 px-0 date-list">Tâches terminées</h5>
          <div class="d-flex flex-column align-items-center justify-content-center w-100">
            <div class="list-group main_content">
              <?php foreach ($tasks as $task):?>
                <?php if ($task['id_user'] == $_SESSION['id_user'] && $task['end_time_task'] == $today && $task['statut_task'] == 1 && $task['repeat_task'] == 0):?>
                  <div class="list-group-item d-flex gap-2 task-item" style="background-color: rgb(222, 222, 222);">
                    <input class="form-check-input flex-shrink-0" type="checkbox" value="1" checked>
                    <a style="text-decoration:none;"href="../public/index.php?action=details&id=<?php echo $task['id_task']; ?>">
                      <span style="color: gray;">
                        <strong><?php echo htmlspecialchars($task['name_task']); ?></strong>
                        <small class="d-block text-body-secondary"><?php echo htmlspecialchars($task['details_task']); ?></small>
                      </span>
                    </a>
                  </div>
                <?php endif; ?>
              <?php endforeach;?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".task-item .form-check-input").forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            const taskId = this.dataset.taskId;
            const isRepeatTask = this.dataset.repeatTask === "1";
            const taskItem = this.closest('.task-item');

            if (!isRepeatTask && taskId) {
                const formData = new FormData();
                formData.append('id_task', taskId);
                formData.append('statut_task', this.checked ? '1' : '0');

                fetch('../public/index.php?action=updateStatus', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Réponse serveur:', data);
                    if (data.success) {
                        location.reload();
                    } else {
                        throw new Error('Échec de la mise à jour');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    this.checked = !this.checked;
                });
              }
          });
      });

      document.getElementById("resetRepeatTasksBtn").addEventListener("click", function () {
          fetch("../public/index.php?action=resetRepeatTask", {
              method: "POST",
              credentials: "include"
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  location.reload(); 
              } else {
                  alert("Erreur lors de la réinitialisation des tâches répétitives.");
              }
          })
          .catch(error => console.error("Erreur lors de la réinitialisation :", error));
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>


