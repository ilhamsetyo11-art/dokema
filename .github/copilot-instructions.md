# DOKEMA AI Coding Assistant Instructions

## Project Overview

DOKEMA (Sistem Manajemen Magang) is a Laravel 12 internship management system with workflow approval automation, role-based access control, and integrated reporting. The system manages the complete internship lifecycle: application → approval → supervision → reporting → evaluation.

## Architecture & Key Patterns

### Role-Based Data Flow

Three primary roles drive the workflow:

-   **Magang (Intern)**: Submits applications, creates daily reports (`laporan_kegiatan`), logs activities
-   **Pembimbing (Supervisor)**: Reviews intern progress, provides guidance (`log_bimbingan`), conducts final evaluation (`penilaian_akhir`)
-   **HR**: Approves/rejects applications via `WorkflowMagangController`, assigns supervisors, manages quotas

### Database Schema Relationships

```
users (role: magang|pembimbing|hr)
  ↓ hasOne
profil_peserta (detailed intern profile)
  ↓ hasOne
data_magang (internship record with workflow_status)
  ↓ hasMany
  ├─ laporan_kegiatan (daily activity reports)
  ├─ log_bimbingan (supervision logs)
  └─ penilaian_akhir (final evaluation - hasOne)
```

**Critical**: `DataMagang` model uses `workflow_status` enum (draft → submitted → under_review → approved/rejected → in_progress → completed → evaluated) defined in [config/magang.php](config/magang.php). The legacy `status` field coexists for backward compatibility (menunggu/diterima/ditolak).

### Workflow Approval System

[WorkflowMagangController](app/Http/Controllers/Magang/WorkflowMagangController.php) implements automated approval logic:

1. Checks quota via `checkQuota()` method (max defined in `config('magang.max_quota')`)
2. Auto-assigns supervisors by workload (`withCount` on `magangDibimbing` relationship)
3. Handles file upload for `surat_balasan` (acceptance letter) to `storage/app/public/surat_balasan/`
4. Updates status and timestamps (`tanggal_persetujuan`/`tanggal_penolakan`)

**Important**: Email notifications are commented out but infrastructure exists (search for `Mail::` comments).

## Component System

### Blade Component Hierarchy

All admin pages use `<x-admin-layouts>` wrapper which includes:

-   Alpine.js sidebar toggle (`x-data="{ sidebarOpen: false }"`)
-   Flash message system (success/error with auto-dismiss)
-   Consistent header/sidebar via `<x-admin-header>` and `<x-sidebar>`

### Form Components (Namespace: x-admin.\*)

Located in [resources/views/components/admin/](resources/views/components/admin/):

-   `<x-admin.form-input>`: Auto-displays validation errors via `@error($name)`
-   `<x-admin.form-select>`: Dropdown with optional placeholder
-   `<x-admin.form-textarea>`: Configurable rows
-   `<x-admin.form-button>`: Primary/secondary styling variants

**Convention**: All form components accept `name`, `label`, `required` props. Old input is preserved via `{{ old($name, $value) }}`.

### Table Component

`<x-admin.table>` integrates DataTables.js for pagination/search. Example from [resources/views/magang/index.blade.php](resources/views/magang/index.blade.php):

```blade
<x-admin.table :headers="['Nama', 'Status', 'Tanggal']" id="magangTable">
    @foreach($dataList as $item)
        <tr>...</tr>
    @endforeach
</x-admin.table>
```

## Development Workflow

### Quick Start Commands

```bash
# Setup with seeders (creates test data for all roles)
php artisan migrate:fresh --seed

# Dev mode with hot reload + queue worker (defined in composer.json)
composer run dev

# Or manually:
php artisan serve
npm run dev
php artisan queue:listen --tries=1  # For background jobs
```

### Database Seeding Strategy

[DatabaseSeeder](database/seeders/DatabaseSeeder.php) calls seeders in dependency order:

