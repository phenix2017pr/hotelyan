if(!!CKFilter) {
    CKFilter.wolfSite = '<?php echo rtrim(URL_PUBLIC,'/'); ?>/';

    CKFilter.filterPath = CKFilter.wolfSite + 'wolf/plugins/ckeditor/';
    CKFilter.ckeditorPath = CKEDITOR_BASEPATH = CKFilter.filterPath + 'scripts/ckeditor/';
    CKFilter.wolfUserPath = CKFilter.filterPath + 'scripts/user/';
    CKFilter.wolfPluginsPath = CKFilter.filterPath + 'scripts/wolf_plugins/';

    CKFilter.wolfBaseRoute = "<?php echo rtrim(BASE_URL,'/'); ?>/wolf/plugins/ckeditor/";
    CKFilter.wolfPluginsRoute = CKFilter.wolfBaseRoute + 'plugins/';
    CKFilter.filemanagerRoute = CKFilter.wolfBaseRoute + 'filemanager/index.html';

    CKFilter.config = {
        language : "<?php echo $settings['lang']; ?>",
        contentsLanguage : "<?php echo $settings['lang']; ?>",
        contentsLangDirection : "<?php echo $settings['dir']; ?>",
<?php if($settings['filemanager_enabled']): ?>
        filebrowserRoot : "<?php echo $settings['filemanager_root']; ?>",
<?php if($settings['filemanager_upload_images_only'] == '0' ): ?>
        filebrowserBrowseUrl : CKFilter.filemanagerRoute,
<?php endif; ?>
        filebrowserImageBrowseUrl : CKFilter.filemanagerRoute + '?type=Images',
        filebrowserFlashBrowseUrl : CKFilter.filemanagerRoute + '?type=Flash',
<?php endif;?>
        baseHref : CKFilter.wolfSite
    };
}