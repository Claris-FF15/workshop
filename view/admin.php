<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girly Plan / Gestion User</title>
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
    <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid black;
                    padding: 5px;
                    text-align: center;
                }
                th {
                    background-color:rosybrown;
                }
                .btn-danger {
                background-color: #ffb6c1 !important;
                border-color: #ffb6c1 !important;
                color: white;
                }
                .btn-danger:hover {
                background-color: #e57373 !important;
                border-color: #e57373 !important;
                }
                a{
                    color: purple;
                }
            </style>
</head>
<body>
    <main>
            <h3 class="d-flex justify-content-center mt-2 mb-4">Liste des utilisateurs</h3>
            <table>
                <tr >
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id_user']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['mail']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><a href="../public/index.php?action=changeRole&id=<?= $user['id_user'] ?>" >A/D</a> <a href="../public/index.php?action=delete_user&id=<?php echo $user['id_user']; ?>" class="btn btn-danger m-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le compte ?');">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <a href="../public/index.php?action=profile" class="btn btn-danger m-3">Retour Profil</a>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>  
</body>
</html>