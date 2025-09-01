<?php include __DIR__ . '/../../view/header.php'; ?>
<link rel="stylesheet" href="/chess_app/styles.css">
<link rel="stylesheet" href="/chess_app/player/player.css">

<main class="dashboard">
  <h1>Player Dashboard</h1>

  <section class="info">
    <p><strong>Username:</strong> <?= htmlspecialchars($playerData['UserName']) ?></p>
    <p><strong>Matches Played:</strong> <?= $playerData['number_of_matches'] ?></p>
    <p><strong>Rating:</strong> <?= $playerData['rating'] ?></p>
  </section>

  <section class="apply-form">
    <h2>Apply for an Event</h2>
    
    <?php
    if ($applicationSuccess === true) {
        echo "<p class='success'>Your application was submitted successfully!</p>";
    } elseif ($applicationSuccess === false) {
        echo "<p class='error'>Please complete all fields to apply.</p>";
    }
    ?>
    
    <form method="post">
      <label for="event_id">Select Event</label>
      <select name="event_id" id="event_id" required>
        <option value="">-- Choose an Event --</option>
        <?php foreach ($eventList as $event): ?>
          <option value="<?= $event['event_id'] ?>">
            <?= htmlspecialchars($event['type_event'] . ' - ' . $event['location_event'] . ' on ' . date('M d, Y', strtotime($event['event_date']))) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="number_app">Application Number</label>
      <input type="text" name="number_app" id="number_app" placeholder="Your application number" required>
      
      <button type="submit" class="btn">Apply</button>
    </form>
  </section>

  <section class="actions">
    <a href="/chess_app/user/view/logout.php" class="btn logout">Logout</a>
  </section>
</main>

<?php include __DIR__ . '/../../view/footer.php'; ?>
