<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girly Plan / Calendar</title>
    <link rel="icon" href="../view/icon.png" type="image/png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/calendar.css">
    
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

        <!-- Conteneur pour tous les modals -->
        <div id="modals-container"></div>
    </section>
</main>

<script>
    let currentDate = new Date();

    function renderCalendar() {
        const calendar = document.getElementById("calendar");
        const monthYear = document.getElementById("monthYear");
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
        
        const firstDay = new Date(year, month, 1).getDay();
        const adjustedFirstDay = (firstDay === 0) ? 6 : firstDay - 1; // Lundi = 1

        const lastDate = new Date(year, month + 1, 0).getDate();
        
        monthYear.textContent = new Intl.DateTimeFormat('fr-FR', { month: 'long', year: 'numeric' }).format(currentDate);
        
        calendar.innerHTML = "";

        // Cases vides avant le premier jour du mois
        for (let i = 0; i < adjustedFirstDay; i++) {
            let emptyCell = document.createElement("div");
            calendar.appendChild(emptyCell);
        }

        // Génération des jours du mois
        for (let day = 1; day <= lastDate; day++) {
            let dayCell = document.createElement("div");
            dayCell.classList.add("day");
            dayCell.innerHTML = `
                <a  data-bs-toggle="modal" data-bs-target="#modal-${day}">
                <h3>${day}</h3>
                <div class='tasks'></div>
                </a>
            `;
            calendar.appendChild(dayCell);
        }
        
        fetchTasks();
        generateModals();
    }

    function fetchTasks() {
        const month = currentDate.getMonth() + 1;
        const year = currentDate.getFullYear();

        fetch(`../public/index.php?action=getTasksForMonth&month=${month}&year=${year}`)
            .then(response => response.json())
            .then(tasks => {
                document.querySelectorAll('.day').forEach(dayCell => {
                    const day = parseInt(dayCell.querySelector('h3').textContent);
                    const taskContainer = dayCell.querySelector('.tasks');
                    const modalBody = document.getElementById(`modal-body-${day}`);

                    taskContainer.innerHTML = "";
                    modalBody.innerHTML = "<p>Aucune tâche pour ce jour.</p>";

                    let taskList = "";
                    tasks.forEach(task => {
                        if (parseInt(task.day) === day) {
                            const taskElement = document.createElement("p");
                            taskElement.textContent = task.name_task;
                            taskContainer.appendChild(taskElement);
                            taskList += `<li><strong>${task.name_task}</strong><br>${task.desc_task ?? ''}</li>`;
                        }
                    });

                    if (taskList) {
                        modalBody.innerHTML = taskList;
                    }
                });
            })
            .catch(error => console.error("Erreur lors de la récupération des tâches:", error));
    }

    function generateModals() {
        let modalsContainer = document.getElementById("modals-container");
        modalsContainer.innerHTML = "";

        const lastDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();

        for (let day = 1; day <= lastDate; day++) {
            let modal = document.createElement("div");
            modal.innerHTML = `
                <div class="modal fade" id="modal-${day}" tabindex="-1" aria-labelledby="modalLabel-${day}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel-${day}">Détails du ${day}/${currentDate.getMonth() + 1}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="modal-body-${day}">
                                <p>Chargement des tâches...</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            modalsContainer.appendChild(modal);
        }
    }

    function prevMonth() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    }

    function nextMonth() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    }

    renderCalendar();
</script>

<!-- Bootstrap Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>




