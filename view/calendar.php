<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girly Plan / Calendar</title>
    <link rel="icon" href="../view/icon.png" type="image/png">
    
    <!-- CSS -->
    <link rel="stylesheet"href="../style/calendar.css">
</head>
<body>
    <main>
        <div class="header">
            <button onclick="prevMonth()">◀ Mois précédent</button>
            <h2 id="monthYear"></h2>
            <button onclick="nextMonth()">Mois suivant ▶</button>
        </div>
        <div class="calendar" id="calendar"></div>
        
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
</body>
</html>



