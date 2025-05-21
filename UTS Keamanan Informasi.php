<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keamanan Data dengan Laravel dan Filament</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-blue-600 dark:text-blue-400 mb-8 text-center">Keamanan Data dengan Laravel 12 & Filament 3</h1>
        <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">1. Autentikasi dan Otorisasi</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Laravel menyediakan sistem autentikasi dan otorisasi yang kuat.
            </p>
            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Autentikasi Pengguna:</strong> Gunakan <code class="text-sm">Laravel Breeze</code> atau <code class="text-sm">Laravel Jetstream</code>. Aktifkan verifikasi email dan pertimbangkan 2FA.</li>
                <li><strong>Otorisasi (RBAC):</strong> Gunakan <code class="text-sm">spatie/laravel-permission</code> untuk manajemen role dan permission.</li>
                <li>Gunakan middleware <code class="text-sm">$this->authorize('permission-name')</code> atau <code class="text-sm">Gate::allows('permission-name')</code> di controller.</li>
                <li>Gunakan directive <code class="text-sm">@can('permission-name')</code> di Blade.</li>
            </ul>
        </section>

        <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">2. Enkripsi Data</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Enkripsi sangat penting untuk data sensitif.
            </p>
            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Enkripsi Data Aplikasi:</strong> Gunakan <code class="text-sm">Illuminate\Contracts\Encryption\Encrypter</code>.</li>
                <li>Contoh:
                    <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
use Illuminate\Support\Facades\Crypt;

// Enkripsi
$encryptedData = Crypt::encryptString('data sensitif');
// Simpan $encryptedData ke database

// Dekripsi
$decryptedData = Crypt::decryptString($encryptedData);
                    </code></pre>
                </li>
                <li>Pastikan <code class="text-sm">APP_KEY</code> aman dan unik di <code class="text-sm">.env</code>.</li>
                 <li><strong>Enkripsi Kolom Database:</strong> (Opsional) Gunakan enkripsi di level database atau mutator/accessor di model Eloquent.
                    <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
// app/Models/User.php
class User extends Model
{
    protected $casts = [
        'sensitive_info' => 'encrypted',
    ];
}
                    </code></pre>
                </li>
            </ul>
        </section>

        <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">3. Validasi Data dan Sanitasi Input</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
               Mencegah injeksi dan input berbahaya.
            </p>
            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Validasi Formulir:</strong> Gunakan <code class="text-sm">Laravel Validation</code>.</li>
                 <li>Contoh:
                    <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
$request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'password' => 'required|string|min:8|confirmed',
]);
                    </code></pre>
                </li>
                <li><strong>Sanitasi Input:</strong> Gunakan <code class="text-sm">strip_tags()</code> atau <code class="text-sm">htmlentities()</code>. Laravel Blade otomatis meng-escape output.</li>
            </ul>
        </section>

        <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">4. Keamanan API</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Untuk aplikasi dengan API.
            </p>
            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Laravel Sanctum:</strong> Untuk SPA dan aplikasi mobile.</li>
                <li><strong>Laravel Passport:</strong> Implementasi OAuth2 server lengkap.</li>
            </ul>
        </section>

        <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">5. Perlindungan Terhadap Serangan Umum</h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">
                Laravel menyediakan perlindungan terhadap serangan umum.
            </p>
            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>CSRF Protection:</strong> Gunakan <code class="text-sm">@csrf</code> di form.</li>
                <li><strong>SQL Injection:</strong> Gunakan Eloquent ORM dan Query Builder.</li>
                <li><strong>XSS:</strong> Gunakan <code class="text-sm">{{ $data }}</code> di Blade.</li>
                <li><strong>Rate Limiting:</strong> Gunakan middleware <code class="text-sm">throttle</code>.</li>
                <li><strong>Header Keamanan HTTP:</strong> Konfigurasi di server atau gunakan middleware Laravel.</li>
                <li><strong>Pembaruan Reguler:</strong> Selalu update Laravel, PHP, dan dependencies.</li>
            </ul>
        </section>

        <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">6. Peran Filament 3 dalam Keamanan Data</h2>
             <p class="text-gray-700 dark:text-gray-300 mb-4">
                Filament 3 memudahkan implementasi keamanan.
            </p>
            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Integrasi Otomatis dengan Autentikasi Laravel:</strong> Filament menggunakan sistem autentikasi Laravel.</li>
                <li><strong>Otorisasi Berbasis Permission:</strong> Integrasi dengan <code class="text-sm">spatie/laravel-permission</code>.</li>
                 <li>Contoh Implementasi di Filament Resource:
                    <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
