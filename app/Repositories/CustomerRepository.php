<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all()
    {
        return Customer::orderBy('name')
            ->where('active', '1')
            ->with('user')
            ->get()
            ->map->format();

        // return Customer::orderBy('name')
        // ->where('active', '1')
        // ->with('user')
        // ->get()
        // ->map(function ($customer) {
        //     return $customer->format();
        // });
    }

    public function findById($id)
    {
        return Customer::where('id', $id)
            ->where('active', 1)
            ->with('user')
            ->firstOrFail()
            ->format();
    }

    public function update($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->update(request()->only('name'));
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
    }
}
