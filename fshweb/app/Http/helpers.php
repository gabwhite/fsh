<?php

function GenerateFoodCategoryTree()
{
    echo "Test Test";
}

function isUserProductOwner($productId)
{
    $u = Auth::user();
    $p = \App\Models\UserProduct::find($productId);

    // Check if they're a direct owner first
    if($u->id == $p->user_id)
    {
        return true;
    }

    return false;
}
