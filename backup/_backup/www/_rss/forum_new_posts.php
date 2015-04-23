<?php
require '../__top.php';

$pdo = PDOX::singleton();

$stm = $pdo->prepare('
	SELECT
		*,
		`forum_topic`.`id` as `topicId`,
		`forum_razdel`.`name` as `forumCategoryName`
	FROM
		`forum_posts`
	INNER JOIN `forum_topic` ON `za_topic_id` = `forum_topic`.`id`
	INNER JOIN `users` ON `poster` = `users`.`id`
	INNER JOIN
        `forum_razdel`
            ON
                `forum_topic`.`topic_razdel` = `forum_razdel`.`id`
                AND forum_razdel.hidden = 0
	ORDER BY
        `forum_posts`.`id` DESC
	LIMIT
        20
	');

$stm->execute();
?>
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
	<channel>
        <title>Нови мнения във форума, текстове.инфо</title>
        <description>Нови мнения във форума, текстове.инфо</description>
        <link>http://tekstove.info/</link>
        <ttl>1800</ttl>
		<?php foreach ($stm->fetchAll() as $p) : ?>
			<item>
				<title><?php echo htmlspecialcharsX($p['forumCategoryName'] . ' - ' .$p['topic_name']); ?></title>
				<link>http://tekstove.info/forum_topic_vij.php?id=<?php echo $p['topicId'];?></link>
                                <lastBuildDate><?php echo date(DATE_RFC822, strtotime($p['date'])); ?></lastBuildDate>
			<description>
				<?php $description = 
					'от '
					. '<b>' . htmlspecialcharsX($p['username']) . '</b><br/>'
					. nl2br(htmlspecialchars($p['post']))
					;
				echo htmlspecialchars($description);
				?>
			</description>
		</item>

		<?php endforeach; ?>

	</channel>
</rss>