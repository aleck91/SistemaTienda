<?php

namespace App\Policies; 
use App\Models\Producto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductoPolicy {

    use HandlesAuthorization;
    public function delete( $user) 
    {
         return $user->hasRole('admin'); 
    }
}