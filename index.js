const container = document.querySelector('.carousel-container');
        const images = document.querySelector('.carousel-images');
function moveLeft() {
    images.style.transform = 'translateX(-300px)';
    }

function moveRight() {
    images.style.transform = 'translateX(0)';
    }

function mostrarEnfermedad(enfermedadId) {
    var secciones = document.querySelectorAll(".enfermedad-section");
    secciones.forEach(function(seccion) {
        seccion.style.display = "none";
        });

var seccionActual = document.getElementById(enfermedadId);
    seccionActual.style.display = "block";
    }