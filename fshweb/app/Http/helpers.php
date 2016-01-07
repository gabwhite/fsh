<?php

function GenerateFoodCategoryTree()
{
    echo "Test Test";
}

function isProductOwner($productId)
{
    $u = Auth::user();
    $p = \App\Models\Product::find($productId);

    // Check if they're a direct owner first
    if($u->id == $p->user_id)
    {
        return true;
    }

    return false;
}

function isEmailInUse($email, $user_id = null)
{
    $inUse = false;

    if(!is_null($user_id))
    {
        // Check for the email in use (excluding own user)
        $u = \App\Models\User::where('id', '!=', $user_id)->where('email', '=', $email)->get();

        if($u->count() > 0) { $inUse = true; }
    }
    else
    {
        // Just check for email (new user registration)
        $u = \App\Models\User::where('email', '=', $email)->get();

        if($u->count() > 0) { $inUse = true; }
    }

    return $inUse;
}
