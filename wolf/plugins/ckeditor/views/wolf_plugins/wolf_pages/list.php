<?php if(isset($pages)): ?>
<?php $l = count($pages); ?>
CKFilter.wolfpages = {
  protocol: '<?php echo (USE_HTTPS) ? 'https://': 'http://'; ?>',
  items: [
    ['',''],
<?php for($i = 0; $i<$l; $i++): ?>
    ["<?php echo addslashes($pages[$i]['title']); ?>", '<?php echo $pages[$i]['url']; ?>']<?php if($i<$l-1) { echo ','; } ?>

<?php endfor; ?>
  ]
};
<?php endif; ?>
