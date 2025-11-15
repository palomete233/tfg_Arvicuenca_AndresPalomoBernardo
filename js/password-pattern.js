(function(){
    'use strict';

    // Contrato: input password -> output string compacta y legible
    // L=letras minúsculas, U=mayúsculas, D=dígitos, S=símbolos

    function analyzePassword(pw){
        if(!pw) return '';
        let counts = {lower:0, upper:0, digit:0, symbol:0};
        for(let i=0;i<pw.length;i++){
            let ch = pw.charAt(i);
            if(/[a-z]/.test(ch)) counts.lower++;
            else if(/[A-Z]/.test(ch)) counts.upper++;
            else if(/[0-9]/.test(ch)) counts.digit++;
            else counts.symbol++;
        }
        let parts = [];
        if(counts.lower) parts.push('L'+counts.lower);
        if(counts.upper) parts.push('U'+counts.upper);
        if(counts.digit) parts.push('D'+counts.digit);
        if(counts.symbol) parts.push('S'+counts.symbol);
        return parts.join(' ');
    }

    function describePassword(pw){
        if(!pw) return '';
        let len = pw.length;
        let strength = 'Débil';
        if(len>=12 && /[A-Z]/.test(pw) && /[0-9]/.test(pw) && /[^A-Za-z0-9]/.test(pw)) strength = 'Muy fuerte';
        else if(len>=8 && ((/[A-Z]/.test(pw) && /[0-9]/.test(pw)) || (/[0-9]/.test(pw) && /[^A-Za-z0-9]/.test(pw)) )) strength = 'Fuerte';
        else if(len>=6) strength = 'Media';
        return 'Longitud: '+len+' — Fuerza: '+strength;
    }

    function attach(){
        let pwdInput = document.getElementById('password');
        let out = document.getElementById('password-pattern');
        let err = document.getElementById('password-error');
        let form = document.getElementById('registro-form');
        if(pwdInput && out){
            function update(){
                let v = pwdInput.value || '';
                let pattern = analyzePassword(v);
                let desc = describePassword(v);
                if(!v) out.textContent = '';
                else out.textContent = pattern + '  |  ' + desc;
                // Mostrar aviso si es débil
                if(err){
                    let ok = passwordIsStrongEnough(v);
                    err.textContent = ok ? '' : 'La contraseña debe tener al menos 8 caracteres y mezclar al menos 3 tipos: minúsculas, mayúsculas, dígitos y símbolos.';
                }
            }
            pwdInput.addEventListener('input', update);
            pwdInput.addEventListener('blur', update);
            // Inicializar si el campo viene con valor
            update();
        }
        // Interceptar submit del formulario para impedir registro si la contraseña no es segura
        if(form && pwdInput){
            form.addEventListener('submit', function(e){
                let v = pwdInput.value || '';
                if(!passwordIsStrongEnough(v)){
                    e.preventDefault();
                    if(err) err.textContent = 'No se puede registrar: la contraseña no cumple los requisitos mínimos de seguridad.';
                    pwdInput.focus();
                    return false;
                }
                return true;
            });
        }
    }

    // Comprueba que la contraseña tenga al menos 8 caracteres y al menos 3 de las 4 clases
    function passwordIsStrongEnough(pw){
        if(!pw) return false;
        if(pw.length < 8) return false;
        let classes = 0;
        if(/[a-z]/.test(pw)) classes++;
        if(/[A-Z]/.test(pw)) classes++;
        if(/[0-9]/.test(pw)) classes++;
        if(/[^A-Za-z0-9]/.test(pw)) classes++;
        return classes >= 3;
    }

    // Ejecutar cuando el DOM esté listo
    if(document.readyState === 'loading'){
        document.addEventListener('DOMContentLoaded', attach);
    } else {
        attach();
    }

})();
