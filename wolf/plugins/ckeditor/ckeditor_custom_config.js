    CKEDITOR.editorConfig = function( config )
    {

        // config.toolbar = 'BasicFront';
        config.toolbar_BasicFront =
        [

	    	[ 'Source' ],
	        [ 'Bold','Italic','Underline' ],
	        [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ],
	        [ 'Div','NumberedList','BulletedList' ],
	        [ 'FontSize' ]

        ];
        config.startupOutlineBlocks = 0;
        config.height = '150px';
    	config.width = '430px';

    };