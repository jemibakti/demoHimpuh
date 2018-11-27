<!DOCTYPE html>
  <video autoplay></video>
  <button id="reset">Reset</button>
  <button id="stop" >Stop</button>

  <script src="<?php echo base_url('asset/dash/js/build/qcode-decoder.min.js')?>"></script>
  <script type="text/javascript">

  (function () {
    'use strict';

    var qr = new QCodeDecoder();

    if (!(qr.isCanvasSupported() && qr.hasGetUserMedia())) {
      alert('Your browser doesn\'t match the required specs.');
      throw new Error('Canvas and getUserMedia are required');
    }

    var video = document.querySelector('video');
    var reset = document.querySelector('#reset');
    var stop = document.querySelector('#stop');


    function resultHandler (err, result) {
      if (err)
        return console.log(err.message);
      // alert('hasil scan dari qr code adalah :'+result);
	  window.location = "<?php echo site_url('dashboard/input_data/'); ?>"+'/'+result;
	  
    }

    // prepare a canvas element that will receive
    // the image to decode, sets the callback for
    // the result and then prepares the
    // videoElement to send its source to the
    // decoder.

    qr.decodeFromCamera(video, resultHandler);


    // attach some event handlers to reset and
    // stop whenever we want.

    reset.onclick = function () {
      qr.decodeFromCamera(video, resultHandler);
    };

    stop.onclick = function () {
      qr.stop();
    };

  })();
  </script>
</body>
</html>
