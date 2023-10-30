console.log('customConfirmModal.js loaded');
( function( $ ) {
	'use strict';

	function DisclaimerAlert() {
		$( 'a[href^="mailto:"]' ).confirm( {
			title: 'Email Disclaimer',
			content: 'If you are not already a client of Tucker Arensberg Attorneys, we cannot represent you until we confirm that doing so would not create a conflict of interest and is otherwise consistent with the policies of our firm. Accordingly, please do not include any confidential information until we verify that the firm is in a position to represent you and our engagement is confirmed in a letter. Prior to that time, there is no assurance that information you send us will be maintained as confidential. Thank you. ',
			buttons: {
				confirm: {
					text: 'Accept',
					btnClass: 'btn-primary',
					keys: [ 'enter' ],
					action() {
						const url = this.$target.attr( 'href' );
						window.open( url, '_blank' );
					},
				},
				cancel: {
					text: 'Decline',
				},
			},
		} );
	}

	DisclaimerAlert();
} )( jQuery );