jQuery( function() {
	jQuery('.jarallax').jarallax({
		videoVolume: 0,
		onInit: function () {
		var self = this;
		var video = self.video;
		if (video) {
			var $muteBtn = jQuery('<button class="jarallax-video-pause" title="Volume Button"><i class="fa fa-volume-off"></i></button>');
			video.on('ready', function() {
			jQuery(self.$item).append($muteBtn);
			});

			$muteBtn.on('click', function () {
			video.getMuted(function (muted) {
				if (muted) {
				video.unmute();
				$muteBtn.html('<i class="fa fa-volume-up"></i>');
				} else {
				video.mute();
				$muteBtn.html('<i class="fa fa-volume-off"></i>');
			  }
			});
			});
		}
		}
	});
} );