                var lang = 'php';
                var showFullPath = 1;
                var showThumbs = 1;
                var relPath = "<?php echo rtrim(URL_PUBLIC,'/'); ?>";
                var autoload = true;
                /* settings */
                var culture = "<?php echo $settings['lang']; ?>";
                var fileRoot = "/<?php echo trim($settings['filemanager_base'],'/'); ?>/";
                var defaultViewMode = "<?php echo $settings['filemanager_view']; ?>";
                var browseOnly = <?php echo  $settings['filemanager_browse_only']; ?>;
                var imagesExt = [<?php echo "'".implode("','", unserialize($settings['filemanager_images']))."'"; ?>];
