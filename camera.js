function openCamera(canvasId, inputId) {
    const video = document.getElementById('webcam');
    const canvas = document.getElementById(canvasId);
    const input = document.getElementById(inputId);

    video.style.display = 'block';                      
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            const captureButton = document.createElement('button');
            captureButton.innerText = "Capture Image";
            captureButton.onclick = () => {
                captureImage(video, canvas, input);
                video.style.display = 'none';
                stream.getTracks().forEach(track => track.stop()); // Stop the webcam
                captureButton.remove(); // Remove the capture button
            };
            video.insertAdjacentElement('afterend', captureButton);
        })
        .catch(error => {
            console.error('Error accessing webcam: ', error);
            alert('Could not access the webcam. Please try again.');
        });
}

function captureImage(video, canvas, input) {
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    canvas.toBlob(blob => {
        const file = new File([blob], "webcam_image.png", { type: "image/png" });
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        input.files = dataTransfer.files;
    });
}