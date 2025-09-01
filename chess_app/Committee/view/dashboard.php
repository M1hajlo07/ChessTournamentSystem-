<?php include __DIR__ . '/../../view/header.php'; ?>
<link rel="stylesheet" href="/chess_app/styles.css">
<link rel="stylesheet" href="/chess_app/committee/committee.css">

<main class="dashboard">
    <h1>Committee Dashboard</h1>

    <section class="info">
        <p><strong>Username:</strong> <?= htmlspecialchars($committeeData['UserName']) ?></p>
        <p><strong>Organisation:</strong> <?= htmlspecialchars($committeeData['organization']) ?></p>
    </section>

    <?php if ($validationSuccess === true): ?>
        <p class="success">Application validated successfully.</p>
    <?php elseif ($validationSuccess === false): ?>
        <p class="error">Could not validate application.</p>
    <?php endif; ?>

    <section class="application-list">
        <h2>Pending Applications</h2>
        <?php if (empty($applications)): ?>
            <p>No pending applications.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($applications as $app): ?>
                    <li class="application-item">
                        <strong>Application #<?= htmlspecialchars($app['number_app']) ?></strong><br>
                        <strong>User:</strong> <?= htmlspecialchars($app['UserName']) ?><br>
                        <strong>Event:</strong> <?= htmlspecialchars($app['type_event']) ?> at <?= htmlspecialchars($app['location_event']) ?> (<?= date('M d, Y', strtotime($app['event_date'])) ?>)<br>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="app_number" value="<?= htmlspecialchars($app['number_app']) ?>">
                            <button type="submit" name="validate" class="btn">Validate</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

    <section class="actions">
        <a href="/chess_app/user/view/logout.php" class="btn logout">Logout</a>
    </section>
</main>

<?php include __DIR__ . '/../../view/footer.php'; ?>
