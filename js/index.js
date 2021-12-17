const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");

const expresiones = {
  boleta: /^\d{10}|[PP]+\d{8}|[PE]+\d{8}$/,
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  curp: /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
  calle: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
  cp: /^\d{5}$/,
  telefono: /^\d{10}$/, // 10 numeros.
  correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  promedio: /^[0-9]+([.][0-9]+)?$/, //promedio con 2 decimales
};

const campos = {
  boleta: false,
  nombre: false,
  apellidop: false,
  apellidom: false,
  curp: false,
  calleNumero: false,
  colonia: false,
  cp: false,
  telefono: false,
  mail: false,
  otro: false,
  campootro: false,
  promedio: false,
  fecha: false,
};

function calcularEdad(fecha_nacimiento) {
  var hoy = new Date();
  var cumpleanos = new Date(fecha_nacimiento);
  var edad = hoy.getFullYear() - cumpleanos.getFullYear();
  var m = hoy.getMonth() - cumpleanos.getMonth();
  if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
    edad--;
  }
  return edad;
}

const validarFormulario = (e) => {
  //Validacion de otro en cecyts
  if (document.getElementById("chkYes").checked) {
    campos.otro = true;
  }
  if (campos.otro) {
    switch (e.target.id) {
      case "escuelaProcedencia":
        if (expresiones.nombre.test(e.target.value)) {
          campos.campootro = true;
        } else {
          campos.campootro = false;
        }
        break;
    }
  }

  //validacion de los demas campos
  switch (e.target.id) {
    case "boleta":
      if (expresiones.boleta.test(e.target.value)) {
        campos.boleta = true;
      } else {
        campos.boleta = false;
      }
      break;
    case "nombre":
      if (expresiones.nombre.test(e.target.value)) {
        campos.nombre = true;
      } else {
        campos.nombre = false;
      }
      break;
    case "apellidop":
      if (expresiones.nombre.test(e.target.value)) {
        campos.apellidop = true;
      } else {
        campos.apellidop = false;
      }
      break;
    case "apellidom":
      if (expresiones.nombre.test(e.target.value)) {
        campos.apellidom = true;
      } else {
        campos.apellidom = false;
      }
      break;
    case "curp":
      if (expresiones.curp.test(e.target.value)) {
        campos.curp = true;
      } else {
        campos.curp = false;
      }
      break;
    case "calleNumero":
      if (expresiones.calle.test(e.target.value)) {
        campos.calleNumero = true;
      } else {
        campos.calleNumero = false;
      }
      break;
    case "colonia":
      if (expresiones.calle.test(e.target.value)) {
        campos.colonia = true;
      } else {
        campos.colonia = false;
      }
      break;
    case "cp":
      if (expresiones.cp.test(e.target.value)) {
        campos.cp = true;
      } else {
        campos.cp = false;
      }
      break;
    case "telefono":
      if (expresiones.telefono.test(e.target.value)) {
        campos.telefono = true;
      } else {
        campos.telefono = false;
      }
      break;
    case "mail":
      if (expresiones.correo.test(e.target.value)) {
        campos.mail = true;
      } else {
        campos.mail = false;
      }
      break;
    case "promedio":
      if (expresiones.promedio.test(e.target.value)) {
        campos.promedio = true;
      } else {
        campos.promedio = false;
      }
      break;
    case "fecha":
      var edad = calcularEdad(e.target.value);
      if (edad >= 9) {
        campos.fecha = true;
      } else {
        campos.fecha = false;
      }
      break;
  }
};

inputs.forEach((input) => {
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});

formulario.addEventListener("submit", (e) => {
  e.preventDefault();
  /*Impresiones para guiarse en las validaciones
    console.log("boleta"+campos.boleta);
    console.log("nombre"+campos.nombre);
    console.log("apellidop"+campos.apellidop);
    console.log("apellidom"+campos.apellidom);
    console.log("curp"+campos.curp);
    console.log("callenum"+campos.calleNumero);
    console.log("colonia"+campos.colonia);
    console.log("cp"+campos.cp);
    console.log("telefono"+campos.telefono);
    console.log("mail"+campos.mail);
    console.log("promedio"+campos.promedio);
    console.log("otro"+campos.otro);
    console.log("otrocampo"+campos.campootro);
    console.log("fecha"+campos.fecha);*/
  if (
    campos.boleta &&
    campos.nombre &&
    campos.apellidop &&
    campos.apellidom &&
    campos.curp &&
    campos.calleNumero &&
    campos.colonia &&
    campos.cp &&
    campos.telefono &&
    campos.mail &&
    campos.promedio
  ) {
    if (campos.fecha) {
      if (campos.otro) {
        if (campos.campootro) {
          alert("Datos guardados con exito");
        } else {
          alert("Favor de verificar la opción otro de escuela de procedencia");
        }
      } else {
        alert("Datos guardados con exito");
      }
    } else {
      alert("Favor de verificar la fecha de nacimiento");
    }
  } else {
    alert("Favor de verificar");
  }
  formulario.classList.add("was-validated");
});
