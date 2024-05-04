document.addEventListener('DOMContentLoaded', function() {
    const audioElement = document.querySelector('audio[src="audios/musica_fondo.mp3"]');
    if (audioElement) {
        audioElement.volume = 0.1; // Ajustar el volumen al 50%
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const audioElement = document.querySelector('audio'); // El audio de fondo
    const videoElements = document.querySelectorAll('video'); // Todos los videos

    videoElements.forEach(currentVideo => {
        // Cuando un video se reproduce, pausamos el audio de fondo y otros videos
        currentVideo.addEventListener('play', () => {
            if (audioElement) {
                audioElement.pause(); // Pausa el audio de fondo
            }
            // Pausar otros videos excepto el actual
            videoElements.forEach(video => {
                if (video !== currentVideo) {
                    video.pause(); // Pausa otros videos
                }
            });
        });

        // Cuando un video se pausa o termina, verificamos si todos los videos están pausados
        currentVideo.addEventListener('pause', checkIfResumeAudio);
        currentVideo.addEventListener('ended', checkIfResumeAudio);
    });

    // Función para verificar si todos los videos están pausados
    function checkIfResumeAudio() {
        const allPaused = Array.from(videoElements).every(video => video.paused || video.ended);
        if (allPaused && audioElement) {
            audioElement.play(); // Reanudar el audio de fondo solo si todos los videos están pausados
        }
    }
});