1. `UserSeeder` → Creates hr@dokema.com, pembimbing@dokema.com, magang@dokema.com (password: "password")
2. `ProfilPesertaSeeder` → Links profiles to magang users
3. `DataMagangSeeder` → Creates sample internship records with various `workflow_status` states
4. Relationship seeders (LaporanKegiatan, LogBimbingan, PenilaianAkhir)

**Always seed in order** to avoid foreign key constraint violations.

### File Storage Convention

Public uploads go to `storage/app/public/` with structured folders:

-   `surat_permohonan/` - Application letters (uploaded by interns)
-   `surat_balasan/` - Acceptance letters (uploaded by HR during approval)
-   `laporan_kegiatan/` - Activity report attachments

**Link storage**: `php artisan storage:link` (creates `public/storage` symlink)

## Routing Patterns

### Resource Routes Convention

Controllers follow nested resource pattern for related entities:

```php
// Parent resource
Route::resource('magang', DataMagangController::class);

// Nested child resources
Route::get('/magang/{magangId}/bimbingan', [LogBimbinganController::class, 'index']);
Route::post('/magang/{magangId}/bimbingan', [LogBimbinganController::class, 'store']);
```

Routes are defined in [routes/web.php](routes/web.php). **No authentication middleware** is visible (assumed global middleware or removed for demo).

### Controller Location

Domain-organized under `app/Http/Controllers/Magang/`:

-   `DataMagangController` - CRUD for internship records
-   `ProfilPesertaController` - Intern profile management
-   `LaporanKegiatanController` - Daily activity reports
-   `LogBimbinganController` - Supervision logs
-   `PenilaianAkhirController` - Final evaluations
-   `WorkflowMagangController` - Approval workflow (non-CRUD)

## Styling & Frontend

### Tailwind CSS + Alpine.js Stack

-   **Tailwind 4.0** with Vite plugin (see [tailwind.config.js](tailwind.config.js))
-   **Alpine.js** for reactive UI (sidebar toggle, flash message dismiss)
-   **Lucide Icons** via `mallardduck/blade-lucide-icons` package
-   **DataTables.js** for table enhancement (imported in [resources/js/app.js](resources/js/app.js))

### CSS Class Conventions

Primary button: `bg-blue-600 hover:bg-blue-700 text-white`  
Danger button: `bg-red-600 hover:bg-red-700 text-white`  
Form input: `border-gray-300 rounded-md shadow-sm focus:ring-blue-500`

Refer to [COMPONENTS.md](COMPONENTS.md) for complete component API documentation.

## Testing & Quality

### Test Structure

PHPUnit configured in [phpunit.xml](phpunit.xml). Run tests:

```bash
composer test
# Or: php artisan test
```

Tests located in `tests/Feature/` and `tests/Unit/`. **Note**: Current test coverage appears minimal - validate before refactoring.

### Code Style

Laravel Pint (PHP CS Fixer wrapper) configured:

```bash
./vendor/bin/pint
```

## Common Tasks

### Adding a New Workflow Status

1. Update enum in migration [2025_09_06_100000_add_workflow_fields_to_data_magang.php](database/migrations/2025_09_06_100000_add_workflow_fields_to_data_magang.php)
2. Add to `workflow_statuses` array in [config/magang.php](config/magang.php)
3. Update `WorkflowMagangController::processApplication()` logic
4. Add UI state handling in views

### Creating a New Report Type

1. Generate model: `php artisan make:model NewReport -m`
2. Add relationship to `DataMagang` model
3. Create controller: `php artisan make:controller Magang/NewReportController`
4. Define routes in [web.php](routes/web.php) following nested pattern
5. Create Blade views using `<x-admin-layouts>` and form components

### Customizing Quota Logic

Quota configuration in [config/magang.php](config/magang.php):

