
<link rel="stylesheet" href="/chess_app/Players/players.css">


<?php include '../view/header.php'; ?>
<div style="background: url(../images/back_mentors.jpg) no-repeat center center; background-size: cover; min-height: 100vh; padding-bottom: 20px;">
<main class="players-main">
  <section class="players-list">
    <h2>Top 10 Chess mentors</h2>
    <h2>Coached players that won Finals or Semi-Finals</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Surname</th>
          <th>Number of players</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($mentors)): ?>
          <?php foreach ($mentors as $mentor): ?>
            <tr>
              <td><?php echo htmlspecialchars($mentor['FirstName']); ?></td>
              <td><?php echo htmlspecialchars($mentor['LastName']); ?></td>
              <td><?php echo htmlspecialchars($mentor['br_igraci']); ?></td>
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
