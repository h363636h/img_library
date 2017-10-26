if(jQuery) (function($){

	$.extend($.fn, {
		fileTree: function(options, file, directory) {
			// Default options
			if( options.root			=== undefined ) options.root			= '/';
			if( options.script			=== undefined ) options.script			= '/files/filetree';
			if( options.folderEvent		=== undefined ) options.folderEvent		= 'click';
			if( options.expandSpeed		=== undefined ) options.expandSpeed		= 500;
			if( options.collapseSpeed	=== undefined ) options.collapseSpeed	= 500;
			if( options.expandEasing	=== undefined ) options.expandEasing	= null;
			if( options.collapseEasing	=== undefined ) options.collapseEasing	= null;
			if( options.multiFolder		=== undefined ) options.multiFolder		= true;
			if( options.loadMessage		=== undefined ) options.loadMessage		= 'Loading...';

			$(this).each( function() {

				function showTree(element, dir) {
					$(element).addClass('wait');
					$(".jqueryFileTree.start").remove();
					$.post(options.script, { dir: dir }, function(data) {
						$(element).find('.start').html('');
						$(element).removeClass('wait').append(data);
						$(element).find('UL').attr('data-folder', dir);
						if( options.root == dir ) $(element).find('UL:hidden').show(); else $(element).find('UL:hidden').slideDown({ duration: options.expandSpeed, easing: options.expandEasing });
						bindTree(element);
					});
				}

				function bindTree(element) {
					$(element).find('LI A').on(options.folderEvent, function() {
						if( $(this).parent().hasClass('directory') ) {
							if( $(this).parent().hasClass('collapsed') ) {
								// Expand
								if( !options.multiFolder ) {
									$(this).parent().parent().find('UL').slideUp({ duration: options.collapseSpeed, easing: options.collapseEasing });
									$(this).parent().parent().find('LI.directory').removeClass('expanded').addClass('collapsed');
								}
								$(this).parent().find('UL').remove(); // cleanup
								showTree( $(this).parent(), escape($(this).attr('rel')) );
								$(this).parent().removeClass('collapsed').addClass('expanded');
								folderSelected($(this), true);

							} else {
								// Collapse
								$(this).parent().find('UL').slideUp({ duration: options.collapseSpeed, easing: options.collapseEasing });
								$(this).parent().removeClass('expanded').addClass('collapsed');
								folderSelected($(this), false);
							}
                            file($(this).attr('rel'));

						} else {
						}
						return false;
					});


                    $(element).find('LI A').on(options.dblEvent, function() {
                        if( $(this).parent().hasClass('directory') ) {
                            if( $(this).parent().hasClass('collapsed') ) {
                                // Expand
                                if( !options.multiFolder ) {
                                    $(this).parent().parent().find('UL').slideUp({ duration: options.collapseSpeed, easing: options.collapseEasing });
                                    $(this).parent().parent().find('LI.directory').removeClass('expanded').addClass('collapsed');
                                    // file($(this).attr('rel'));
                                }
                                $(this).parent().find('UL').remove(); // cleanup
                                showTree( $(this).parent(), escape($(this).attr('rel')) );
                                $(this).parent().removeClass('collapsed').addClass('expanded');
                                folderSelected($(this), true);

                            } else {
                                // Collapse
                                $(this).parent().find('UL').slideUp({ duration: options.collapseSpeed, easing: options.collapseEasing });
                                $(this).parent().removeClass('expanded').addClass('collapsed');
                                folderSelected($(this), false);
                            }
                            file($(this).attr('rel'));

                        } else {
                        }
                        return false;
                    });

					// Prevent A from triggering the # on non-click events
					if( options.folderEvent.toLowerCase != 'click' ) $(element).find('LI A').on('click', function() { return false; });
				}

				/**
				 * fire the directory click event if assigned
				 * @param object $obj: jquery element (folder link)
				 * @param boolean folderOpened: indicates event: folder subtree was closed or opened by user
				 */
				function folderSelected($obj, folderOpened){	
					if(typeof(directory) !== 'function' ){
						return;
					}
					if(folderOpened){
						var activeDirectory = $obj.attr('rel');
					}else{
						var $parent = $obj.parent().parent();
						var activeDirectory = $parent.parent().find('UL').attr('data-folder');//parent
						console.log(activeDirectory);
					}

					directory(activeDirectory, folderOpened);
				}
				
				// Loading message
				$(this).html('<ul class="jqueryFileTree start"><li class="wait">' + options.loadMessage + '<li></ul>');
				// Get the initial file list
				showTree( $(this), escape(options.root) );
			});
		}
	});

})(jQuery);
