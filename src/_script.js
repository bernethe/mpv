var _data,_currCat;
(function(window, undefined) {
'use strict';
const init = (eAI) => {
	_currCat = 0;
	appendPreloader('Cargando Usuarios');
	//appendModal('Hola Mundo','Atención');
	let formData = new FormData();
	formData.append("show", "users");
	formData.append("cache", Date.now());
	axios.post('/api/', formData )
		.then( (response) => {
			_data = response.data;
			//console.log(_data);
			_data.map( (xuser) => document.querySelector('#user').appendChild( createCustomElement('option',{'value':xuser.id},[xuser.name]) ) );
			document.querySelector('#form_login').addEventListener('submit',doLogin,!1);
			removePreloader();
		})
		.catch( (error) => { appendModal(error,'ERROR'); });
}
const doLogin = (eDL) => {
	//authenticate
	eDL.preventDefault();
	if(document.querySelector('#password').value.length != 3) {
		appendModal('Para ingresar debe ingresar los últimos <strong>3 dígitos</strong> de la cédula.','ERROR');
	} else {
		appendPreloader('Autenticando Ingreso');
		let fd = new FormData(document.getElementById('form_login'));
		fd.append("cache", Date.now());
		axios.post('/api/', fd )
			.then( (response) => {
				_data = response.data;
				//console.log(_data);
				removePreloader();
				armarCategorias();
				document.querySelector('#nav_pos').appendChild(
					createCustomElement('div',{'class':'user_row'}, [
						createCustomElement('small',{},['Bienvenid@ ']),
						createCustomElement('strong',{},[_data.me.name]),
						' | ',
						createCustomElement('small',{},[ createCustomElement('a',{'href':'#','id':'logout_link'},['desconectar']) ])
						]
					)
				);
				document.getElementById('logout_link').addEventListener('click',(eLL) => { eLL.preventDefault(); location.reload(); }, !1);
			})
			.catch( (error) => { appendModal(error,'ERROR'); });
	}
}
const armarCategorias = () => {
	let catUL = createCustomElement('ul',{'class':'list-unstyled cat-selector'});
	_data.categories.map( (iCat, indexCat) => {
		let li_ele;
		if(iCat.vote == 0) {
			li_ele = createCustomElement('li',{'data-cid':iCat.id, 'data-ic': indexCat, 'class':'cat-enabled'}, [iCat.label]);
		} else {
			li_ele = createCustomElement('li',{'data-cid':iCat.id, 'data-ic': indexCat, 'class':'cat-disabled'},[iCat.label]);
		}
		li_ele.addEventListener('click',goCategory,!1);
		catUL.appendChild( li_ele );
	} );
	let dynaC = document.getElementById('dynamicContent');
	while (dynaC.firstChild) {
		dynaC.removeChild(dynaC.firstChild);
	}
	dynaC.appendChild( createCustomElement('div', {'class':'row'}, [
		createCustomElement('div', {'class':'col-sm-4 col-sm-offset-4 cat-container'}, [
			createCustomElement('h4',{},['Categorías']),
			createCustomElement('hr'),
			catUL
		])
	] ) );
}
const goCategory = (eGC) => {
	if( _data.categories[eGC.target.dataset.ic].vote == 0 ) {
		_currCat = eGC.target.dataset.ic;
		document.querySelector('.cat-container').classList.add('cat-container-hidder');
		setTimeout( buildCategory, 1000 );
	} else {
		let _sex = 'a';
		if( _data.me.sex == 1 ) { _sex = 'o'; }
		appendModal(`No juegue de loc${_sex}, usted ya votó en esta categoría.`,'YA VOTÓ');
	}
}
function buildCategory(e) {
	let dynaC = document.getElementById('dynamicContent');
	dynaC.removeChild(document.querySelector('#dynamicContent .row'));
	dynaC.appendChild(
		createCustomElement('div',{'class':'row text-center head-cat'},[ createCustomElement('div',{'class':'col-sm-12'},[
			createCustomElement('h2',{},[_data.categories[_currCat].label]),
			createCustomElement('p',{},[_data.categories[_currCat].descript]),
			createCustomElement('small',{'class':'nota-cat'},[ createCustomElement('strong',{},['OJO']), ': si usted no se encuentra en la lista, es porque no se puede votar por uno mismo, pero estese tranquilo, que los demás si pueden votar por usted.' ]),
			createCustomElement('div',{},[
				createCustomElement('a',{'href':'#','id':'go_to_cats'},['{ Regresar a las categorías }'])
			])
		])])
	);
	let eleContFaces = createCustomElement('div', {'class':'face-selector'});
	_data.users.map( (iU,iUi) => {
		//console.log(iU);
		if( (_data.categories[_currCat].sex == 0 && _data.categories[_currCat].department == 0) ||
			(_data.categories[_currCat].sex == iU.sex && _data.categories[_currCat].department == 0) ||
			(_data.categories[_currCat].sex == 0 && _data.categories[_currCat].department == iU.department) ||
			(_data.categories[_currCat].sex == iU.sex && _data.categories[_currCat].department == iU.department) ) {
			let temp_radio = createCustomElement('input',{'type':'radio','name':'gente','value':iU.id});
			temp_radio.addEventListener('change',()=>{ document.querySelector('.btn-latres').classList.remove('hidden'); },!1);
			eleContFaces.appendChild( createCustomElement('label', {}, [
				temp_radio,
				createCustomElement('div',{},[
					createCustomElement('img',{'src':`https://graph.facebook.com/${iU.fb}/picture?type=large`, 'alt':iU.name, 'class':'img-responsive'}),
					createCustomElement('span',{},[iU.name])
					])
				] )
			);
		} 
	} );
	dynaC.appendChild(eleContFaces);
	dynaC.appendChild(
		createCustomElement(
			'div',{'class':'row text-center submit-vote'}, [
				createCustomElement('button',{'id':'votar_btn','class':'btn btn-primary btn-latres btn-lg hidden','type':'button'},['VOTAR'])
			]
		)
	);
	document.getElementById('go_to_cats').addEventListener('click',destroyCategory,!1);
	document.getElementById('votar_btn').addEventListener('click', generateVote, !1);
}
const generateVote = (eGV) => {
	if(document.querySelector('input[type=radio]:checked')) {
		
		appendPreloader('Guardando Voto...');
		let formData = new FormData();
		formData.append('show', 'vote');
		formData.append('category', _data.categories[_currCat].id);
		formData.append('vote',document.querySelector('input[type=radio]:checked').value);
		formData.append('user',_data.me.id);
		formData.append('cache', Date.now());
		axios.post('/api/', formData )
			.then( (response) => {
				console.log(response);
				_data.categories = response.data;
				removePreloader();
				destroyCategory();
			})
			.catch( (error) => { appendModal(error,'ERROR'); });
	}
}
const destroyCategory = (eDC) => {
	if(eDC) { eDC.preventDefault(); }
	_currCat = 0;
	document.querySelector('.head-cat').classList.add('head-cat-go');
	document.querySelector('.face-selector').classList.add('face-selector-go');
	setTimeout( armarCategorias, 800 );
}
const appendPreloader = (pl_txt) => {
	let pldiv = createCustomElement('div',{},[
		createCustomElement('div',{'class':'spinner_mc'}),
		createCustomElement('div',{'class':'status_sp_txt'},[pl_txt])
	]);
	let overall = createCustomElement('div',{'class':'modal-pl'},[pldiv]);
	document.querySelector('.container').classList.add('modal-pl-body');
	document.body.appendChild(overall);
}
const removePreloader = (eRP) => {
	if(eRP) {
		eRP.preventDefault();
	}
	document.body.removeChild(document.querySelector('.modal-pl'));
	document.querySelector('.container').classList.remove('modal-pl-body');
}
const appendModal = (modalTxt, modalTittle, modalFooter) => {
	let modCont = new Array();
	if(modalTittle != undefined) {
		modCont.push( createCustomElement('div',{'class':'modal_header'},[ createCustomElement('h3',{},[modalTittle]) ]) );
	}
	modCont.push( createCustomElement('div',{'class':'modal_body'},[modalTxt]) );
	if(modalFooter != undefined) {
		modCont.push( createCustomElement('div',{'class':'modal_footer'},[modalFooter]) );
	}
	modCont.push( createCustomElement('a',{'href':'#','class':'modal_close'},['×']) );
	let mdl = createCustomElement('div',{'class':'modalAll'},modCont);
	let blk = createCustomElement('div',{'id':'modalDialog'},[mdl]);
	blk.addEventListener('click', e => {
		if(e.target === blk) {
			removeModal();
		}
	});
	document.body.appendChild(blk);
	document.querySelector('.modal_close').addEventListener('click',removeModal);
	document.querySelector('.container').classList.add('modal-pl-body');
}
const removeModal = (eRM) => {
	if(eRM) {
		eRM.preventDefault();
	}
	document.body.removeChild(document.getElementById('modalDialog'));
	document.querySelector('.container').classList.remove('modal-pl-body');
}
// https://github.com/escueladigital/EDui
// Crear elementos con atributos e hijo
const createCustomElement = (element,attributes,children) => {
	let customElement = document.createElement(element);
	if (children !== undefined) children.forEach(el => {
		if (el.nodeType) {
			if (el.nodeType === 1 || el.nodeType === 11) customElement.appendChild(el);
		} else {
			customElement.innerHTML += el;
		}
	});
	addAttributes(customElement,attributes);
	return customElement;
};

// Añadir un objeto de atributos a un elemento
const addAttributes = (element, attrObj) => {
	for (let attr in attrObj) {
		if (attrObj.hasOwnProperty(attr)) {
			element.setAttribute(attr,attrObj[attr]);
		}
	}
};
document.addEventListener('DOMContentLoaded', init, !1);
})(window);