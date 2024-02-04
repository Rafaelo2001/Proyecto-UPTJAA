const form = document.getElementById('form');
const inputs = document.querySelectorAll('#form input');

const expressions = {
	password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&._-])[A-Za-z\d@$!%*?&._-]{8,16}$/ // al menos una M, una m, un digito, un caracter @$!%*?&._- y una longitud de 8 a 16 caracteres.
}

const campos = {
    password: false,
    confirmation_pass: false
}

const validForm = (e) => {
    switch (e.target.name) {
        case "password": // contraseña
            validarCampo(expressions.password, e.target, 'password');
            validarPassword();
        break;
        case "confirmation_pass": // confirmación contraseña
            validarPassword();
        break;
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

    if (campos.password){
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

        event.preventDefault();
        alert('La contraseña no cumple con los requisitos.');
    }
});