<?php
require_once __root_dir . "/private/src/get_posts.php";
$posts = get_posts();
?>
<div id="post_container">

	<?php foreach ($posts as $post): ?>
		<div class="post">
			<h2 .class="post_title"><?php htmlspecialchars($post['title']) ?></h2>
			<p .class="post_body"><?php htmlspecialchars($post['body']) ?></p>
		</div>
	<?php endforeach; ?>

</div>
