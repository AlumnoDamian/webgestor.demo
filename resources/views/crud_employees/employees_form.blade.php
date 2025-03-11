<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="p-4 shadow-lg rounded bg-light transition-all duration-300">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="row">
        <!-- Campo DNI -->
        <div class="col-md-4 mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control @error('dni') is-invalid @enderror" 
                value="{{ old('dni', $employee->dni ?? '') }}">
            @error('dni')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Nombre -->
        <div class="col-md-4 mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', $employee->name ?? '') }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Correo Electrónico -->
        <div class="col-md-4 mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email', $employee->email ?? '') }}">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <!-- Campo Contraseña -->
        <div class="col-md-4 mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                   placeholder="{{ isset($employee) ? 'Deja vacío para mantener la contraseña actual' : 'Nueva contraseña' }}">
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Confirmar Contraseña -->
        <div class="col-md-4 mb-3">
            <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" 
                   placeholder="{{ isset($employee) ? 'Repite la nueva contraseña' : 'Repite la nueva contraseña' }}">
            @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Fecha de nacimiento -->
        <div class="col-md-4 mb-3">
            <label for="birth_date" class="form-label">Fecha de nacimiento</label>
            <input type="text" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" 
                   value="{{ old('birth_date', $employee->birth_date ?? '') }}">
            @error('birth_date')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <!-- Campo Dirección -->
        <div class="col-md-4 mb-3">
            <label for="address" class="form-label">Dirección</label>
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address', $employee->address ?? '') }}</textarea>
            @error('address')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Teléfono -->
        <div class="col-md-4 mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                value="{{ old('phone', $employee->phone ?? '') }}">
            @error('phone')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Estado -->
        <div class="col-md-4 mb-3">
            <label for="is_active" class="form-label">Estado</label>
            <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                <option value="1" {{ old('is_active', $employee->is_active ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('is_active', $employee->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('is_active')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <!-- Campo Imagen -->
        <div class="col-md-4 mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            @isset($employee->image)
                <div class="mt-2">
                    <p class="text-muted">Imagen actual:</p>
                    <img src="{{ Storage::url($employee->image) }}" alt="Imagen del empleado" width="100" class="img-thumbnail">
                </div>
            @endisset

            <img id="image-preview" src="" alt="Vista previa de la imagen" style="display: none; width: 100px;" class="mt-2 img-thumbnail">
        </div>

        <!-- Campo Departamento -->
        <div class="col-md-4 mb-3">
            <label for="department_id" class="form-label">Departamento</label>
            <select name="department_id" id="department_id" class="form-control @error('department_id') is-invalid @enderror">
                <option value="">Selecciona un departamento</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" 
                        {{ isset($employee) && $employee->departments->contains($department->id) ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campo Rol -->
        <div class="col-md-4 mb-3">
            <label for="role" class="form-label">Rol</label>
            <select name="role" id="role" class="form-control">
                <option value="">Selecciona un rol de trabajo</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ old('role', $employee->role ?? '') == $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary shadow-md hover-shadow-lg">Cancelar</a>
        <button type="submit" class="btn btn-primary shadow-md hover-shadow-lg">{{ $buttonText }}</button>
    </div>
</form>
