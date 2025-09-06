# Component Documentation - Dokema System

## Layout Components

### x-admin-layouts

**Path**: `resources/views/components/admin-layouts.blade.php`
**Description**: Main layout template for all admin pages
**Features**:

-   Alpine.js integration for sidebar toggle
-   Flash message display
-   Responsive design
-   Consistent header and sidebar inclusion

**Usage**:

```blade
<x-admin-layouts>
    <x-slot name="header">
        <h2>Page Title</h2>
    </x-slot>

    <!-- Page content -->
</x-admin-layouts>
```

### x-sidebar

**Path**: `resources/views/components/sidebar.blade.php`
**Description**: Navigation sidebar with role-based menu items
**Features**:

-   Mobile-responsive with overlay
-   Active state detection
-   Consistent menu structure
-   Logo integration

### x-admin-header

**Path**: `resources/views/components/admin-header.blade.php`
**Description**: Top navigation header
**Features**:

-   User information display
-   Mobile menu toggle
-   Consistent branding

## Form Components

### x-admin.form-input

**Props**: `name`, `label`, `type`, `value`, `required`, `placeholder`
**Features**:

-   Automatic error display
-   Consistent styling
-   Built-in validation support

**Example**:

```blade
<x-admin.form-input
    name="nama"
    label="Nama Lengkap"
    type="text"
    value="{{ old('nama') }}"
    required="true"
    placeholder="Masukkan nama lengkap" />
```

### x-admin.form-select

**Props**: `name`, `label`, `required`, `placeholder`
**Features**:

-   Dropdown with optional placeholder
-   Error handling
-   Consistent styling

**Example**:

```blade
<x-admin.form-select name="status" label="Status" placeholder="Pilih status">
    <option value="aktif">Aktif</option>
    <option value="nonaktif">Non-aktif</option>
</x-admin.form-select>
```

### x-admin.form-textarea

**Props**: `name`, `label`, `value`, `required`, `placeholder`, `rows`
**Features**:

-   Multi-line text input
-   Configurable row height
-   Error handling

## Button Components

### x-primary-button

**Description**: Main action buttons (blue theme)
**Features**: Loading states, disabled states, consistent sizing

### x-secondary-button

**Description**: Secondary action buttons (gray theme)
**Features**: Outline style, hover effects

### x-danger-button

**Description**: Destructive action buttons (red theme)
**Features**: Warning color scheme, confirmation dialogs

### x-admin.form-button

**Description**: Form submission buttons
**Features**: Optimized for form contexts

## Table Components

### x-admin.table

**Slots**: `thead`, `slot` (tbody)
**Features**:

-   Responsive design
-   Modern styling
-   Consistent spacing

**Example**:

```blade
<x-admin.table>
    <x-slot name="thead">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
            </th>
        </tr>
    </x-slot>

    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
            Data
        </td>
    </tr>
</x-admin.table>
```

## Basic Input Components

### x-text-input

**Description**: Base text input component
**Features**: Consistent styling, focus states, validation-ready

### x-textarea

**Description**: Base textarea component  
**Features**: Multi-line input, consistent styling

### x-input-label

**Description**: Form labels
**Features**: Consistent typography, accessibility support

## Architecture Notes

1. **Consistency**: All components follow the same design system
2. **Accessibility**: Proper ARIA labels and keyboard navigation
3. **Responsiveness**: Mobile-first design approach
4. **Performance**: Minimal DOM manipulation, efficient Alpine.js usage
5. **Maintainability**: Single responsibility principle, clear component boundaries

## Usage Guidelines

1. Always use `x-admin-layouts` for admin pages
2. Use `x-admin.form-*` components for consistent form styling
3. Prefer semantic button types (`x-primary-button`, `x-secondary-button`, etc.)
4. Include proper error handling in all form components
5. Maintain consistent spacing and typography

## File Structure

```
resources/views/components/
├── admin-layouts.blade.php      # Main layout
├── admin-header.blade.php       # Header component
├── sidebar.blade.php            # Navigation sidebar
├── input-label.blade.php        # Base label component
├── text-input.blade.php         # Base input component
├── textarea.blade.php           # Base textarea component
├── primary-button.blade.php     # Primary button
├── secondary-button.blade.php   # Secondary button
├── danger-button.blade.php      # Danger button
└── admin/                       # Admin-specific components
    ├── form-input.blade.php     # Enhanced form input
    ├── form-select.blade.php    # Enhanced select
    ├── form-textarea.blade.php  # Enhanced textarea
    ├── form-button.blade.php    # Form button
    ├── table.blade.php          # Data table
    └── logo.blade.php           # Logo component
```
