function CamposVacios(){
	var usuario = document.getElementById('usuario').value;
	var pass = document.getElementById('contra').value;
	
	if( usuario == null || usuario.length == 0 || /^\s+$/.test(usuario) || usuario == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(pass == null || pass.length == 0 || /^\s+$/.test(pass) || pass == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}
