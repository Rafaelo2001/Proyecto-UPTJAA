const form = document.getElementById('form');
const inputs = document.querySelectorAll('#form input');

const expressions = {
    ci: /^\d{6,8}$/, // 6 a 8 numeros.
	user: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	sur_name: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{7,12}$/, // 7 a 12 dígitos.
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	tel: /^\d{11}$/, // 11 numeros.
    text: /^[a-zA-ZÀ-ÿ\s]{1,60}$/, // Letras y espacios, no pueden llevar acentos.
    number: /^\d{1,3}$/, // 1 a 3 numeros.
    decimal: /^[0-9]+(\.[0-9]+)?$/,
    fecha: /^(?:(?:(?:0?[1-9]|1\d|2[0-8])[/](?:0?[1-9]|1[0-2])|(?:29|30)[/](?:0?[13-9]|1[0-2])|31[/](?:0?[13578]|1[02]))[/](?:0{2,3}[1-9]|0{1,2}[1-9]\d|0?[1-9]\d{2}|[1-9]\d{3})|29[/]0?2[/](?:\d{1,2}(?:0[48]|[2468][048]|[13579][26])|(?:0?[48]|[13579][26]|[2468][048])00))$/
}

const campos = {
    top: false,
    material: false,
    stock: false,
    duration: false,
    //exp_date: false,
    //entry_date: false,
    //elab_date: false,
    supplier: false
}

const validForm = (e) => {
    switch (e.target.name) {
        case "top":  // cédula
            validarCampo(expressions.number, e.target, 'top');
        break;
        case "material": // nombre empleado
            validarCampo(expressions.text, e.target, 'material');
        break;
        case "stock":  // cédula
            validarCampo(expressions.number, e.target, 'stock');
        break;
        case "duration":  // cédula
            validarCampo(expressions.text, e.target, 'duration');
        break;
        /*case "exp_date":  // cédula
            validarCampo(expressions.fecha, e.target, 'exp_date');
        break;
        case "entry_date":  // cédula
            validarCampo(expressions.fecha, e.target, 'entry_date');
        break;
        case "date_elab":  // cédula
            validarCampo(expressions.fecha, e.target, 'elab_date');
        break;*/
        case "supplier":  // cédula
            validarCampo(expressions.text, e.target, 'supplier');
    }
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`group_${campo}`).classList.remove('form-group-error');
		document.getElementById(`group_${campo}`).classList.add('form-group-good');
		document.querySelector(`#group_${campo} i`).classList.add('fa-circle-check');
		document.querySelector(`#group_${campo} i`).classList.remove('fa-circle-xmark');
		document.querySelector(`#group_${campo} .form-input-error`).classList.remove('form-input-error-active');
        campos[campo] = true;
	} else {
		document.getElementById(`group_${campo}`).classList.add('form-group-error');
		document.getElementById(`group_${campo}`).classList.remove('form-group-good');
		document.querySelector(`#group_${campo} i`).classList.add('fa-circle-xmark');
		document.querySelector(`#group_${campo} i`).classList.remove('fa-circle-check');
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
		document.querySelector(`#group_confirmation_pass i`).classList.add('fa-circle-xmark');
		document.querySelector(`#group_confirmation_pass i`).classList.remove('fa-circle-check');
		document.querySelector(`#group_confirmation_pass .form-input-error`).classList.add('form-input-error-active');
        campos['password'] = false;
    } else {
        document.getElementById(`group_confirmation_pass`).classList.remove('form-group-error');
		document.getElementById(`group_confirmation_pass`).classList.add('form-group-good');
		document.querySelector(`#group_confirmation_pass i`).classList.remove('fa-circle-xmark');
		document.querySelector(`#group_confirmation_pass i`).classList.add('fa-circle-check');
		document.querySelector(`#group_confirmation_pass .form-input-error`).classList.remove('form-input-error-active');
        campos['password'] = true;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validForm);
    input.addEventListener('blur', validForm);
});

form.addEventListener('submit', (e) => {

    if (campos.top && campos.material && campos.stock && campos.duration && campos.exp_date && campos.entry_date && campos.date_elab && campos.supplier){
        form.reset();

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