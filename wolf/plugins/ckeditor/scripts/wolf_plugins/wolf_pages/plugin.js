(function()
{
    CKEDITOR.plugins.add( 'wolf_pages',
    {
        lang : ['en','es']
    });

    var wolfRoute = CKFilter.wolfPluginsRoute;
    // Load our array of pages
    CKEDITOR.scriptLoader.load( wolfRoute + 'wolf_pages.js' );

    function getUrlValue(url, absolute) {
        if(absolute) {
            return url;
        } else {
            return url.replace(wolf_baseHref,'');
        }
    }

    function getProtocol(absolute) {
        var protocol = '';
        if(absolute) {
            protocol = CKFilter.wolfpages.protocol || 'http://';
        }
        return protocol;
    }

    CKEDITOR.on( 'dialogDefinition', function( ev )
    {
    	var dialogName = ev.data.name,
    	dialogDefinition = ev.data.definition,
    	editor = ev.editor,
    	lang = editor.lang.wolf_pages;

        var absoluteURLs = editor.config.wolf_pagesAbsoluteURL;

    	var wolfpages_list = CKFilter.wolfpages.items || null;

    	if ( wolfpages_list !== null)
    	{ 
    	    if(dialogName == 'link' )
    	    {
                var infoTab = dialogDefinition.getContents('info');
                infoTab.add(
                {
                    type : 'select',
                    id : 'wolf_pages',
                    label : lang.title,
                    'default' : '',
                    style : 'width:100%',
                    items : wolfpages_list,

                    onChange : function()
                    {
                        var d = CKEDITOR.dialog.getCurrent();
                        d.setValueOf( 'info' , 'protocol', getProtocol(absoluteURLs) );
                        d.setValueOf( 'info' , 'url', getUrlValue(this.getValue(), absoluteURLs) );
                    },
      			    setup : function( data )
      			    {
      				    this.allowOnChange = false;
      				    this.setValue( data.url ? data.url.url : '' );
      				    this.allowOnChange = true;
      			    }
                },
                'browse');

                dialogDefinition.onLoad = function()
                {
                    var internField = this.getContentElement('info', 'wolf_pages' );
                    internField.reset();
                };
            }
    	}

    });
})();

// Add option to use relative or absolute urls
CKEDITOR.config.wolf_pagesAbsoluteURL = true;

// i18n
CKEDITOR.plugins.setLang('wolf_pages', 'en',
{
    wolf_pages: { title : 'Site Pages' }
});
CKEDITOR.plugins.setLang('wolf_pages', 'es',
{
    wolf_pages: { title : 'Páginas del Sitio' }
});