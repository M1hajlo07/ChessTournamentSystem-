<?php 
  require_once __DIR__ . '../../core/session.php';
  require_once __DIR__ . '../../core/database.php';
  Session::start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chess Tournament</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="site-header">
    <div class="logo"><a href="/chess_app"><img src="/chess_app/images/logo.png" alt="">Chess Tournament</a></div>
    <nav>
      <ul>
        <li><a href="/chess_app/events/">Events</a></li>
        <li><a href="/chess_app/players/">Players</a></li>
        <li><a href="/chess_app/mentors/">Mentors</a></li>
        <?php if (Session::isLoggedIn()): ?>
          <li><a href="<?php switch(Session::get('role')) {
              case 'player': echo '/chess_app/player/index.php'; break;
              case 'mentor': echo '/chess_app/mentor/index.php'; break;
              case 'committee': echo '/chess_app/committee/index.php'; break;
              default: echo '/chess_app/index.php'; break;
            }
          ?>"><button>Dashboard</button></a></li>
           </li>
        <li><a href="/chess_app/user/view/logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="/chess_app/user/view/login.php">Login</a></li>
      <?php endif; ?>  
    </ul>
    </nav>
  </header>
