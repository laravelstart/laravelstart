<?php

declare(strict_types=1);

namespace App\Http\Controllers\PinnedKits;

use App\Http\Controllers\Controller;
use App\Models\StarterKit;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(StarterKit $kit, Request $request)
    {
        $request->user()->pinnedKits()->where([
            'starter_kit_id' => $kit->id,
        ])->delete();

        return redirect()->back();
    }
}
