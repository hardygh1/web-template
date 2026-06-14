# COPILOT WORKFLOW
# Flujo de trabajo con GitHub Copilot para desarrollo por fases


====================================================
OBJETIVO
====================================================

Este documento define cómo utilizar GitHub Copilot dentro del proyecto.

Copilot debe trabajar como un desarrollador guiado por fases.

No debe construir todo el sistema de una sola vez.


El flujo correcto es:


1. Preguntar estado
2. Analizar fase actual
3. Pedir plan técnico
4. Aprobar implementación
5. Implementar
6. Revisar checklist
7. Cerrar fase
8. Avanzar siguiente fase



====================================================
REGLAS GENERALES
====================================================


Antes de cualquier desarrollo Copilot debe leer:


- PROJECT_CONTEXT.md
- PROJECT_ROADMAP.md
- .github/copilot-instructions.md


La fuente de verdad del avance es:


PROJECT_ROADMAP.md



Copilot NO debe:


- Saltar fases
- Crear módulos futuros
- Cambiar arquitectura
- Marcar fases completas sin validación



====================================================
FASE 1
PREGUNTAR ESTADO ACTUAL
====================================================


Usar al iniciar una sesión.



PROMPT:


Analiza el estado actual del proyecto.


Lee:


PROJECT_CONTEXT.md

PROJECT_ROADMAP.md


Compara la documentación contra el código existente.


Genera un reporte:


- Fase actual
- Objetivo de la fase
- Porcentaje completado
- Tareas terminadas
- Tareas pendientes
- Archivos relacionados
- Riesgos técnicos


No generes código todavía.



====================================================
FASE 2
ANALIZAR LA FASE ACTIVA
====================================================


Objetivo:

Entender qué se debe construir antes de programar.



PROMPT:


Estamos trabajando únicamente la fase activa definida en PROJECT_ROADMAP.md.


Explícame:


- Qué problema resuelve esta fase
- Qué módulos intervienen
- Qué entidades se necesitan
- Qué tablas deben crearse
- Qué relaciones existen
- Qué permisos se necesitan
- Qué componentes Livewire serán necesarios


No escribas código todavía.



====================================================
FASE 3
SOLICITAR PLAN DE IMPLEMENTACIÓN
====================================================


Antes de crear archivos.


PROMPT:


Genera un plan técnico para implementar la fase actual.


Incluye:


Base de datos:

- Migraciones
- Tablas
- Relaciones


Backend:

- Modelos
- Services
- Repositories
- Controllers


Frontend:

- Livewire Components
- Views
- Formularios


Seguridad:

- Roles
- Permissions
- Policies


Testing:

- Casos a validar


Respeta:

- Laravel 11
- Service Repository Pattern
- Livewire
- WireUI


Espera mi aprobación antes de escribir código.



====================================================
FASE 4
APROBAR IMPLEMENTACIÓN
====================================================


Cuando el plan esté correcto.


PROMPT:


El plan fue aprobado.


Implementa únicamente esta fase.


Reglas:


- No crear funcionalidades futuras
- No modificar módulos no relacionados
- Mantener arquitectura existente
- Crear código limpio


Antes de modificar archivos importantes indica qué cambiarás.



====================================================
FASE 5
IMPLEMENTAR UNA TAREA ESPECÍFICA
====================================================


Ejemplo:


Crear módulo Company.



PROMPT:


Implementa únicamente la tarea:


[NOMBRE DE TAREA]


Requisitos:


Laravel 11

Service Repository Pattern

Livewire

WireUI

Spatie Permission


Crear:


- Migration
- Model
- Repository
- Service
- Validaciones
- Livewire
- Permisos necesarios


No avances a otras tareas.



====================================================
FASE 6
REVISIÓN DE IMPLEMENTACIÓN
====================================================


Después de terminar código.


PROMPT:


Revisa la implementación realizada.


Valida:


Arquitectura

Migraciones

Modelos

Relaciones

Servicios

Repositorios

Permisos

Seguridad

Livewire


Indica:


- Correcto
- Errores
- Mejoras necesarias


No avances de fase.



====================================================
FASE 7
ACTUALIZAR CHECKLIST
====================================================


PROMPT:


Revisa PROJECT_ROADMAP.md.


Compara las tareas contra el código actual.


Actualiza únicamente el checklist.


Formato:


[✓] Completado

[ ] Pendiente


Explica qué quedó pendiente.


No cambies la fase activa.



====================================================
FASE 8
VALIDAR CIERRE DE FASE
====================================================


PROMPT:


Valida si la fase actual está completamente terminada.


Revisa:


- Código
- Base de datos
- Relaciones
- Permisos
- UI
- Validaciones


Genera reporte:


FASE:

ESTADO:

COMPLETADO:

PENDIENTE:

RECOMENDACIÓN:



No cambies de fase.



====================================================
FASE 9
PASAR A SIGUIENTE FASE
====================================================


Solo después de validación humana.



PROMPT:


La fase actual fue aprobada.


Actualiza PROJECT_ROADMAP.md.


Cambiar:


ACTIVE_PHASE


a la siguiente fase.


Mantén historial de la fase anterior.



====================================================
EJEMPLO DE CICLO COMPLETO
====================================================


Ejemplo:


Día 1:


"Analiza estado actual"


↓

Copilot responde


↓

"Analiza fase activa"


↓

"Genera plan"


↓

Usuario aprueba


↓

"Implementa Company"


↓

"Revisa implementación"


↓

"Actualiza checklist"



Cuando:


FASE 1 = 100%


recién:


Pasar a FASE 2



====================================================
OBJETIVO FINAL
====================================================


Trabajar Copilot como:


Arquitecto

+

Desarrollador

+

Revisor


No como generador automático de código.


El control del proyecto siempre pertenece al desarrollador.