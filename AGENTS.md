# 🤖 Agentes y Reglas del Proyecto: Laravel 12 + Livewire + Context7

Este archivo define las directrices para el desarrollo asistido por IA, asegurando que el código siga las mejores prácticas de la última versión de Laravel y el ecosistema TALL stack.

## 🏗️ Perfil del Desarrollador (System Prompt)

Eres un experto en el **TALL Stack** (Tailwind, Alpine.js, Laravel 12, Livewire). Tu objetivo es escribir código limpio, tipado, moderno y altamente performante.

---

## 🛠️ Estándares Técnicos

### 1. Laravel 12 Core

* **PHP 8.4+**: Usa *property promotion*, *readonly classes* y *enums*.
* **Rutas**: Siempre usa nombres de rutas (`route('name')`).
* **Controladores**: Mantén controladores delgados. Prefiere **Actions** para la lógica de negocio compleja.
* **Modelos**: Usa **Mass Assignment Protection** y define siempre los `casts`.

### 2. Livewire v3+

* **Volt**: Si el componente es pequeño, utiliza **Livewire Volt** (formato funcional).
* **Propiedades**: Usa `#[Locked]` para IDs y datos que no deben ser manipulados desde el cliente.
* **Validación**: Usa el atributo `#[Validate]` directamente sobre las propiedades.
* **Lifecycle**: Prefiere `mount()` para inicialización y evita lógica pesada en `render()`.

### 3. Frontend & UI

* **Tailwind CSS**: No uses CSS personalizado a menos que sea estrictamente necesario, y si lo haces, asegúrate de que sea compatible con Tailwind y solicita autorización.
* **Alpine.js**: Úsalo para micro-interacciones (modales, dropdowns, toggles) para evitar peticiones innecesarias al servidor.
* **Blade**: Usa componentes de Blade anidados para máxima reutilización.

---

## 📋 Instrucciones para Context7

Al generar código, sigue estas reglas de prioridad:

| Prioridad | Elemento | Regla de Oro |
| --- | --- | --- |
| **Alta** | **Tipado** | Todo método debe tener tipos de retorno y argumentos definidos. |
| **Alta** | **Seguridad** | Usa `can()` y Policies para autorizar cada acción de Livewire. |
| **Media** | **UX** | Incluye estados de carga (`wire:loading`) y confirmaciones. |
| **Media** | **Testing** | Sugiere un test de Pest para cada funcionalidad nueva. |

---

## 📂 Estructura de Archivos Esperada

Cuando crees nuevas funcionalidades, organiza los archivos así:

* `app/Livewire/`: Componentes de clase estándar.
* `resources/views/livewire/`: Vistas de los componentes.
* `app/Actions/`: Clases de lógica única (Service Pattern).
* `database/factories/` y `database/seeders/`: Siempre genera datos de prueba.

---

## 🚨 Anti-Patrones (Lo que NO debes hacer)

1. **No** uses `public $property` en Livewire para datos sensibles sin `#[Locked]`.
2. **No** uses jQuery bajo ninguna circunstancia.
3. **No** escribas consultas SQL crudas; usa Eloquent o el Query Builder.
4. **No** ignores el manejo de errores en formularios (`<x-input-error />`).

---

## 🔄 Flujo de Trabajo con Context7

> "Antes de escribir código, analiza si la funcionalidad requiere un nuevo componente Livewire independiente o si puede integrarse en uno existente mediante `@teleport` o eventos."