var corCompleta = "#99ff8f";
var corIncompleta = "#eff70b";

function ResetCampos() {
    var textFields = document.getElementsByTagName("input");
    for (var i = 0; i < textFields.length; i++) {
        if (textFields[i].type == "text") {
            textFields[i].style.backgroundColor = "";
            textFields[i].style.borderColor = "";
        }
    }
}

function coresMask(t) {
    var l = t.value;
    var m = l.length;
    var x = t.maxLength;
    if (m == 0) {
        t.style.borderColor = "";
        t.style.backgroundColor = "";
    } else if (m < x) {
        t.style.borderColor = corIncompleta;
        t.style.backgroundColor = corIncompleta;
    } else {
        t.style.borderColor = corCompleta;
        t.style.backgroundColor = corCompleta;
    }
}

function mascara(m, t, e, c) {
    var cursor = t.selectionStart;
    var texto = t.value;
    texto = texto.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    var l = texto.length;
    var lm = m.length;
    
    // Verifica se é um evento de tecla pressionada
    var id;
    if (window.event) {
        id = e.keyCode; // Para navegadores antigos
    } else if (e.which) {
        id = e.which; // Para navegadores modernos
    }

    var cursorfixo = false;
    if (cursor < l) cursorfixo = true;

    var livre = false;
    // Teclas que não devem interferir na máscara
    if (id == 16 || id == 19 || (id >= 33 && id <= 40)) livre = true;

    var j = 0;
    if (!livre) {
        if (id != 8) { // Se não for a tecla BACKSPACE
            t.value = "";
            for (var i = 0; i < lm; i++) {
                if (m.substr(i, 1) == "#") { // Se o caractere for um "#", insere um número
                    t.value += texto.substr(j, 1);
                    j++;
                } else if (m.substr(i, 1) != "#") { // Se não for "#", mantém o caractere literal
                    t.value += m.substr(i, 1);
                }
                if (id != 8 && !cursorfixo) cursor++;
                if (j == l + 1) break;
            }
        }
        if (c) coresMask(t); // Aplica as cores ao campo
    }

    // Corrige o cursor
    if (cursorfixo && !livre) cursor--;
    t.setSelectionRange(cursor, cursor);
}