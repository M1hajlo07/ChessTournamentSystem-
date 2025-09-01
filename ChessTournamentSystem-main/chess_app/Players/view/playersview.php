<link rel="stylesheet" href="/chess_app/Players/players.css">


<?php include '../view/header.php'; ?>
<div style="background: url(../images/back_players.jpg) no-repeat center center; background-size: cover; min-height: 100vh;">
<main class="players-main">
  <section class="players-list">
    <h2>Top 20 Chess Players</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Surname</th>
          <th>Rating</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($players)): ?>
          <?php foreach ($players as $player): ?>
            <tr>
              <td><?php echo htmlspecialchars($player['FirstName']); ?></td>
              <td><?php echo htmlspecialchars($player['LastName']); ?></td>
              <td><?php echo htmlspecialchars($player['rating']); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="3">No players found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>
</main>
        </div>
<?php include '../view/footer.php'; ?>
