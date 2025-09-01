<?php include __DIR__ . '/../../view/header.php'; ?>
<link rel="stylesheet" href="/chess_app/styles.css">
<link rel="stylesheet" href="/chess_app/mentor/mentor.css">

<main class="dashboard">
  <h1>Mentor Dashboard</h1>

  <section class="info">
    <p><strong>Username:</strong> <?= htmlspecialchars($mentorData['UserName']) ?></p>
    <p><strong>Club:</strong> <?= htmlspecialchars($mentorData['club']) ?></p>
  </section>

  <section class="prep-form">
    <h2>Plan Training / Preparation</h2>
    
    <?php
    if ($prepSuccess === true) {
        echo "<p class='success'>Preparation created successfully!</p>";
    } elseif ($prepSuccess === false) {
        echo "<p class='error'>Please complete all fields to create preparation.</p>";
    }
    ?>
    
    <form method="post">
      <label for="event_id">Select Event</label>
      <select name="event_id" id="event_id" required>
        <option value="">-- Choose an Event --</option>
        <?php foreach ($eventsWithPlayers as $event): ?>
          <option value="<?= $event['event_id'] ?>">
            <?= htmlspecialchars($event['type_event'] . ' - ' . $event['location_event'] . ' on ' . date('M d, Y', strtotime($event['event_date']))) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="player_id">Select Player</label>
      <select name="player_id" id="player_id" required>
        <option value="">-- Choose a Player --</option>
        <?php foreach ($eventsWithPlayers as $event): ?>
          <option value="<?= $event['player_id'] ?>">
            <?= htmlspecialchars($event['player_name']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="preparation_id">Preparation Number</label>
      <input type="text" name="preparation_id" id="preparation_id" required>

      <label for="description">Type of Training</label>
      <input type="text" name="description" id="description" required>

      <button type="submit" class="btn">Create Preparation</button>
    </form>
  </section>

  <section class="actions">
    <a href="/chess_app/user/view/logout.php" class="btn logout">Logout</a>
  </section>
</main>

<?php include __DIR__ . '/../../view/footer.php'; ?>
