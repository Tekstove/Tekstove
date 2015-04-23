<?php require SITE_PATH_TEMPLATE . '__top.php'; ?>

<?php foreach ($groups as $group): ?>
    <div>
        <img src="<?php echo $group->getImage(); ?>" />
        <?php echo $group->getName(); ?>
        <ul>
            <?php foreach ($group->getUsers() as $user): ?>
                <li>
                    <a href="/profile.php?profile=<?php echo $user->getId(); ?>">
                        <?php echo htmlspecialcharsX($user->getUsername(false)); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>

<?php require SITE_PATH_TEMPLATE . "__bdqsno.php"; ?>