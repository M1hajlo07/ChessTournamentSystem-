<link rel="stylesheet" href="/chess_app/Players/players.css">


<?php include '../view/header.php'; ?>
<div style="background: url(../images/back_events.jpg) no-repeat center center; background-size: cover; min-height: 100vh;">
<main class="players-main">
  <section class="players-list">
    <h2>10 latest upcomming Events</h2>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Location</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($events)): ?>
          <?php foreach ($events as $event): ?>
            <tr>
              <td><?php echo htmlspecialchars($event['event_date']); ?></td>
              <td><?php echo htmlspecialchars($event['location_event']); ?></td>
              <td><?php echo htmlspecialchars($event['type_event']); ?></td>
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
