function formato_campo(fld,e,t) {

    var aux = aux2 = '';
    var i = j = 0;
    //alert('opc: '+'1');
    switch(t)
    {
        case 1:
            var strCheck = '0123456789';
            //alert('opc: '+'1');
            break;
        case 2:
            var strCheck = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz ';
            //alert('opc: '+'2');
            break;
        case 3:
            var strCheck = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789 ';
            //alert('opc: '+'3');
            break;
        case 4:
            var strCheck = '0123456789-ext';
            //alert('opc: '+'4');
            break;
        case 5:
            var strCheck = '0123456789,.';
            //alert('opc: '+'5');
            break;
        case 6:
            var strCheck = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz0123456789';
            //alert('opc: '+'6');
            break;
        case 7:
            var strCheck = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú0123456789 ,.?¿!¡()-_/';
            //alert('opc: '+'7');
            break;
        case 8:
            var strCheck = 'ABCDEFGHIJKLMN�OPQRSTUVWXYZ0123456789';
            //alert('opc: '+'8');
            break;
        case 9:
            var strCheck = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú ';
            //alert('opc: '+'9');
            break;
        case 10:
            var strCheck = 'abcdefghijklmnopqrstuvwxyz0123456789';
            //alert('opc: '+'10');
            break;
        case 11:
            var strCheck = '0123456789-';
            //alert('opc: '+'11');
            break;
        case 12:
            var strCheck = '0123456789-VJGPEvjgpe';
            //alert('opc: '+'12');
            break;
        case 13:
            var strCheck = '0123456789.';
            //alert('opc: '+'13');
            break;
        case 14:
            var strCheck = 'abcdefghijklmnopqrstuvwxyz0123456789 _-@.';
    //alert('opc: '+'14');
    }
		
    var evento = e || window.event;
    var whichCode =  e.charCode || e.keyCode;
    //alert(whichCode);
    if (whichCode == 13) return true; 					// Enter
    if (whichCode == 8) return true; 					// Enter
    //if (whichCode == 46) return true;					
    if (whichCode == 0) return true; 					// Tab
    if (whichCode == 9) return true; 					// Tab
    if (whichCode == 37) return true;  //cursor
    if (whichCode == 38) return true;
    if (whichCode == 39) return true;
    if (whichCode == 40) return true;
		
    key = String.fromCharCode(whichCode); 				// Consigue el valor del codigo de tecla...
    //alert('key='+key);
    if (strCheck.indexOf(key) == -1) return false; 		// no es una tecla valida
    fld.value += aux2.charAt(i);
}