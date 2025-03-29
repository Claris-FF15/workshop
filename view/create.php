<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Girly Plan / Add Task</title>
    <link rel="icon" href="../view/icon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="../style/main.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <section>
            <!-- Header with back button -->
            <div class="d-flex flex-row align-items-center justify-content-center mt-3 gap-2">
                <a href="../public/index.php" class="button_back me-2" aria-label="Back to home page"><i class="bi bi-arrow-left"></i></a>
                <h1 class="mt-1 text-center">Add Task</h1>
            </div>
            <!-- Form to add new task -->
            <form action="index.php?action=create" method="post" class="d-flex flex-column align-items-center justify-content-center w-100 mt-4">
                <!-- Task Name -->
                <label for="task" id="task" class="mt-3 mb-2">Name</label>
                <input type="text" name="task" id="task" required class="form-control w-75" style="border-radius: 25px !important; border: solid 1px rosybrown !important;">

                <!-- Important Task Checkbox -->
                <div class="d-flex flex-row align-items-center justify-content-center mt-3">
                    <input type="checkbox" name="important_task" id="important_task" class="form-check-input flex-shrink-0 mt-1 mx-2">
                    <span>Important Task</span>
                </div>

                <!-- Repeat Task Checkbox -->
                <div class="d-flex flex-row align-items-center justify-content-center mt-3">
                    <input type="checkbox" name="repeat_task" id="repeat_task" class="form-check-input flex-shrink-0 mt-1 mx-2">
                    <span>Repeat Task</span>
                </div>

                <!-- Task Details -->
                <label for="details_task" id="details_task" class="mt-3 mb-2">Details</label>
                <textarea name="details_task" id="details_task" class="form-control w-75" ></textarea>

                <!-- End Time -->
                <label for="end_time_task" id="end_time_task" class="mt-3 mb-2">End Time</label>
                <input type="date" name="end_time_task" id="end_time_task" required class="w-75" style="border-radius: 25px !important; border: solid 1px rosybrown !important;">

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-5 w-75" style="background-color:rosybrown;border:none;">Add Task</button>
            </form>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

