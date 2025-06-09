<?php

namespace App\Policies;

use App\Models\pelanggan\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        // Biasanya user boleh lihat daftar order mereka sendiri
        return true;
    }

    public function view(User $user, Order $order): bool
    {
        // User hanya boleh lihat order yang dia punya
        return $user->id === $order->user_id;
    }

    public function create(User $user): bool
    {
        // Biasanya user boleh buat order
        return true;
    }

    public function update(User $user, Order $order): bool
    {
        // User hanya boleh update order mereka sendiri
        return $user->id === $order->user_id;
    }

    public function delete(User $user, Order $order): bool
    {
        // User hanya boleh hapus order mereka sendiri
        return $user->id === $order->user_id;
    }

    public function restore(User $user, Order $order): bool
    {
        // Optional, implement sesuai kebutuhan
        return $user->id === $order->user_id;
    }

    public function forceDelete(User $user, Order $order): bool
    {
        // Optional, implement sesuai kebutuhan
        return $user->id === $order->user_id;
    }
}
