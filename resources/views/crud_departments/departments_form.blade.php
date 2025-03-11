<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="p-4 shadow-lg rounded bg-light transition-all duration-300">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="row">
        <!-- Campo Código -->
        <div class="col-md-4 mb-3">
            <label for="code" class="form-label">Código del Departamento</label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" 
                   value="{{ old('code', $department->code ?? '') }}">
            @error('code')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Nombre -->
        <div class="col-md-4 mb-3">
            <label for="name" class="form-label">Nombre del Departamento</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $department->name ?? '') }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Descripción -->
        <div class="col-md-4 mb-3">
            <label for="description" class="form-label">Descripción</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                   value="{{ old('description', $department->description ?? '') }}">
            @error('description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <!-- Campo Jefe de Departamento -->
        <div class="col-md-4 mb-3">
            <label for="manager_id" class="form-label">Jefe de Departamento</label>
            <select name="manager_id" id="manager_id" class="form-control @error('manager_id') is-invalid @enderror">
                <option value="">Seleccione un jefe (opcional)</option>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}" 
                            {{ old('manager_id', $department->manager_id ?? '') == $manager->id ? 'selected' : '' }}>
                        {{ $manager->name }}
                    </option>
                @endforeach
            </select>
            @error('manager_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Presupuesto -->
        <div class="col-md-4 mb-3">
            <label for="budget" class="form-label">Presupuesto</label>
            <input type="number" name="budget" id="budget" class="form-control @error('budget') is-invalid @enderror" 
                   value="{{ old('budget', $department->budget ?? '') }}">
            @error('budget')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Teléfono -->
        <div class="col-md-4 mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                   value="{{ old('phone', $department->phone ?? '') }}">
            @error('phone')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <!-- Campo Correo Electrónico -->
        <div class="col-md-4 mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email', $department->email ?? '') }}">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Estado -->
        <div class="col-md-4 mb-3">
            <label for="status" class="form-label">Estado</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                <option value="1" {{ old('status', $department->status ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('status', $department->status ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('status')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('departamentos.index') }}" class="btn btn-secondary shadow-md hover-shadow-lg">Cancelar</a>
        <button type="submit" class="btn btn-primary shadow-md hover-shadow-lg">{{ $buttonText }}</button>
    </div>
</form>
