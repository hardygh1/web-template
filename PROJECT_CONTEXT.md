# PROJECT CONTEXT
# Plataforma SaaS de Gestión de Órdenes de Servicio y Procesos Operativos


====================================================
1. INFORMACIÓN GENERAL DEL PROYECTO
====================================================


## Nombre

Plataforma SaaS de Gestión de Órdenes de Servicio y Procesos Operativos


## Objetivo

Construir una plataforma SaaS multiempresa orientada a negocios que trabajan mediante órdenes de servicio.


El sistema permite gestionar una operación completa:

Cliente solicita servicio

        ↓

Se crea una orden

        ↓

La orden pasa por un workflow configurable

        ↓

Se registran estados, responsables, tiempos y acciones

        ↓

La orden finaliza y puede generar entrega/cobro


---

## Concepto principal

El valor principal del producto es:


WORKFLOW CONFIGURABLE

+

ORDENES DE SERVICIO

+

TRAZABILIDAD

+

CONTROL DE TIEMPOS


No es un sistema CRUD simple.

Es un motor operativo configurable.


---

====================================================
2. ESTADO ACTUAL DEL PROYECTO
====================================================


El proyecto inició como un template Laravel para una aplicación clínica.


Fue refactorizado eliminando la lógica del negocio clínico.


Actualmente se conserva la infraestructura SaaS:


- Autenticación
- Usuarios
- Roles
- Permisos
- Seguridad
- Administración


---

## Funcionalidad existente


Actualmente existe:


### Autenticación

Laravel Jetstream


Incluye:


- Login
- Registro
- Logout
- Recuperación contraseña
- Sesiones
- Verificación email
- Perfil usuario
- Foto usuario
- Two Factor Authentication


---

### Seguridad


Laravel Fortify


Responsable de:


- Autenticación
- 2FA
- Password management


---

### API


Laravel Sanctum


Preparado para:


- Tokens
- APIs futuras
- Integraciones


---

### Roles y permisos


Spatie Laravel Permission


Implementado:


User tiene:


HasRoles


Ejemplo:


$user->hasRole('Administrador')


$user->can('CREAR_ORDEN')



---

====================================================
3. STACK TECNOLÓGICO
====================================================


## Backend


Laravel 11


PHP


Eloquent ORM



---

## Frontend


Blade

Livewire

Tailwind CSS

WireUI



---

## Base de datos


Compatible:


MySQL

PostgreSQL



---

## Infraestructura


Docker

Docker Compose



---

====================================================
4. ARQUITECTURA
====================================================


Tipo:


MONOLITO MODULAR


No utilizar microservicios.


El sistema debe mantenerse como una aplicación Laravel única.


---

## Objetivo arquitectura


Separar dominios dentro del mismo proyecto.


Ejemplo:


app/


Modules/


    IAM

    Company

    Customer

    Service

    Workflow

    Orders

    Asset

    Inventory

    Billing


---

Cada módulo debe contener:


Models

Services

Repositories

Livewire

Policies

Requests



---

====================================================
5. PATRÓN DE DESARROLLO
====================================================


El proyecto utiliza:


Controller

        ↓

Service

        ↓

Repository

        ↓

Model

        ↓

Database



---

## Reglas


Controllers:


Solo reciben requests.

No contienen lógica compleja.


---

Services:


Contienen lógica de negocio.


Ejemplo:


OrderService

WorkflowService

CompanyService



---

Repositories:


Responsables del acceso a datos.


Ejemplo:


OrderRepository

CustomerRepository



---

Livewire:


Debe manejar interacción UI.


No colocar lógica pesada.



---

====================================================
6. ESTRUCTURA ACTUAL
====================================================


app/


Models/


User.php



Http/Controllers/Admin/


DashboardController.php

UserController.php

RoleController.php



Services/


UserService.php

RoleService.php



Repositories/


UserRepository.php

RoleRepository.php

DashboardRepository.php



Livewire/Admin/


Datatables/


UserTable.php

RoleTable.php



---

====================================================
7. REGLAS IMPORTANTES
====================================================


NO modificar:


Laravel Jetstream

Laravel Fortify

Laravel Sanctum

Spatie Permission



---

NO crear:


Otro sistema de login

Otro sistema de permisos

Otra autenticación



---

====================================================
8. MODELO MULTIEMPRESA
====================================================


El sistema es SaaS.


Cada empresa debe tener aislamiento de datos.


Entidad:


COMPANY



Campos:


id

name

ruc

status



---

Toda entidad operativa debe tener:


company_id



Ejemplo:


customers

services

orders

products

assets



---

Regla:


Un usuario solo puede ver información de su empresa.



