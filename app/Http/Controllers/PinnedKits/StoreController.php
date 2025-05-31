<?php

declare(strict_types=1);

namespace App\Http\Controllers\PinnedKits;

use App\Http\Controllers\Controller;
use App\Models\StarterKit;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StarterKit $kit, Request $request)
    {
        if ($request->user()->cannot('see', $kit)) {
            abort(404);
        }

        $request->user()->pinnedKits()->updateOrCreate([
            'starter_kit_id' => $kit->id,
        ]);

        return redirect()->back();
    }
}
