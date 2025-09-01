<?php
require_once __DIR__ . '/../../core/session.php';
require_once __DIR__ . '/../../core/database.php';
require_once __DIR__ . '/../../core/email.php';

Session::start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getDB();

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $dob = trim($_POST['dob']);
    $role = $_POST['role'];

    $rating = $_POST['rating'] ?? null;
    $club = $_POST['club'] ?? null;
    $organisation = $_POST['organisation'] ?? null;

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    }

    if (empty($error)) {
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $pdo->prepare("SELECT ID FROM User WHERE UserName = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = "Username already exists";
            } else {
                $stmt = $pdo->prepare(
                    "INSERT INTO User (FirstName, LastName, UserName, Password, DataR) 
                     VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->execute([
                    $name, $surname, $username, $hashed, $dob
                ]);

                $user_id = $pdo->lastInsertId();

                switch ($role) {
                    case 'player':
                        $stmt = $pdo->prepare("INSERT INTO Player (player_id, number_of_matches, rating) VALUES (?, 0, ?)");
                        $stmt->execute([$user_id, $rating]);
                        break;
                    case 'mentor':
                        $stmt = $pdo->prepare("INSERT INTO Mentor (mentor_id, club) VALUES (?, ?)");
                        $stmt->execute([$user_id, $club]);
                        break;
                    case 'committee':
                        $stmt = $pdo->prepare("INSERT INTO Judge (judge_id, organization) VALUES (?, ?)");
                        $stmt->execute([$user_id, $organisation]);
                        break;
                    default:
                        $error = "Invalid role selected";
                        break;
                }

                if (empty($error)) {
                    $subject = "Welcome to the Chess Tournament";
                    $body = "
                        <h2>Welcome, {$username}!</h2>
                        <p>You have successfully registered as a <strong>{$role}</strong>.</p>
                        <p>You can now log in and participate.</p>
                    ";
                    send_mail($email, $subject, $body);

                    header("Location: login.php?registered=1");
                    exit;
                }
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}

?>

<link rel="stylesheet" href="../user.css">
<link rel="stylesheet" href="../../styles.css">

<main class="auth-main">
  <a href="../../index.php"><img src="../../images/logo.png" alt=""></a>
  <section class="auth-form">
    <h2>Register for Chess Tournament</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
  <label for="username">Username</label>
  <input type="text" name="username" id="username" required>

  <label for="email">Email</label>
  <input type="email" name="email" id="email" required>

  <label for="password">Password</label>
  <input type="password" name="password" id="password" required>

  <label for="confirm_password">Confirm Password</label>
  <input type="password" name="confirm_password" id="confirm_password" required>

  <label for="name">Name</label>
  <input type="text" name="name" id="name" required>

  <label for="surname">Surname</label>
  <input type="text" name="surname" id="surname" required>

  <label for="dob">Date of Birth</label>
  <input type="text" name="dob" id="dob" required placeholder="MM/DD/YYYY">

  <label for="role">Role</label>

  <select name="role" id="role" required>
    <option value="">-- Choose Role --</option>
    <option value="player">Player</option>
    <option value="mentor">Mentor</option>
    <option value="committee">Committee</option>
  </select>

  <!-- Player-specific -->
  <div id="player-fields" class="role-fields" style="display:none;">
    <label for="rating">Chess rating</label>
    <input type="text" name="rating" id="rating" placeholder="E.g. 1500" required>
  </div>

  <!-- Mentor-specific -->
  <div id="mentor-fields" class="role-fields" style="display:none;">
    <label for="club">Club</label>
    <input type="text" name="club" id="club" required>
  </div>

  <!-- Committee-specific -->
  <div id="committee-fields" class="role-fields" style="display:none;">
    <label for="organisation">Organisation</label>
    <input type="text" name="organisation" id="organisation" required>
  </div>

  <button type="submit">Register</button>
  <p>Already have an account? <a href="login.php">Login here</a></p>
</form>

  </section>
</main>

<script>
document.getElementById('role').addEventListener('change', function() {
  const role = this.value;

  document.querySelectorAll('.role-fields').forEach(function(div) {
    div.style.display = 'none';
    div.querySelectorAll('input').forEach(function(input) {
        input.required = false;
    });
  });

  if (role === 'player') {
    document.getElementById('player-fields').style.display = 'block';
    document.getElementById('rating').required = true;
  } else if (role === 'mentor') {
    document.getElementById('mentor-fields').style.display = 'block';
    document.getElementById('club').required = true;
  } else if (role === 'committee') {
    document.getElementById('committee-fields').style.display = 'block';
    document.getElementById('organisation').required = true;
  }
});

</script>


<?php include '../../view/footer.php'; ?>
