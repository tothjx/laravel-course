<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function versions()
    {
        exec('composer --version 2>&1', $composerOut);
        $composerVersion = $composerOut[0] ?? 'Not available';

        exec('node --version 2>&1', $nodeOut);
        $nodeVersion = $nodeOut[0] ?? 'Not available';

        exec('npm --version 2>&1', $npmOut);
        $npmVersion = $npmOut[0] ?? 'Not available';

        return view(
            'versions',
            [
                'laravel' => app()->version(),
                'php' => PHP_VERSION,
                'composer' => $composerVersion,
                'node' => $nodeVersion,
                'npm' => $npmVersion
            ]
        );
    }
}
