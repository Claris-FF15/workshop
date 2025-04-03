<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Girly Plan / Edit Profil</title>
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
                <a href="../public/index.php?action=profile" class="button_back me-2"><i class="bi bi-arrow-left"></i></a>
                <h1 class="mt-1 text-center">Modifier Profil</h1>
            </div>

            <form action="" method="POST" class="d-flex flex-column align-items-center justify-content-center w-100 mt-4">
                <!-- Champ caché pour ID de User -->
                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($user['id_user']); ?>">
                <!-- Username -->
                <label for="username" class="mt-3 mb-2">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username"class="w-75 form-control" style="border-radius: 20px;border-color: rosybrown;" value="<?= htmlspecialchars($user['username']) ?>" required>

                <!-- User Mail -->
                <label for="mail" class="mt-3 mb-2">Adresse Mail</label>
                <input type="text" name="mail" id="mail" class="w-75 form-control"style="border-radius: 20px;border-color: rosybrown;" value="<?php echo htmlspecialchars($user['mail']); ?>">
                
                <!-- User Password -->
                <label for="password" class="mt-3 mb-2 text-center">Nouveau mot de passe : <br> (Veuillez laisser vide pour ne pas changer)</label>
                <input type="password" id="password" name="password" class="w-75 form-control" style="border-radius: 20px;border-color: rosybrown;" placeholder="Nouveau mot de passe">

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-5 w-75" style="background-color:rosybrown;border:none;">Modifier</button>
            </form>
        </section>
    </main>
</body>
</html>