====================================================
9. MÓDULO IAM
====================================================


Responsable:


Usuarios

Roles

Permisos



Entidades:


users

roles

permissions

role_permissions



---

Roles iniciales:


ADMINISTRADOR

SUPERVISOR

OPERARIO

RECEPCIÓN



---

Permisos ejemplo:


CREATE_ORDER

EDIT_ORDER

CHANGE_STATUS

VIEW_REPORTS

MANAGE_USERS



---

====================================================
10. MÓDULO CLIENTES
====================================================


Gestiona clientes que solicitan servicios.


Entidad:


customers



Campos:


id

company_id

code

name

document

phone

email

address



---

Ejemplo:


Cliente:


Industria del Acero SAC



---

====================================================
11. MÓDULO SERVICIOS
====================================================


Catálogo de servicios.


Entidad:


services



Campos:


id

company_id

name

category

price



---

Ejemplos:


Mantenimiento

Reparación

Llenado

Inspección



---

====================================================
12. MÓDULO WORKFLOW ENGINE
====================================================


Este es el núcleo del sistema.


Permite definir procesos configurables.



---

Entidad:


workflows


Ejemplo:


"Llenado de balón"



---

Estados:


workflow_steps



Ejemplo:


PENDIENTE

EN PROCESO

TERMINADO

RECEPCIÓN

ENTREGADO



---

Transiciones:


workflow_transitions



Ejemplo:


Permitido:


PENDIENTE

   ↓

EN PROCESO



No permitido:


ENTREGADO

   ↓

PENDIENTE



---

Regla:


Nunca cambiar estado directamente.



Siempre:


Validar transición

Actualizar estado

Guardar historial



====================================================
13. MÓDULO ÓRDENES
====================================================


Módulo principal.


Entidad:


service_orders



Campos:


id

company_id

code

customer_id

service_id

workflow_id

current_step_id

priority

responsible_id

start_date

finish_date



---

Ejemplo:


OS-000001


Cliente:


Industria SAC


Servicio:


Mantenimiento


Estado:


EN PROCESO



---

====================================================
14. HISTORIAL Y TRAZABILIDAD
====================================================


Nunca guardar solamente estado actual.


Registrar cada cambio.


Entidad:


order_status_history



Campos:


id

order_id

from_status

to_status

user_id

start_time

end_time

comment



---

Permite calcular:


Tiempo total

Tiempo por etapa

Productividad

Retrasos



====================================================
15. ACTIVOS
====================================================


Representa objeto trabajado.


Ejemplos:


Balón

Vehículo

Máquina

Equipo



Entidad:


assets



Campos:


id

customer_id

type

code

name

brand

model

serial



---

Debe soportar atributos dinámicos.


Entidad:


asset_attributes



Ejemplo:


capacidad

presión

placa

kilometraje



====================================================
16. INVENTARIO
====================================================


Control de productos usados.


Entidad:


products



Campos:


id

company_id

code

name

stock

price



Relación:


order_products



Guarda:


Producto consumido por orden.



====================================================
17. FACTURACIÓN
====================================================


Futuro módulo.


Entidades:


payments

invoices



Una orden terminada puede generar:


Pago

Factura

Boleta

Nota



====================================================
18. LIVEWIRE
====================================================


Usar componentes pequeños.


Ejemplo:


Orders/


CreateOrder.php

OrderDetail.php

ChangeStatus.php

OrderTimeline.php



Dashboard/


OrderMetrics.php

PendingOrders.php



---

====================================================
19. UI
====================================================


Framework:


WireUI

Tailwind CSS



Usar:


- Tables
- Forms
- Modals
- Cards
- Badges
- Alerts



---

====================================================
20. MVP
====================================================


El MVP incluye:


FASE 1

Multiempresa


FASE 2

Clientes y Servicios


FASE 3

Workflow


FASE 4

Órdenes


Al finalizar:


Empresa

Usuarios

Clientes

Servicios

Workflow

Ordenes

Historial



---

====================================================
21. REGLAS PARA IA
====================================================


Antes de modificar código:


Leer:


PROJECT_CONTEXT.md

PROJECT_ROADMAP.md



---

La IA debe:


- respetar arquitectura
- reutilizar componentes existentes
- crear migraciones
- crear modelos
- crear servicios
- crear Livewire



---

La IA NO debe:


- crear microservicios
- rehacer autenticación
- crear permisos propios
- saltar fases
- implementar módulos futuros



---

# DEFINICIÓN FINAL


Este proyecto es:


Una plataforma SaaS construida con Laravel 11, Livewire y WireUI bajo arquitectura monolito modular, orientada a la gestión de órdenes de servicio mediante workflows configurables, trazabilidad y control operativo.