-   `max_quota` - Default 20, can be ENV-configured (`MAGANG_MAX_QUOTA`)
-   `auto_assign_supervisor` - Toggle auto-assignment
-   Modify `WorkflowMagangController::checkQuota()` for custom logic (e.g., per-department quotas)

## Outstanding Issues & Implementation Priorities

### 🔴 CRITICAL - Authentication & Authorization

**Issue #1: Login/Logout Functionality**

-   **Problem**: Logout error occurs, landing page after login not developed
-   **Location**: Auth scaffolding incomplete
-   **Solution**:
    ```bash
    php artisan make:controller Auth/AuthController
    # Implement logout route: POST /logout
    # Create dashboard view: resources/views/dashboard.blade.php
    ```
-   **Files to check**: `routes/web.php`, verify logout route exists
-   **Middleware**: Add `auth` middleware to protected routes

**Issue #3: User Management & Account Approval Integration**

-   **Problem**: User registration flow unclear, approval not tied to magang approval
-   **Current**: Separate user creation and magang approval processes
-   **Proposed**: Auto-create user account when HR approves magang application
-   **Implementation**:
    ```php
    // In WorkflowMagangController::processApplication()
    if ($request->action === 'approve') {
        // Create user account automatically
        $user = User::create([
            'name' => $magang->profilPeserta->nama,
            'email' => $magang->profilPeserta->email,
            'password' => Hash::make(Str::random(12)), // Send via email
            'role' => 'magang'
        ]);
        // Link to profil_peserta
    }
    ```

### 🟠 HIGH - Workflow & Approval System

**Issue #2: Workflow Approval Disconnected**

-   **Problem**: Workflow steps between modules not properly connected
-   **Root cause**: Missing status transitions and notifications
-   **Solution**:
    1. Implement workflow state machine in `DataMagang` model
    2. Add event listeners for status changes
    3. Create `WorkflowTransition` model to log all status changes
    ```php
    // Example in DataMagang model
    protected static function booted() {
        static::updating(function ($magang) {
            if ($magang->isDirty('workflow_status')) {
                WorkflowTransition::log($magang);
            }
        });
    }
    ```

**Issue #5: Active Magang List Not Real-time**

-   **Problem**: Workflow approval module shows stale data
-   **Solution**:
    -   Remove caching if implemented
    -   Use Eloquent eager loading: `DataMagang::with(['profilPeserta', 'pembimbing'])->where('status', 'diterima')`
    -   Add real-time updates with Laravel Echo (optional)

**Issue #6: Report Approval Functionality Missing**

-   **Problem**: Pembimbing cannot approve/reject reports in `LaporanKegiatanController`
-   **CRITICAL**: Core FOD requirement missing
-   **Implementation**:

    ```php
    // Migration
    Schema::table('laporan_kegiatan', function (Blueprint $table) {
        $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending');
        $table->foreignId('verified_by')->nullable()->constrained('users');
        $table->timestamp('verified_at')->nullable();
        $table->text('catatan_verifikasi')->nullable();
    });

    // Add routes
    Route::post('/laporan/{id}/approve', [LaporanKegiatanController::class, 'approve']);
    Route::post('/laporan/{id}/reject', [LaporanKegiatanController::class, 'reject']);

    // Controller methods
    public function approve(Request $request, $id) {
        $laporan = LaporanKegiatan::findOrFail($id);
        $laporan->update([
            'status_verifikasi' => 'verified',
            'verified_by' => auth()->id(),
            'verified_at' => now()
        ]);
        return redirect()->back()->with('success', 'Laporan disetujui');
    }
    ```

### 🟡 MEDIUM - Administrative Features

**Issue #4: Quota Management Interface**

-   **Problem**: No UI for HR to manage quota
-   **Current**: Quota hardcoded in `config/magang.php`
-   **Solution**: Create settings page for HR
    ```bash
    php artisan make:controller Admin/SettingsController
    php artisan make:model Setting -m
    ```
