wp.domReady( () => {
	
	// remove unecessary block options
	// see full list: https://www.billerickson.net/block-styles-in-gutenberg/#block-names
	// ------------------------------

	// buttons
	wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );

	// images
	wp.blocks.unregisterBlockStyle( 'core/image', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/image', 'rounded' );

	// separator
	wp.blocks.unregisterBlockStyle( 'core/separator', 'wide' );
	wp.blocks.unregisterBlockStyle( 'core/separator', 'dots' );
	wp.blocks.unregisterBlockStyle( 'core/separator', 'default' );

	// quote
	wp.blocks.unregisterBlockStyle( 'core/quote', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );

	// remove unecessary block types
	// ----------------------------
	wp.blocks.unregisterBlockType( 'core/pullquote' );
	wp.blocks.unregisterBlockType( 'core/verse' );
	wp.blocks.unregisterBlockType( 'core/search' );
	wp.blocks.unregisterBlockType( 'core/cover' );
	wp.blocks.unregisterBlockType( 'core/more' );
	wp.blocks.unregisterBlockType( 'core/gallery' );
	wp.blocks.unregisterBlockType( 'core/navigation' );
	wp.blocks.unregisterBlockType( 'core/nextpage' );
	wp.blocks.unregisterBlockType( 'core/tag-cloud' );
	wp.blocks.unregisterBlockType( 'core/social-links' );
	wp.blocks.unregisterBlockType( 'core/calendar' );
	wp.blocks.unregisterBlockType( 'core/latest-comments' );

} );
