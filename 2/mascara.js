function number_format( number, decimals, dec_point, thousands_sep ) {
	// http://kevin.vanzonneveld.net
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://crestidg.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)    
    // *     example 1: number_format(1234.5678, 2, '.', '');
    // *     returns 1: 1234.57     
 
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
function str_replace(search, replace, subject) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Gabriel Paderni
    // +   improved by: Philip Peterson
    // +   improved by: Simon Willison (http://simonwillison.net)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    // *     returns 1: 'Kevin.van.Zonneveld'
    // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    // *     returns 2: 'hello, mars'    
 
    var __regexp_escape = function(text) {
        if (!arguments.callee.sRE) {
            var specials = [
                '/', '.', '*', '+', '?', '|',
                '(', ')', '[', ']', '{', '}', '\\'
            ];
            arguments.callee.sRE = new RegExp(
                '(\\' + specials.join('|\\') + ')', 'g'
            );
        }
      return text.replace(arguments.callee.sRE, '\\$1');
    };
 
    var numreplx, numon, fincods, k;
   
    if(!(replace instanceof Array)){
        replace = new Array(replace);
        if(search instanceof Array){
            // If search is an array and replace is a string, 
            // then this replacement string is used for every value of search
            while(search.length>replace.length){
                replace[replace.length]=replace[0];
            }
        }
    }
 
    if(!(search instanceof Array)){
        // put search string in an array anyway
        search = new Array( search );
    }
    while( search.length > replace.length ){ 
        // If replace has fewer values than search, 
        // then an empty string is used for the rest of replacement values
        replace[replace.length] = '';
    }
 
    if(subject instanceof Array){
        // If subject is an array, then the search and replace is performed 
        // with every entry of subject , and the return value is an array as well.
        for(k in subject){
            subject[k] = str_replace(search, replace, subject[k]);
        }
        return subject;
    }
      
    // Each entry was originally replaced one after another, rather than all at once. 
    // This created a problem: str_replace(["{name}","l"], ["hello","m"], "{name}, lars")
    // Theoretically, the code should return "hello, mars", but instead it returned "hemmo, mars"
    // as pointed out and fixed by Philip Peterson:
    numreplx = search.length;
    numon = 0;
    fincods = new Array();
    while( fincods.length < numreplx ){
        nsub = subject;
        for( x = 0; x < fincods.length; x++ ){
            nsub = nsub.replace(new RegExp(__regexp_escape(search[x]), "g"), "[cod"+fincods[x]+"]");
        }
        for( x = 0; x < fincods.length; x++ ){
            nsub = nsub.replace(new RegExp(__regexp_escape("[cod"+fincods[x]+"]"), "g"), replace[x]);
        }

        if( nsub.indexOf("[cod"+numon+"]") == -1 ){
            fincods[fincods.length]=numon;
        }
        numon++;
    }
    for( x = 0; x < fincods.length; x++ ){
        subject=subject.replace(new RegExp(__regexp_escape(search[x]), "g"), "[cod"+fincods[x]+"]");
    }
    for( x = 0; x < fincods.length; x++ ){
        subject=subject.replace(new RegExp(__regexp_escape("[cod"+fincods[x]+"]"), "g"), replace[x]);
    }
    return subject;
}

function mascara(d,tipo){
	var sep, pat, nums;
	switch(tipo)
	{
		case 'cod_siace':
			sep = '-';
			pat = new Array(4,6);
			nums = true;
			break;
		case 'rif':
			sep = '-';
			pat = new Array(1,10);
			nums = false;
			break;
	}
	
if(d.valant != d.value){
	val = d.value
	largo = val.length
	val = val.split(sep)
	val2 = ''
	for(r=0;r<val.length;r++){
		val2 += val[r]	
	}
	if(nums){
		for(z=0;z<val2.length;z++){
			if(isNaN(val2.charAt(z))){
				letra = new RegExp(val2.charAt(z),"g")
				d.value = "";
				val2 = val2.replace(letra,"")
			}
		}
	}
	val = ''
	val3 = new Array()
	for(s=0; s<pat.length; s++){
		val3[s] = val2.substring(0,pat[s])
		val2 = val2.substr(pat[s])
	}
	for(q=0;q<val3.length; q++){
		if(q ==0){
			val = val3[q]
		}
		else{
			if(val3[q] != ""){
				val += sep + val3[q]
				}
		}
	}
	d.value = val
	d.valant = val
	}
}