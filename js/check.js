navigator.mediaDevices.getUserMedia({
    audio: true,
    video: true,
}).then(stream => {
    // Display your local video in #localVideo element
    localVideo.srcObject = stream;
    // Add your stream to be sent to the conneting peer
    // pc.addStream(stream);
}, onError);