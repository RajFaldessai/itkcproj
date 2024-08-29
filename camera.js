function useWebcam(inputId) {
    const video = document.createElement('video');
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');
    const imageElement = document.getElementById(inputId.replace('Picture', 'Image'));

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            video.play();
            document.body.appendChild(video);

            const captureImage = () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Stop the video stream
                stream.getTracks().forEach(track => track.stop());
                document.body.removeChild(video);

                // Generate a unique file name
                const uniqueFileName = `webcam_image_${Date.now()}.png`;

                // Convert canvas to image
                imageElement.src = canvas.toDataURL('image/png');
                imageElement.alt = uniqueFileName;

                // Create a Blob and update the input element with the image file
                canvas.toBlob(blob => {
                    const file = new File([blob], uniqueFileName, { type: 'image/png' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    document.getElementById(inputId).files = dataTransfer.files;
                });
            };

            // Capture the image after a short delay to allow the video to start
            setTimeout(captureImage, 1000);
        })
        .catch(err => {
            console.error('Error accessing webcam: ' + err);
        });
}
