(function() {
    tinymce.create('tinymce.plugins.downloads', {
        init : function(editor, url) {
            editor.addButton('downloads', {
                title : 'Downloads',
                icon: 'icon dashicons-external',
                tooltip: 'Insert Download',
                onclick : function() {

                    // go get the download posts...
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        dataType: 'json',
                        data: { action : 'get_downloads' },
                        success: function(response) {
                            get_user_options_from_editor_window(response, editor);
                        },
                    });

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Downloads",
                author : 'Chris Eardley',
                authorurl : 'https://lesniakswann.com',
                infourl : '',
                version : "1.0",
            };
        }
    });
    tinymce.PluginManager.add('downloads', tinymce.plugins.downloads);

    function get_user_options_from_editor_window(response, editor) {
        editor.windowManager.open({
            title: 'Insert Download',
            body: [
                {
                    type: 'textbox',
                    name: 'title',
                    label: 'Link Text'
                },
                {
                    type: 'listbox',
                    name: 'download',
                    label: 'Download',
                    values: response,
                },

            ],
            onsubmit: function(e) {
                insert_shortcode_with_user_options(e, editor);
            }
        });
    }

    function insert_shortcode_with_user_options(e, editor) {
        if (e.data.title != null && e.data.title != '') {

            if (e.data.download != null && e.data.download != '') {
                editor.execCommand('mceInsertContent', false, '[ls-downloads file="' + e.data.download + '"]' + e.data.title + '[/ls-downloads]');
            }

        }
    }
})();
