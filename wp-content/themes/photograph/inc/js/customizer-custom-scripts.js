( function( api ) {

	// Extends our custom "photograph" section.
	api.sectionConstructor['photograph'] = api.Section.extend( {

		// No photographs for this type of section.
		attachPhotographs: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
