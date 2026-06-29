# PROJECT ROADMAP


# Estado actual


ACTIVE_PHASE:

FASE 1


---

# FASE 1 - FOUNDATION SAAS


STATUS:

IN_PROGRESS


Objetivo:

Convertir template actual en SaaS.


Checklist:


## Company


[✓] migration companies
[✓] model Company
[✓] CRUD Company
[✓] relaciones (Company hasMany User / User belongsTo Company)


## Multiempresa


[✓] users.company_id (migration + fillable + seeder con 3 empresas x 10 usuarios)
[✓] aislamiento por empresa (UserTable filtra por company_id / UserService asigna company_id al crear)
[✓] validaciones (guardCompany en edit/update/destroy: bloquea acceso a usuarios de otra empresa)


## Seguridad


[✓] permisos empresa
[✓] policies



Completion:

Completion: 100% (9 de 9 tareas)



---

# FASE 2 - CLIENTES Y SERVICIOS


STATUS:

PENDING



Crear:


customers

services



Checklist:


[ ] Customer model

[ ] Customer CRUD

[ ] Service model

[ ] Service CRUD

[ ] permisos



---

# FASE 3 - WORKFLOW


STATUS:

PENDING



Crear:


workflows

workflow_steps

workflow_transitions



Checklist:


[ ] crear workflow

[ ] crear estados

[ ] validar transiciones



---

# FASE 4 - ORDENES


STATUS:

PENDING



Crear:


service_orders

order_status_history



Checklist:


[ ] crear orden

[ ] asignar cliente

[ ] asignar servicio

[ ] cambiar estados

[ ] registrar historial



---

# MVP COMPLETADO


Cuando FASE 4 termine:


El sistema permite:


Crear empresa

Crear clientes

Crear servicios

Configurar procesos

Crear órdenes

Controlar estados



---

# FASES POST MVP


FASE 5:

Activos


FASE 6:

Inventario


FASE 7:

Reportes


FASE 8:

Facturación


---

# Regla


No avanzar fase sin confirmación humana.
