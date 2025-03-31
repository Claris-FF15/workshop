<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girly Plan / Calendar</title>
    <link rel="icon" href="../view/icon.png" type="image/png">
    

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="../style/main.css">
  <link rel="stylesheet"href="../style/calendar.css">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
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
<section style="margin-top:100px; display: inline-grid;">
        <div class="header">
            <button class="btn btn-danger" onclick="prevMonth()">◀ Mois précédent</button>
            <h3 id="monthYear"></h3>
            <button class="btn btn-danger" onclick="nextMonth()">Mois suivant ▶</button>
        </div>
        <div class="calendar mb-3" id="calendar"></div>
        
        <script>
            let currentDate = new Date();

            function renderCalendar() {
                const calendar = document.getElementById("calendar");
                const monthYear = document.getElementById("monthYear");
                const month = currentDate.getMonth();
                const year = currentDate.getFullYear();
                
                // Calculer le jour du premier jour du mois et ajuster si c'est dimanche (dimanche = 0, lundi = 1)
                const firstDay = new Date(year, month, 1).getDay();
                const adjustedFirstDay = (firstDay === 0) ? 6 : firstDay - 1;  // Ajuste pour commencer par lundi

                const lastDate = new Date(year, month + 1, 0).getDate();
                
                // Afficher le mois et l'année dans l'en-tête
                monthYear.textContent = new Intl.DateTimeFormat('fr-FR', { month: 'long', year: 'numeric' }).format(currentDate);
                
                // Réinitialiser le calendrier
                calendar.innerHTML = "";

                // Créer des cellules vides avant le premier jour du mois
                for (let i = 0; i < adjustedFirstDay; i++) {
                    let emptyCell = document.createElement("div");
                    calendar.appendChild(emptyCell);
                }

                // Créer les cellules des jours du mois
                for (let day = 1; day <= lastDate; day++) {
                    let dayCell = document.createElement("div");
                    dayCell.classList.add("day");
                    dayCell.innerHTML = `<h3>${day}</h3><div class='tasks'></div>`;
                    calendar.appendChild(dayCell);
                }
                
                // Charger les tâches
                fetchTasks();
            }

            function fetchTasks() {
                const month = currentDate.getMonth() + 1;  // Ajoute 1 car getMonth() retourne un index de 0 à 11
                const year = currentDate.getFullYear();

                // Récupérer les tâches pour le mois et l'année
                fetch(`../public/index.php?action=getTasksForMonth&month=${month}&year=${year}`)
                    .then(response => response.json())
                    .then(tasks => {
                        console.log(tasks);  // Vérifier que les tâches sont bien reçues

                        document.querySelectorAll('.day').forEach(dayCell => {
                            const day = parseInt(dayCell.querySelector('h3').textContent);
                            const taskContainer = dayCell.querySelector('.tasks');
                            taskContainer.innerHTML = "";  // Réinitialiser les tâches avant de les ajouter

                            // Ajouter les tâches du jour
                            tasks.forEach(task => {
                                if (parseInt(task.day) === day) {
                                    const taskElement = document.createElement("p");
                                    taskElement.textContent = task.name_task;
                                    taskContainer.appendChild(taskElement);
                                }
                            });
                        });
                    })
                    .catch(error => console.error("Erreur lors de la récupération des tâches:", error));
            }

            // Fonction pour afficher le mois précédent
            function prevMonth() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            }

            // Fonction pour afficher le mois suivant
            function nextMonth() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            }

            // Appel initial pour afficher le calendrier
            renderCalendar();
        </script>
    </main>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>



