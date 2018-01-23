# MPV AWARDS
## Los Premios Marcos Puertas y Ventavas - v. 2017

Sistema de votación por categorías para premios de la empresa [LaTres](http://www.latres.com/).

---

## Tecnologías Empleadas

* HTML
* CSS
* JavaScript
* PHP
* MySQL

## Librerías & Frameworks

* Bootstrap (SCSS) 3.3.7
* Font Awesome 4.7.0
* Axios 0.17.0
* Jquery & Jquery UI para el Admin

## Archivos para producción

```
.
├─  index.html
├─  _style.css
├─  _script-min.js
│
├── admin
│   └── *
│
├── img
│   └── *
│   
└── api
    └── *
```

## Estructura BBDD

En el archivo **mpvawards.sql**

### Tabla admin
Tabla de logueo para el módulo *admin*.

Campo | Tipo | Default | Descripción
--- | --- | --- | ---
aid | int |  | \*
aname | varchar(16) |  | Usuario de acceso al módulo admin
apass | varchar(16) |  | Contraseña de acceso al módulo admin
astatus | int | 1 | Estatus y nivel de acceso al módulo admin

Precargada con los siguientes datos:

```json
"user": "admin"
"password": "123456"
```

### Tabla binnacle
Tabla donde se guardarán los votos.

Campo | Tipo | Default | Descripción
--- | --- | --- | ---
bid | int |  | \*
buser | int |  | \*\* `table: users` Contiene el ID del usuario que emitió el voto
bcategory | int |  | \*\* `table: categories` Contiene el ID de la categoría en que se votó
bvote | int |  | \*\* `table: users` Contiene el ID del usuario por quien se votó
bdate | timestamp | CURRENT_TIMESTAMP | Fecha y hora de emición del voto

### Tabla categories
Tabla de las categorías a votar en la contienda.

Campo | Tipo | Default | Descripción
--- | --- | --- | ---
cid | int |  | \*
clabel | varchar(255) | | Nombre de la categoría
cdesc | text |  | Descripción de la categoría
corder | int |  | Orden en donde aparecerá la categoría
csex | int | 3 | \*\* `table: sex` Contiene el ID del sexo a votar (3 en caso de indiferente)
cdepartment | int | 0 | \*\* `table: department` Contiene el ID del departamento a votar (0 en caso de todos)
cstatus | int | 1 | Estatus 1 activo 0 inactivo

### Tabla department
Tabla de los departamentos y/o empresas a participar.

Campo | Tipo | Default | Descripción
--- | --- | --- | ---
did | int |  | \*
dlabel | varchar(32) |  | Nombre de la empresa y/o departamento

### Tabla sex
Tabla de los sexos.

Campo | Tipo | Default | Descripción
--- | --- | --- | ---
sid | int |  | \*
slabel | varchar(50) |  | Nombre del sexo

### Tabla users
Tabla de los usuarios a participar tanto como votantes como contendientes.

Campo | Tipo | Default | Descripción
--- | --- | --- | ---
uid | int |  | \*
uname | varchar(50) | | Usuario de acceso
upass | varchar(50) | | Contraseña de acceso
ufb | varchar(100) | | ID de usuario de Facebook para uso de foto por medio del GraphAPI
usex | int |  | \*\* `table: sex` Contiene el ID del sexo a votar (3 en caso de indiferente)
udepartment | int |  | \*\* `table: department` Contiene el ID del departamento a votar (0 en caso de todos)
ustatus | int | 1 | Estatus 1 activo 0 inactivo

\* *Llaves primarias de autoincremento*  
\*\* *Llave foranea*

** Existe otra tabla llamada METAS pero es prevista para uso de variables globales, no se ha implementado su uso **

## Setup para conexiones a BBDD

Archivos:

* admin/-globals.php
* api/index.php

## Uso del API

Exista una carpeta llamada api, que es una EMULACIÓN de API, no una API pura. El cliente se conecta a el para 3 cosas:
* Solicitud de usuarios para logueo
* Autenticar sesión de usuario
* Generar voto y solicitar categorías

Los parámetros varían dependiendo:

SHOW (authenticate - users - vote)

### Solicitud de usuarios para logueo

`/api/?show=users`

La solicitud de usuarios para logueo devuelve todos los registros de user activos en este formato:

```json
[
	{
		"id":"42",
		"name":"Usuaria Prueba"
	},
	{
		"id":"7",
		"name":"Usuario Prueba"
	},
	...
]
```

### Autenticar sesión de usuario

`/api/?show=authenticate&user={ID_USUARIO}&password={CONTRASEÑA}`

```json
{
	"me": {
		"id": "33",
		"name": "HAROLD SOTO",
		"fb": "728916083",
		"sex": "1",
		"department": "1"
	},
	"users": [
		{
			"id": "42",
			"name": "Usuaria Prueba",
			"fb": "100000000000000",
			"sex": "2"
		},
		{
			"id": "7",
			"name": "Usuario Prueba",
			"fb": "100000000000001",
			"sex": "1"
		},
		...
	],
	"categories": [
		{
			"id": "1",
			"label": "El más responsable",
			"descript": "",
			"sex": "1",
			"department": "0",
			"vote": "0"
		},
		{
			"id": "2",
			"label": "La más responsable",
			"descript": "",
			"sex": "2",
			"department": "0",
			"vote": "0"
		},
		{
			"id": "3",
			"label": "El más pellizquito",
			"descript": "",
			"sex": "0",
			"department": "0",
			"vote": "0"
		},
		...
	]
}
```

### Generar voto y solicitar categorías

`/api/?show=vote&category={ID_CATEGORIA}&vote={ID_USUARIO_VOTO}&user={ID_USUARIO_VOTANTE}`

Devuelve un json similar al **Autenticar sesión de usuario** con el campo __vote__ lleno por la persona por quién votó
