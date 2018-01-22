//@codekit-prepend "../bower_components/jquery/dist/jquery.js"

(function(window,undefined){
'use strict';
function allocInit(eAI) {
	$('#sortable').sortable();
	$('#sortable').disableSelection();
	$('#resort_btn').on('click',reSortCats);
}
function reSortCats(eRSC) {
	appendPreloader('Suave un toque...');
	let catOrder = new Array()
	$('#sortable li').each(function( index ) {
		catOrder.push((index+1)+','+$( this ).data('cid'));
	});
	$.ajax({
		url: "cts-reorder.php",
		method: "POST",
		cache: false,
		data: { nwo: catOrder.join('|') }
	}).done(function( ajax_msg ) {
		console.log(ajax_msg);
		removePreloader();
	});
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
document.addEventListener('DOMContentLoaded', allocInit);
})(window);