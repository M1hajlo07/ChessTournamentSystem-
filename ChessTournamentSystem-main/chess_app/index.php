<?php 
    require_once __DIR__ . '/core/connection.php';
    require_once __DIR__ . '/core/database.php';
    require_once __DIR__ . '/core/errorcontrol.php';
?>

<?php include 'view/header.php'; ?>

<main>
  <section class="hero">
    <div class="hero-overlay">
      <h1>Welcome to the Grand Chess Tournament</h1>
      <p>Track every move, every checkmate, every champion.</p>
    </div>
  </section>

  <section class="stats-links">
    <div class="stat-card">
      <h2>Top Players</h2>
      <p>See who dominates the board</p>
      <a href="/chess_app/players/">View Rankings</a>
    </div>
    <div class="stat-card">
      <h2>Top Mentors</h2>
      <p>Explore most succesfull mentors</p>
      <a href="/chess_app/mentors/">View Rankings</a>
    </div>
    <div class="stat-card">
      <h2>Upcoming Events</h2>
      <p>Don’t miss the next showdown</p>
      <a href="/chess_app/events/">See Schedule</a>
    </div>
  </section>
</main>

<?php include 'view/footer.php'; ?>
