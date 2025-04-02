<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Girly Plan / LOGIN</title>
    <link rel="icon" href="../view/icon.png" type="image/png">
    <!-- CSS -->
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <!-- login with an active account -->
    <div class="container">
        <!-- Login Form -->
        <div class="form-box login">
            <form action="/workshop/public/index.php?action=login" method="POST">
                <h1>Connexion</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" style="margin-right:5px;">
                    <label for="remember" class="form-check-label">Se souvenir de moi</label>
                </div>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" style="color: red; margin-top: 10px;">
                        <?php 
                        $error = $_GET['error'];
                        if ($error === '1') {
                            echo "Identifiants incorrects";
                        } else {
                            echo htmlspecialchars($error);
                        }
                        ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success" style="color: green; margin-top: 10px;">
                        <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn">Se connecter</button>
            </form>
        </div>

        <!-- Register Form -->
        <div class="form-box register">
            <form action="/workshop/public/index.php?action=register" method="POST">
                <h1>Enregistrement</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="mail" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">S'enregistrer</button>
            </form>
        </div>

        <!-- Toggle Panel -->
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back</h1>
                <p>Vous n'avez pas de compte ?</p>
                <button class="btn register-btn">S'enregistrer</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Bonjour, Bienvenue !</h1>
                <p>Vous avez déjà un compte ?</p>
                <button class="btn login-btn">Se connecter</button>
            </div>
        </div>
    </div>

    <script>
        const container = document.querySelector('.container');
        const registerBtn = document.querySelector('.register-btn');
        const loginBtn = document.querySelector('.login-btn');

        registerBtn.addEventListener('click', () => {
            container.classList.add('active');
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove('active');
        });
    </script>
</body>
</html>
