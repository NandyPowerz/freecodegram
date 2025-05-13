// app/Http/Kernel.php
// Make sure these middleware aliases are defined in the $middlewareAliases property
protected $middlewareAliases = [
    // Other middleware...
    'auth' => \App\Http\Middleware\Authenticate::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
];