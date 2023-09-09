'use strict'
const reproductor = {
    reproducir: function(cancion) {
        console.log("reproduciendo Cancion " + cancion);
    },
    pausa: function() {
        console.log("Pausando...")
    },
    crearPlaylist: function(play) {
        console.log(`Creando una Playlist ${play}`);
    },
    reproducirPlaylist: function(play) {
        console.log(`Reproducioendo la Playlist ${play}`);
    }
}
console.log(reproductor);
reproductor.reproducir("Hola");
reproductor.pausa();

reproductor.borrarCancion = function(cancion) {
    console.log(`Borrando la cancion ${cancion}`);
}
reproductor.borrarCancion(" Pvto ")
reproductor.crearPlaylist("Dia de las Madres");
reproductor.reproducirPlaylist("Dia de las Madres");