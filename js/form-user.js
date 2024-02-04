const form = document.getElementById('form');
const inputs = document.querySelectorAll('#form input');

const expressions = {
    ci: /^\d{6,8}$/, // 6 a 8 numeros.
	user: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	sur_name: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&._-])[A-Za-z\d@$!%*?&._-]{8,16}$/, // al menos una M, una m, un digito, un caracter @$!%*?&._- y una longitud de 8 a 16 caracteres.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	cod_area: /^\d{4}$/, // 4 numeros.
	// tel: /^\d{7}$/, // 7 numeros.
    text: /^[a-zA-ZÀ-ÿ0-9\s]{1,400}$/, // Letras y espacios, no pueden llevar acentos.
    number: /^\d{1,10}$/, // 1 a 10 numeros.
    decimal: /^[0-9]+(\.[0-9]+)?$/,
    fecha: /^(?:(?:(?:0?[1-9]|1\d|2[0-8])[/](?:0?[1-9]|1[0-2])|(?:29|30)[/](?:0?[13-9]|1[0-2])|31[/](?:0?[13578]|1[02]))[/](?:0{2,3}[1-9]|0{1,2}[1-9]\d|0?[1-9]\d{2}|[1-9]\d{3})|29[/]0?2[/](?:\d{1,2}(?:0[48]|[2468][048]|[13579][26])|(?:0?[48]|[13579][26]|[2468][048])00))$/
}

const campos = {
    ci_empl: false,
    name_empl1: false,
    // name_empl2: false,
    // name_empl3: false,
    surname_empl1: false,
    // surname_empl2: false,
    //date_birth: false,
    sexo: false,
	cod_area: false,
    telf_empl: false,
    email_empl: false,
    state: false,
    city: false,
    municipality: false,
    parish: false,
    location: false,
    sector: false,
    street: false,
    house: false,
    username: false,
    password: false,
    confirmation_pass: false,
    respuesta1: false,
    respuesta2: false,
    respuesta3: false
}

const validForm = (e) => {
    switch (e.target.name) {
        case "ci_empl":  // cédula
            validarCampo(expressions.ci, e.target, 'ci_empl');
        break;
        case "name_empl1": // nombre empleado
            validarCampo(expressions.sur_name, e.target, 'name_empl1');
        break;
        case "name_empl2": // nombre empleado
            validarCampo(expressions.sur_name, e.target, 'name_empl2');
        break;
        case "name_empl3": // nombre empleado
            validarCampo(expressions.sur_name, e.target, 'name_empl3');
        break;
        case "surname_empl1": //apellido empleado
            validarCampo(expressions.sur_name, e.target, 'surname_empl1');
        break;
        case "surname_empl2": //apellido empleado
            validarCampo(expressions.sur_name, e.target, 'surname_empl2');
        break;
        case "email_empl": // correo empleado
            validarCampo(expressions.email, e.target, 'email_empl');
        break;
        //case "date_birth": //apellido empleado            validarCampo(expressions.fecha, e.target, 'date_birth');
        //break;
        case "cod_area": // teléfono empleado
            validarCampo(expressions.cod_area, e.target, 'cod_area');
        break;
        case "telf_empl": // teléfono empleado
            validarCampo(expressions.tel, e.target, 'telf_empl');
        break;
        case "state": // respuesta seguridad 1
            validarCampo(expressions.text, e.target, 'state');
        break;
        case "city": // respuesta seguridad 1
            validarCampo(expressions.text, e.target, 'city');
        break;
        case "municipality": // respuesta seguridad 1
            validarCampo(expressions.text, e.target, 'municipality');
        break;
        case "parish": // respuesta seguridad 1
            validarCampo(expressions.text, e.target, 'parish');
        break;
        case "location": // respuesta seguridad 1
            validarCampo(expressions.text, e.target, 'location');
        break;
        case "sector": // respuesta seguridad 1
            validarCampo(expressions.text, e.target, 'sector');
        break;
        case "street": // respuesta seguridad 1
            validarCampo(expressions.text, e.target, 'street');
        break;
        case "house": // respuesta seguridad 1
            validarCampo(expressions.number, e.target, 'house');
        break;
        case "username": // nombre usuario
            validarCampo(expressions.user, e.target, 'username');
        break;
        case "password": // contraseña
            validarCampo(expressions.password, e.target, 'password');
            validarPassword();
        break;
        case "confirmation_pass": // confirmación contraseña
            validarPassword();
        break;
        case "respuesta1": // respuesta seguridad 1
            validarCampo(expressions.text, e.target, 'respuesta1');
        break;
        case "respuesta2": // respuesta seguridad 2
            validarCampo(expressions.text, e.target, 'respuesta2');
        break;
        case "respuesta3": // respuesta seguridad 3
            validarCampo(expressions.text, e.target, 'respuesta3');
        break;
    }
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`group_${campo}`).classList.remove('form-group-error');
		document.getElementById(`group_${campo}`).classList.add('form-group-good');
		document.querySelector(`#group_${campo} i`).classList.add('fi-rr-check');
		document.querySelector(`#group_${campo} i`).classList.remove('fi-rr-cross');
		document.querySelector(`#group_${campo} .form-input-error`).classList.remove('form-input-error-active');
        campos[campo] = true;
	} else {
		document.getElementById(`group_${campo}`).classList.add('form-group-error');
		document.getElementById(`group_${campo}`).classList.remove('form-group-good');
		document.querySelector(`#group_${campo} i`).classList.add('fi-rr-cross');
		document.querySelector(`#group_${campo} i`).classList.remove('fi-rr-check');
		document.querySelector(`#group_${campo} .form-input-error`).classList.add('form-input-error-active');
        campos[campo] = false;
	}
}

