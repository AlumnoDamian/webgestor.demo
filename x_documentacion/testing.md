# 🧪 Documentación de Pruebas - Webgestor

## 📋 Índice
1. [Introducción](#introducción)
2. [Pruebas Unitarias](#pruebas-unitarias)
3. [Pruebas de Características](#pruebas-de-características)
4. [Pruebas de Autenticación](#pruebas-de-autenticación)
5. [Ejecución de Pruebas](#ejecución-de-pruebas)

## 🎯 Introducción
Este documento describe las pruebas automatizadas implementadas en el proyecto Webgestor para garantizar su correcto funcionamiento. Las pruebas están organizadas en diferentes categorías y utilizan PHPUnit como framework de testing.

## 🔬 Pruebas Unitarias

### 📊 Modelo Department (`tests/Unit/DepartmentTest.php`)

#### Atributos y Validación
- `test_department_has_required_attributes()`: Verifica la presencia de código, nombre y estado
- `test_department_can_have_optional_attributes()`: Valida campos opcionales como descripción, presupuesto, teléfono y email
- `test_department_validation_rules()`: Comprueba las reglas de validación para cada campo

#### Relaciones
- `test_department_can_have_manager()`: Verifica la relación con el empleado gestor
- `test_department_can_have_multiple_employees()`: Prueba la relación uno a muchos con empleados
- `test_department_can_track_active_employees()`: Valida el filtrado de empleados activos

#### Estado y Operaciones
- `test_department_can_be_inactive()`: Verifica la gestión del estado del departamento
- `test_department_can_be_soft_deleted()`: Prueba el borrado lógico
- `test_department_budget_calculations()`: Valida cálculos relacionados con el presupuesto

### 👥 Modelo Employee (`tests/Unit/EmployeeTest.php`)

#### Información Personal
- `test_employee_has_required_personal_info()`: Verifica datos personales obligatorios
- `test_employee_contact_information()`: Valida información de contacto
- `test_employee_document_validation()`: Comprueba validación de documentos

#### Relaciones Laborales
- `test_employee_belongs_to_department()`: Verifica asignación a departamento
- `test_employee_can_have_schedules()`: Prueba relación con horarios
- `test_employee_can_have_multiple_roles()`: Valida gestión de roles

#### Gestión de Estado
- `test_employee_activation_deactivation()`: Prueba activación/desactivación
- `test_employee_leave_management()`: Verifica gestión de ausencias
- `test_employee_schedule_conflicts()`: Detecta conflictos de horarios

### 📝 Modelo Memo (`tests/Unit/MemoTest.php`)

#### Contenido y Validación
- `test_memo_requires_title_and_content()`: Verifica campos obligatorios
- `test_memo_content_formatting()`: Valida formato del contenido
- `test_memo_attachments()`: Prueba gestión de archivos adjuntos

#### Gestión y Estados
- `test_memo_publication_workflow()`: Verifica flujo de publicación
- `test_memo_visibility_rules()`: Prueba reglas de visibilidad
- `test_memo_department_targeting()`: Valida direccionamiento a departamentos

### 📅 Modelo Schedule (`tests/Unit/ScheduleTest.php`)

#### Gestión de Turnos
- `test_schedule_shift_validation()`: Verifica tipos de turnos válidos
- `test_schedule_overlap_detection()`: Detecta solapamientos de horarios
- `test_schedule_weekly_hours()`: Calcula horas semanales

#### Asignaciones
- `test_schedule_employee_assignment()`: Verifica asignación a empleados
- `test_schedule_department_coverage()`: Prueba cobertura por departamento
- `test_schedule_rotation_patterns()`: Valida patrones de rotación

## 🔍 Pruebas de Características

### 💼 Gestión de Departamentos

#### Formulario de Departamento (`DepartmentFormTest.php`)
- `test_can_create_department()`: Creación de nuevo departamento
- `test_can_update_department()`: Actualización de información
- `test_validates_required_fields()`: Validación de campos obligatorios
- `test_unique_department_code()`: Verificación de códigos únicos
- `test_budget_validation()`: Validación de presupuestos

#### Tabla de Departamentos (`DepartmentTableTest.php`)
- `test_department_listing()`: Listado de departamentos
- `test_department_search()`: Búsqueda por criterios
- `test_department_filtering()`: Filtrado por estado
- `test_department_sorting()`: Ordenamiento de resultados
- `test_department_pagination()`: Paginación de resultados

### 👤 Gestión de Empleados

#### Formulario de Empleado (`EmployeeFormTest.php`)
- `test_can_create_employee()`: Registro de nuevo empleado
- `test_validates_employee_data()`: Validación de datos
- `test_handles_document_upload()`: Gestión de documentos
- `test_department_assignment()`: Asignación a departamento
- `test_role_management()`: Gestión de roles y permisos

#### Tabla de Empleados (`EmployeeTableTest.php`)
- `test_employee_listing()`: Listado de empleados
- `test_employee_search()`: Búsqueda avanzada
- `test_employee_filtering()`: Filtros múltiples
- `test_employee_export()`: Exportación de datos
- `test_bulk_actions()`: Acciones en lote

#### Perfil de Empleado (`EmployeeProfileTest.php`)
- `test_profile_view()`: Visualización de perfil
- `test_contact_info_update()`: Actualización de contacto
- `test_document_management()`: Gestión documental
- `test_schedule_history()`: Historial de horarios
- `test_leave_requests()`: Solicitudes de ausencia

### 📅 Gestión de Cuadrantes (`ScheduleViewTest.php`)

#### Visualización
- `test_schedule_index_shows_department_selector()`: Selector de departamento
- `test_schedule_shows_empty_state()`: Estado vacío inicial
- `test_schedule_shows_four_week_tabs()`: Pestañas de semanas
- `test_schedule_shows_employee_names()`: Nombres de empleados
- `test_schedule_shows_correct_date_format()`: Formato de fechas

#### Interacción
- `test_can_assign_shifts()`: Asignación de turnos
- `test_can_modify_shifts()`: Modificación de turnos
- `test_validates_shift_conflicts()`: Validación de conflictos
- `test_handles_weekend_shifts()`: Gestión de fines de semana
- `test_bulk_shift_assignment()`: Asignación masiva

## 🔐 Pruebas de Autenticación

### Login y Registro (`AuthenticationTest.php`)
- `test_login_screen_can_be_rendered()`: Renderizado de login
- `test_users_can_authenticate()`: Autenticación exitosa
- `test_users_can_not_authenticate_with_invalid_password()`: Validación de credenciales
- `test_users_can_logout()`: Cierre de sesión
- `test_password_confirmation()`: Confirmación de contraseña

### Gestión de Contraseñas
- `test_reset_password_link_screen_can_be_rendered()`: Pantalla de reset
- `test_password_can_be_reset()`: Proceso de reset
- `test_password_update_validation()`: Validación de contraseña
- `test_password_confirmation_screen()`: Confirmación de seguridad

## ⚡ Ejecución de Pruebas

### Requisitos Previos
```bash
composer install
cp .env.example .env
php artisan key:generate
```

### Configuración de Base de Datos de Pruebas
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_testing
DB_USERNAME=root
DB_PASSWORD=
```

### Comandos de Ejecución

#### Crear directorio de testing
```bash
sudo mkdir -p storage/framework/testing/disks/public && sudo chmod -R 777 storage
```

#### Ejecutar todas las pruebas
```bash
php artisan test
```

#### Ejecutar pruebas por categoría
```bash
# Pruebas unitarias
php artisan test --testsuite=Unit

# Pruebas de características
php artisan test --testsuite=Feature

# Pruebas específicas por módulo
php artisan test tests/Feature/Auth            # Autenticación
php artisan test tests/Feature/Livewire/Department  # Departamentos
php artisan test tests/Feature/Livewire/Employee    # Empleados
php artisan test tests/Feature/Schedule            # Cuadrantes
```

## 📊 Cobertura de Código

### Modelos
| Modelo      | Cobertura | Métodos Probados | Total Métodos |
|-------------|-----------|------------------|---------------|
| Department  | 100%      | 15/15           | 15           |
| Employee    | 100%      | 20/20           | 20           |
| Schedule    | 100%      | 16/16           | 16           |
| Memo        | 100%      | 12/12           | 12           |

### Componentes Livewire
| Componente       | Cobertura | Métodos Probados | Total Métodos |
|-----------------|-----------|------------------|---------------|
| DepartmentForm  | 100%      | 8/8             | 8            |
| DepartmentTable | 100%      | 10/10           | 10           |
| EmployeeForm    | 100%      | 12/12           | 12           |
| EmployeeTable   | 100%      | 15/15           | 15           |
| EmployeeProfile | 100%      | 10/10           | 10           |

### Controladores y Servicios
| Componente          | Cobertura | Métodos Probados | Total Métodos |
|--------------------|-----------|------------------|---------------|
| ScheduleController | 100%      | 8/8             | 8            |
| MemoController     | 100%      | 6/6             | 6            |
| AuthController     | 100%      | 5/5             | 5            |