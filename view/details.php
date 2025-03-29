<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task/Add</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <!-- Header with back button -->
        <div class="d-flex flex-row align-items-center justify-content-center mt-3 gap-2">
            <a href="../public/index.php" class="button_back me-2" aria-label="Back to home page"><i class="bi bi-arrow-left"></i></a>
            <h1 class="mt-1 text-center">Details Task</h1>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center mt-4">
            <?php if (isset($task) && $task !== null): ?>
            <p><strong>Nom de la tâche :</strong> <?php echo htmlspecialchars($task['name_task'] ?? 'Non défini'); ?></p>
            <p><strong>Détails :</strong> <?php echo htmlspecialchars($task['details_task'] ?? 'Non défini'); ?></p>
            <p><i class="bi bi-star-fill" style="color: rgb(255, 0, 123); font-size: 15px; margin-right:5px;"></i><strong>Important :</strong> <?php echo $task['important_task'] == 1 ? 'Oui' : 'Non'; ?></p>
            <p><i class="bi bi-arrow-repeat" style="color: rgb(255, 0, 123);font-size: 15px;margin-right:5px;"></i><strong>Répéter :</strong> <?php echo $task['repeat_task'] == 1 ? 'Oui' : 'Non'; ?></p>
            <p><strong>Temps de fin :</strong> <?php echo htmlspecialchars($task['end_time_task'] ?? 'Non défini'); ?></p>
            <p><strong>Statut :</strong> <?php echo $task['statut_task'] == 1 ? 'Terminé ✅' : 'En cours ⏳'; ?></p>
            <?php else: ?>
            <p>Aucune tâche à afficher.</p>
            <?php endif; ?>
 
            <!-- Vous pouvez ajouter d'autres boutons ou options ici -->
            <!-- Lien vers la modification de la tâche -->
            <a class="my-3 a_details" href="../public/index.php?action=edit&id=<?php echo $task['id_task']; ?>">Modifier</a>

            <!-- Lien vers la suppression de la tâche -->
            <a class="my-3 a_details" href="../public/index.php?action=delete&id=<?php echo $task['id_task']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">Supprimer</a>
        </div>
   </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

