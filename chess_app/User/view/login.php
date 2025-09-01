<?php
require_once __DIR__ . '../../../core/session.php';
require_once __DIR__ . '../../../core/database.php';
Session::start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getDB();
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM User WHERE UserName = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        $user_id = $user['ID'];

        $role = null;

        $stmt = $pdo->prepare("SELECT player_id FROM Player WHERE player_id = ?");
        $stmt->execute([$user_id]);
        if ($stmt->fetch()) {
            $role = 'player';
        }

        if (!$role) {
            $stmt = $pdo->prepare("SELECT mentor_id FROM Mentor WHERE mentor_id = ?");
            $stmt->execute([$user_id]);
            if ($stmt->fetch()) {
                $role = 'mentor';
            }
        }

        if (!$role) {
            $stmt = $pdo->prepare("SELECT judge_id FROM Judge WHERE judge_id = ?");
            $stmt->execute([$user_id]);
            if ($stmt->fetch()) {
                $role = 'committee';
            }
        }

        if ($role) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $user['UserName'];
            $_SESSION['role'] = $role;

            switch ($role) {
                case 'player':
                    header("Location: ../../player/index.php");
                    break;
                case 'mentor':
                    header("Location: ../../mentor/index.php");
                    break;
                case 'committee':
                    header("Location: ../../committee/index.php");
                    break;
            }
            exit;
        } else {
            $error = "User role not assigned. Please contact admin.";
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<link rel="stylesheet" href="../../styles.css">
<link rel="stylesheet" href="../user.css">

<main class="auth-main">
  <a href="../../index.php"><img src="../../images/logo.png" alt=""></a>
  <section class="auth-form">
    <h2>Login to Chess Tournament</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
      <label for="username">Username</label>
      <input type="username" name="username" id="username" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Login</button>
      <p>Don’t have an account? <a href="register.php">Register here</a></p>
    </form>
  </section>
</main>
<?php include '../../view/footer.php'; ?>s
