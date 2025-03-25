<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getEmployeeRepository()
    {
        return $this->employeeRepository;
    }

    public function getProfile($userId)
    {
        return Employee::where('user_id', $userId)->firstOrFail();
    }

    public function storeEmployee($validatedData)
    {
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $this->generateUniqueEmail($validatedData['name']),
            'password' => Hash::make($validatedData['password']),
        ]);

        $imagePath = $this->handleImageUpload($validatedData);

        $employee = Employee::create(array_merge($validatedData, [
            'user_id' => $user->id,
            'image' => $imagePath,
            'password' => Hash::make($validatedData['password'])
        ]));

        $employee->departments()->attach($validatedData['department_id']);

        return $employee;
    }

    public function updateEmployee(Employee $employee, $validatedData)
    {
        $employee->update($validatedData);
        $employee->departments()->sync([$validatedData['department_id']]);
    }

    public function deleteEmployee(Employee $employee)
    {
        $this->deleteOldImage($employee->image);
        $employee->delete();
    }

    private function generateUniqueEmail($name)
    {
        $email = strtolower(str_replace(' ', '', $name)) . '@gmail.com';
        while (User::where('email', $email)->exists()) {
            $email = strtolower(str_replace(' ', '', $name)) . rand(100, 999) . '@gmail.com';
        }
        return $email;
    }

    private function handleImageUpload($validatedData)
    {
        return isset($validatedData['image']) 
            ? Storage::put('employee_images', $validatedData['image']) 
            : null;
    }

    private function deleteOldImage($image)
    {
        if ($image) {
            Storage::delete('public/' . $image);
        }
    }
}
