## Roles & Permissions Strategy

### 1. Role Definitions
- **Super Admin**: Full system access, infrastructure configuration, role management.
- **Operations Admin**: Manage catalog, orders, customers, promotions, content. Cannot alter system-level settings.
- **Catalog Manager**: CRUD on categories, products, variants, assets. Approve catalog changes.
- **Order Manager**: View/manage orders, issue refunds, update fulfillment, manage returns.
- **Customer Support**: View customer profiles, assist with orders, issue store credits, initiate returns.
- **Marketing Manager**: Manage promotions, content pages, blog posts, email campaigns.
- **Content Editor**: Create/edit content pages and blog posts, but no publish rights (requires approval).
- **Warehouse Staff**: Access picking lists, update fulfillment status, print packing slips.
- **Finance Analyst**: View sales reports, transaction logs, settlements.
- **Customer (Auth)**: Manage own profile, orders, wishlists, addresses.
- **Guest**: Read-only catalog access, cart operations.

### 2. Permission Matrix (Key Modules)

| Module | Permissions | Roles |
|--------|-------------|-------|
| Catalog | view_products, create_products, update_products, delete_products, publish_products | Super Admin, Operations Admin (all), Catalog Manager (view/create/update/publish), Marketing Manager (view), Content Editor (view) |
| Categories | view_categories, manage_categories | Super Admin, Operations Admin, Catalog Manager |
| Inventory | view_inventory, adjust_inventory | Super Admin, Operations Admin, Catalog Manager (view/adjust), Warehouse Staff (view/adjust) |
| Pricing & Promotions | view_promotions, manage_promotions, publish_promotions | Super Admin, Operations Admin (all), Marketing Manager (manage/publish) |
| Orders | view_orders, update_orders, refund_orders, cancel_orders | Super Admin (all), Operations Admin (all), Order Manager (view/update/refund/cancel), Customer Support (view/update/cancel), Warehouse Staff (view/update fulfillment only) |
| Fulfillment | view_fulfillments, manage_fulfillments | Super Admin, Operations Admin, Warehouse Staff |
| Customers | view_customers, update_customers, masquerade_customer | Super Admin (all), Operations Admin (view/update), Customer Support (view/update), Marketing Manager (view), Finance Analyst (view) |
| Content | view_content, manage_content, publish_content | Super Admin, Operations Admin (all), Marketing Manager (manage/publish), Content Editor (view/manage), Catalog Manager (view) |
| Analytics/Reports | view_reports, export_reports | Super Admin, Operations Admin, Finance Analyst |
| System Settings | manage_settings, manage_roles | Super Admin (both), Operations Admin (manage_settings) |
| Support Tools | issue_store_credit, manage_returns | Super Admin, Operations Admin, Customer Support |

Use granular permissions (strings) in `spatie/laravel-permission`. Store additional metadata (module grouping, description) in config for UI display.

### 3. Laravel Implementation
1. **Package Setup**: Install `spatie/laravel-permission`, publish config/migrations, customize table names (`roles`, `permissions`, `model_has_roles`, `model_has_permissions`).
2. **Domain Alignment**: Create `App\Domain\Access` module containing Role, Permission seeding, and policies. Use Laravel policies for domain resources (ProductPolicy, OrderPolicy) to encode contextual rules (owner-based, status-based).
3. **Seeding**: Implement seeder that:
   - Defines permissions grouped by module.
   - Creates roles with assigned permissions.
   - Assigns default roles to seeded admin users.
   - Provides artisan command `access:sync` to re-apply definitions safely (idempotent).
4. **Middleware**: Utilize `auth:sanctum` for API, `role`, `permission` middleware for route groups. Example: `Route::middleware(['auth:sanctum', 'permission:view_orders'])->get('/orders', ...)`.
5. **Policies & Gates**: Leverage policies for per-resource access (e.g., ensure Warehouse Staff cannot refund). Register policies via `AuthServiceProvider`.
6. **Audit Trail**: Integrate with `spatie/laravel-activitylog` to record role changes, permission grants, and critical actions.
7. **Back Office UI**: Build Role Management screen with ability to assign roles, view permission matrix, and log changes. Limit to Super Admin.

### 4. Frontend Enforcement (Nuxt/Vue)
- **State Handling**: Store user roles/permissions in Pinia store after login via `/auth/me` endpoint delivering `roles`, `permissions` arrays.
- **Navigation Guards**: Define route meta requiring roles/permissions; Nuxt navigation middleware checks before page render, redirect to unauthorized page.
- **Component-level Directives**: Create custom directive (e.g., `v-can="'manage_promotions'"`) to conditionally render buttons/actions.
- **Fallback UX**: Show locked states or disable actions with tooltip explaining required role.

### 5. API Contract
- `/auth/me` returns profile, roles, permissions, feature flags.
- `/roles` (Super Admin only) to manage roles (list, create, update, delete).
- `/permissions` read-only listing grouped by module for UI reference.
- Audit endpoints to review assignment history.

### 6. Testing Strategy
- Feature tests verifying restricted routes respond 403 when unauthorized.
- Policy unit tests with matrix coverage (DataProvider enumerating roles × actions).
- API contract tests ensuring `auth/me` includes accurate permissions.
- Frontend unit tests for directives and navigation guards using mocked stores.

### 7. Deployment Considerations
- Seeder auto-runs in CI with `--force` to ensure permissions sync.
- Backwards-compatible updates: use versioned permission config; new permissions added via migrations to avoid breaking existing roles.
- Provide super admin emergency CLI command to assign roles in case of UI lockout.

