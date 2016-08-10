<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<div id="content">
	<div class="page">
		<article role="article">
			<div class="post-context"><?php echo content($log_content); ?></div>
		</article>
	</div>
</div>
<?php include View::getView('footer-photo'); ?>