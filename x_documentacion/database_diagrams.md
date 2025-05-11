# 📊 Diagramas de Base de Datos - Webgestor

## 📋 Diagrama de Clases

```mermaid
classDiagram
    class User {
        +id: bigint
        +name: string
        +email: string
        +email_verified_at: timestamp
        +password: string
        +remember_token: string
        +created_at: timestamp
        +updated_at: timestamp
    }

    class Department {
        +id: bigint
        +code: string
        +name: string
        +description: text
        +status: boolean
        +manager_id: bigint
        +budget: decimal
        +phone: string
        +email: string
        +created_at: timestamp
        +updated_at: timestamp
        +employees()
        +manager()
        +memos()
    }

    class Employee {
        +id: bigint
        +name: string
        +email: string
        +phone: string
        +address: string
        +birth_date: date
        +hire_date: date
        +position: string
        +salary: decimal
        +department_id: bigint
        +is_active: boolean
        +created_at: timestamp
        +updated_at: timestamp
        +department()
        +schedules()
    }

    class Schedule {
        +id: bigint
        +employee_id: bigint
        +day: date
        +shift: string
        +created_at: timestamp
        +updated_at: timestamp
        +employee()
    }

    class Memo {
        +id: bigint
        +title: string
        +content: text
        +department_id: bigint
        +status: string
        +priority: string
        +published_at: timestamp
        +created_at: timestamp
        +updated_at: timestamp
        +department()
    }

    Department "1" -- "*" Employee : has
    Department "1" -- "*" Memo : has
    Employee "1" -- "*" Schedule : has
    Department "1" -- "1" Employee : managed by

```

## 🔄 Diagrama Entidad-Relación

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email
        timestamp email_verified_at
        string password
        string remember_token
        timestamp created_at
        timestamp updated_at
    }

    DEPARTMENTS {
        bigint id PK
        string code
        string name
        text description
        boolean status
        bigint manager_id FK
        decimal budget
        string phone
        string email
        timestamp created_at
        timestamp updated_at
    }

    EMPLOYEES {
        bigint id PK
        string name
        string email
        string phone
        string address
        date birth_date
        date hire_date
        string position
        decimal salary
        bigint department_id FK
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }

    SCHEDULES {
        bigint id PK
        bigint employee_id FK
        date day
        string shift
        timestamp created_at
        timestamp updated_at
    }

    MEMOS {
        bigint id PK
        string title
        text content
        bigint department_id FK
        string status
        string priority
        timestamp published_at
        timestamp created_at
        timestamp updated_at
    }

    DEPARTMENTS ||--o{ EMPLOYEES : "has"
    DEPARTMENTS ||--o{ MEMOS : "has"
    EMPLOYEES ||--o{ SCHEDULES : "has"
    DEPARTMENTS ||--|| EMPLOYEES : "managed by"