-   **Database**:
    ```php
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('key')->unique();
        $table->text('value');
        $table->string('type')->default('string'); // string, int, bool, json
        $table->timestamps();
    });
    ```
-   **Route**: Add to sidebar under HR section: `/admin/settings`

**Issue #8: Penilaian Module Not Functional**

-   **Problem**: `PenilaianAkhirController` cannot assign scores
-   **Check**: Verify form validation, ensure `PenilaianAkhir` model has fillable fields
-   **Common issue**: Missing relationship or incorrect foreign key
-   **Debug**:
    ```php
    // In PenilaianAkhirController::store()
    dd($request->all()); // Check incoming data
    // Verify $magang->penilaianAkhir relationship works
    ```

### 🟢 LOW - Automation & Enhancement

**Issue #7: Auto-generate Log Bimbingan**

-   **Proposal**: Create `LogBimbingan` automatically when `LaporanKegiatan` submitted
-   **Implementation approach**:
    ```php
    // In LaporanKegiatan model
    protected static function booted() {
        static::created(function ($laporan) {
            LogBimbingan::create([
                'data_magang_id' => $laporan->data_magang_id,
                'tanggal' => $laporan->tanggal,
                'keterangan' => 'Auto-generated from laporan: ' . $laporan->kegiatan,
                'created_by' => $laporan->data_magang->pembimbing_id
            ]);
        });
    }
    ```
-   **Alternative**: Manual trigger by pembimbing (recommended for quality control)

### Critical Gaps (vs FOD Diagram)

-   **Laporan verification workflow**: Missing `status_verifikasi` field in `laporan_kegiatan` - pembimbing cannot approve/reject reports (see Issue #6)
-   **Surat nilai generation**: No PDF generation for certificate letters (dompdf installed but unused)
-   **Attendance tracking**: No `kehadiran` table/model for daily check-ins at office
-   **Document checklist**: No tracking for physical document submission (`dokumen_lengkap` field missing)
-   **Rekap data dashboard**: No summary view for accumulated reports and attendance

### Infrastructure Issues

-   **Email notifications disabled**: Mail facade calls commented out in `WorkflowMagangController`
-   **No authentication visible**: Routes lack auth middleware in `web.php` (verify middleware in production) - see Issue #1
-   **Workflow notifications table**: Created in migration but not actively used (see `workflow_notifications` schema)
-   **Excel export**: maatwebsite/excel installed but not implemented for data export

## Implementation Checklist

When implementing fixes, follow this order:

1. ✅ **Authentication** (Issue #1) - Critical for system security
2. ✅ **Report Approval** (Issue #6) - Blocks pembimbing workflow
3. ✅ **Account Integration** (Issue #3) - Streamlines onboarding
4. ✅ **Workflow Transitions** (Issue #2) - Improves data consistency
5. ⚠️ **Quota Management** (Issue #4) - Administrative need
6. ⚠️ **Active List Refresh** (Issue #5) - Data quality
7. ⚠️ **Penilaian Fix** (Issue #8) - End-of-cycle requirement
8. 💡 **Log Bimbingan Automation** (Issue #7) - Enhancement

**Testing after each fix**:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
composer test
```

## Key Configuration Files

-   [config/magang.php](config/magang.php) - Workflow statuses, quota, document types
-   [composer.json](composer.json) - Dependencies, custom `composer run dev` script
-   [package.json](package.json) - Frontend tooling (Vite, Tailwind 4, DataTables)
-   [.env.example](.env.example) - Environment template (DB, magang-specific vars)

## Documentation References

-   [README.md](README.md) - Full feature list and installation
-   [QUICKSTART.md](QUICKSTART.md) - 5-minute setup with default credentials
-   [COMPONENTS.md](COMPONENTS.md) - Complete Blade component API
-   [CONTRIBUTING.md](CONTRIBUTING.md) - Code style guidelines and PR process
