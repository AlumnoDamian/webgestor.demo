<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository
{
    /**
     * Get all employees with their departments.
     */
    public function getAll()
    {
        return Employee::with('departments')->get();
    }

    public function find($id)
    {
        return Employee::findOrFail($id);
    }

    /**
     * Create a new employee along with a user.
     */
    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $employee = Employee::create(array_merge($data, [
            'user_id' => $user->id,
            'password' => Hash::make($data['password']),
        ]));

        $employee->departments()->attach($data['department_id']);

        return $employee;
    }

    /**
     * Update an employee record.
     */
    public function update(Employee $employee, array $data)
    {
        $user = $employee->user;

        if (isset($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        if (isset($data['email'])) {
            $user->update(['email' => $data['email']]);
        }

        $employee->update($data);
        $employee->departments()->sync([$data['department_id']]);

        return $employee;
    }

    /**
     * Delete an employee record along with their image.
     */
    public function delete(Employee $employee)
    {
        if ($employee->image) {
            Storage::delete('public/' . $employee->image);
        }

        $employee->delete();
    }
}