// app/Filament/Resources/UserResource.php
public static function canCreate(): bool
{
    return auth()->user()->can('create users');
}

public static function canEdit(Model $record): bool
{
    return auth()->user()->can('edit users');
}

protected function getTableQuery(): Builder
{
    if (auth()->user()->cannot('view all users')) {
        return parent::getTableQuery()->where('team_id', auth()->user()->team_id);
    }
    return parent::getTableQuery();
}
                    </code></pre>
                </li>
                <li><strong>Validasi Formulir Otomatis:</strong> Filament mendukung aturan validasi Laravel.</li>
                 <li><strong>Pencatatan Aktivitas (Audit Logging):</strong> Gunakan <code class="text-sm">spatie/laravel-activitylog</code>.</li>
            </ul>
        </section>

        <section class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">7. Langkah-langkah Implementasi Praktis</h2>
            <ul class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                <li><strong>Instalasi Laravel 12 & Filament 3:</strong>
                    <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
composer create-project laravel/laravel:^12.0 your-project-name
cd your-project-name
composer require filament/filament:"^3.2"
php artisan filament:install --panels
                    </code></pre>
                </li>
                <li><strong>Konfigurasi Database & Migrasi:</strong> Atur <code class="text-sm">.env</code> dan jalankan <code class="text-sm">php artisan migrate</code>.</li>
                <li><strong>Instalasi & Konfigurasi spatie/laravel-permission:</strong>
                     <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="permission-migrations"
php artisan migrate
                    </code></pre>
                    Tambahkan <code class="text-sm">HasRoles</code> trait ke model User.
                </li>
                <li><strong>Buat Seeder untuk Role & Permission:</strong>
                    <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
// database/seeders/RolesAndPermissionsSeeder.php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Create Roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo(['view users', 'edit users']);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['view users']);

        // Assign role to a user (example)
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('admin');
    }
}
                    </code></pre>
                     Jalankan <code class="text-sm">php artisan db:seed --class=RolesAndPermissionsSeeder</code>
                </li>
                <li><strong>Terapkan Otorisasi di Filament Resources/Pages:</strong> Sesuaikan Resource untuk menggunakan permission.
                    <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
// app/Filament/Resources/UserResource.php
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    // ...
    public static function canAccess(): bool
    {
        return auth()->user()->can('view users');
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create users');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('edit users');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('delete users');
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        $query = parent::getGlobalSearchEloquentQuery();
        if (auth()->user()->cannot('view all users')) {
            $query->where('id', auth()->id());
        }
        return $query;
    }
}
                    </code></pre>
                </li>
                <li><strong>Penerapan Enkripsi Data:</strong> Gunakan <code class="text-sm">encrypted</code> cast di model Eloquent. Pastikan <code class="text-sm">APP_KEY</code> di <code class="text-sm">.env</code> aman.
                    <pre class="bg-gray-100 dark:bg-gray-900 rounded-md p-2 overflow-x-auto text-sm"><code>
// app/Models/Order.php
class Order extends Model
{
    protected $casts = [
        'credit_card_number' => 'encrypted',
    ];
    // ...
}
                    </code></pre>
                </li>
            </ul>
        </section>
    </div>
</body>
</html>
