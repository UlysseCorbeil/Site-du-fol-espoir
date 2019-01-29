/*
 * INITIALISATION DU TEXT EDITOR DES TEXTAREA
 */
var textarea = document.getElementById('sTexte');
   

$(textarea).jqte({
    // options
    'format'		: false,
    'fsize' 		: false,
    'color'			: false,
    'b' 			: true,
    'i' 			: false,
    'u' 			: true,
    'ol' 			: false,
    'ul' 			: false,
    'sub'			: false,
    'sup'			: false,
    'outdent'		: true,
    'indent'		: true,
    'left'			: true,
    'center'		: true,
    'right'			: true,
    'strike'		: false,
    'link'			: false,
    'unlink'		: false,
    'remove'		: false,
    'rule'			: false,
    'source'		: true,
    'placeholder'	: false,
    'br'			: true,
    'p'				: true,
});