const validarPassword = () => {
    const inputPassword1 = document.getElementById('password');
    const inputPassword2 = document.getElementById('confirmation_pass');

    if (inputPassword1.value !== inputPassword2.value){
        document.getElementById(`group_confirmation_pass`).classList.add('form-group-error');
		document.getElementById(`group_confirmation_pass`).classList.remove('form-group-good');
		document.querySelector(`#group_confirmation_pass i`).classList.add('fi-rr-cross');
		document.querySelector(`#group_confirmation_pass i`).classList.remove('fi-rr-check');
		document.querySelector(`#group_confirmation_pass .form-input-error`).classList.add('form-input-error-active');
        campos['password'] = false;
    } else {
        document.getElementById(`group_confirmation_pass`).classList.remove('form-group-error');
		document.getElementById(`group_confirmation_pass`).classList.add('form-group-good');
		document.querySelector(`#group_confirmation_pass i`).classList.remove('fi-rr-cross');
		document.querySelector(`#group_confirmation_pass i`).classList.add('fi-rr-check');
		document.querySelector(`#group_confirmation_pass .form-input-error`).classList.remove('form-input-error-active');
        campos['password'] = true;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validForm);
    input.addEventListener('blur', validForm);
});

form.addEventListener('submit', (e) => {

    if (!document.querySelector('input[name="sexo"]:checked')) {
        alert('Error, selecciona una opción de "Sexo"');
        hasError = true;
        } else if (!document.querySelector('input[name="tipe"]:checked')) {
            alert('Error, selecciona una opción de "Tipo de usuario"');
            hasError = true;
            } else if (campos.ci_empl && campos.name_empl1 /*&& campos.name_empl2 && campos.name_empl3*/ && campos.surname_empl1 /*&& campos.surname_empl2*/ && campos.date_birth && campos.cod_area && campos.telf_empl && campos.email_empl && campos.state && campos.city && campos.municipality && campos.parish && campos.location && campos.sector && campos.street && campos.house && campos.username && campos.password && campos.respuesta1 && campos.respuesta2 && campos.respuesta3){
                //form.reset();
        
                document.getElementById('form-mess-good').classList.add('form-mess-good-active');
                setTimeout(() => {
                    document.getElementById('form-mess-good').classList.remove('form-mess-good-active');
                }, 5000);
        
                document.querySelectorAll('.form-group-good').forEach((icono) => {
                    icono.classList.remove('form-group-good');
                });
            } else {
        document.getElementById('form-mess').classList.add('form-mess-active');
        setTimeout(() => {
            document.getElementById('form-mess').classList.remove('form-mess-active');
        }, 5000);
    }
});