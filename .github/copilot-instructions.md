# GitHub Copilot Instructions

## Regla principal

Antes de realizar cualquier cambio:

1. Leer PROJECT_CONTEXT.md
2. Leer PROJECT_ROADMAP.md
3. Revisar estructura actual del código
4. Identificar fase activa
5. Trabajar únicamente esa fase


NO construir todo el sistema de una vez.


---

# Proyecto

Sistema:

Plataforma SaaS de Gestión de Órdenes de Servicio y Procesos Operativos.


Objetivo:

Crear un ERP ligero basado en:

- Ordenes de servicio
- Workflow configurable
- Estados
- Trazabilidad
- Control de tiempos


---

# Stack


Backend:

Laravel 11

PHP


Frontend:

Livewire

Blade

Tailwind CSS

WireUI


Seguridad:

Laravel Jetstream

Fortify

Sanctum


Permisos:

Spatie Laravel Permission



---

# Arquitectura


Tipo:

Monolito Modular


No crear microservicios.


Mantener:


Controller

↓

Service

↓

Repository

↓

Model



---

# Reglas


NO colocar lógica en:


Controllers

Blade

Livewire Components


La lógica debe estar en:


Services

Actions

Repositories



---

# Sistema existente


Mantener:


- Jetstream
- Fortify
- Sanctum
- Spatie Permission


No reemplazar autenticación.


No crear otro sistema de roles.



---

# Base SaaS


Toda entidad operativa debe tener:


company_id



Ejemplo:


customers

services

orders

products



---

# Workflow


Las órdenes dependen de workflows.


Nunca modificar estado directamente.


Incorrecto:


$order->status='TERMINADO'


Correcto:


Validar transición

Registrar historial

Actualizar estado



---

# Desarrollo por fases


PROJECT_ROADMAP.md controla el avance.


Copilot puede:


- Crear código de la fase activa
- Crear migraciones
- Crear modelos
- Crear servicios
- Crear componentes Livewire


Copilot NO debe:


- Avanzar fases
- Crear módulos futuros
- Marcar fases completadas sin revisión



---

# Finalización de fase


Cuando termine una fase:


Actualizar checklist


Pero NO cambiar la fase activa.


Solicitar confirmación del usuario.

