<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Girly Plan / Edit Task</title>
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
    <main>
        <section>
            <div class="d-flex flex-row align-items-center justify-content-center mt-3 gap-2">
                <a href="../public/index.php" class="button_back me-2"><i class="bi bi-arrow-left"></i></a>
                <h1 class="mt-1 text-center">Edit Task</h1>
            </div>

            <form action="../public/index.php?action=edit&id=<?php echo htmlspecialchars($task['id_task']); ?>" method="post" class="d-flex flex-column align-items-center justify-content-center w-100 mt-4">
                
                <!-- Champ caché pour ID de la tâche -->
                <input type="hidden" name="id_task" value="<?php echo htmlspecialchars($task['id_task']); ?>">

                <!-- Task Name -->
                <label for="name_task" class="mb-2">Task Name</label>
                <input type="text" name="name_task" id="name_task" class="w-75 form-control" style="border-radius: 20px;border-color: rosybrown;"value="<?php echo htmlspecialchars($task['name_task']); ?>">

                <!-- Important Task Checkbox -->
                <div class="form-check mt-3">
                    <input type="checkbox" name="important_task" id="important_task" class="form-check-input" <?php echo ($task['important_task'] == 1) ? 'checked' : ''; ?>>
                    <label for="important_task" class="form-check-label">Important Task</label>
                </div>

                <!-- Repeat Task Checkbox -->
                <div class="form-check mt-3">
                    <input type="checkbox" name="repeat_task" id="repeat_task" class="form-check-input" <?php echo ($task['repeat_task'] == 1) ? 'checked' : ''; ?>>
                    <label for="repeat_task" class="form-check-label">Repeat Task</label>
                </div>

                <!-- Task Details -->
                <label for="details_task" class="mt-3 mb-2">Details</label>
                <textarea name="details_task" id="details_task" class="w-75 form-control"><?php echo htmlspecialchars($task['details_task']); ?></textarea>

                <!-- Task Date -->
                <label for="end_time_task" class="mt-3 mb-2">End Time</label>
                <input type="date" name="end_time_task" id="end_time_task" class="w-75 form-control"style="border-radius: 20px;border-color: rosybrown;" value="<?php echo htmlspecialchars($task['end_time_task']); ?>">

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-5 w-75"  style="background-color:rosybrown;border:none;">Update Task</button>
            </form>
        </section>
    </main>
</body>
</html>

