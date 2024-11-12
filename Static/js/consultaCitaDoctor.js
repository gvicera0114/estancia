function buscar_datos() {
  $.ajax({
    url: "consultarCitas.php",
    type: "POST",
    dataType: "html",
  }).done(function (respuesta) {
    $("#tablaCitas").html(respuesta);
  });
}

window.onload = function exampleFunction() {
  // función a ejecutar
  buscar_datos();
};

let pacienteModal = document.getElementById("modalPaciente");
let intervalo;

intervalo = setInterval(buscar_datos, 5000);

// Detener el intervalo cuando el modal se muestra
pacienteModal.addEventListener("shown.bs.modal", (event) => {
  clearInterval(intervalo);
  let button = event.relatedTarget;
  let id = button.getAttribute("data-bs-id");
  let inputSintomas = pacienteModal.querySelector(".modal-body #sintomas");
  let inputAlergias = pacienteModal.querySelector(".modal-body #alergias");
  let inputMedicamentos = pacienteModal.querySelector(
    ".modal-body #medicamentos"
  );
  let inputHereditaria = pacienteModal.querySelector(
    ".modal-body #hereditaria"
  );
  let inputDolor = pacienteModal.querySelector(".modal-body #dolor");

  let url = "getCuestionario.php";
  let formData = new FormData();
  formData.append("id", id);
  fetch(url, {
    method: "POST",
    body: formData,
  })
    .then((Response) => Response.json())
    .then((data) => {
      inputSintomas.value = data.Sintomas;
      inputAlergias.value = data.Alergias;
      inputMedicamentos.value = data.Medicamentos_Actuales;
      inputHereditaria.value = data.Historial_Medico;
      inputDolor.value = data.Lugar_Dolor;
    })
    .catch((err) => console.log(err));
});

// Reiniciar el intervalo cuando el modal se oculta
pacienteModal.addEventListener("hidden.bs.modal", () => {
  intervalo = setInterval(buscar_datos, 5000);
});
