## Initial Implementation Backlog

### Sprint 0 – Environment & Tooling
- [ ] Confirm infrastructure platform (AWS ECS Fargate vs Forge/Vapor) and provision sandbox account.
- [ ] Bootstrap mono-repo structure (`apps/backend`, `apps/storefront`, `apps/backoffice`, `packages/ui`, `packages/contracts`).
- [ ] Configure shared tooling: TurboRepo/PNPM workspace, Composer setup, Prettier, ESLint, Stylelint, Laravel Pint.
- [ ] Establish GitHub Actions workflow skeleton for linting, tests, and Docker builds.
- [ ] Draft Terraform modules for VPC, RDS/PostgreSQL, ElastiCache/Redis, S3 buckets, and parameter store.
- [ ] Set up Docker Compose for local dev (PHP-FPM, Nginx, PostgreSQL, Redis, Meilisearch).

### Sprint 1 – Foundations
- [ ] Scaffold Laravel 12 project with modular structure (`domain` modules) and install base dependencies (Sanctum, spatie packages, Scout, Horizon).
- [ ] Design database ERD and create initial migrations for users, roles, products, categories, assets.
- [ ] Implement authentication (registration, login, password reset) with Sanctum token issuance for API consumers.
- [ ] Establish API versioning strategy and routing conventions (`/api/v1`).
- [ ] Create Nuxt 4 project for storefront with Tailwind configured and design tokens applied.
- [ ] Integrate Storybook 8 for shared UI components and publish base typography/color components.
- [ ] Implement CI jobs for PHPStan and Vitest/Jest (if applicable) with baseline tests.
- [ ] Introduce RBAC module with `spatie/laravel-permission`, seed initial roles/permissions, expose `/auth/me` with role payload.

### Sprint 2 – Catalog MVP
- [ ] Implement product domain services (CRUD, variants, pricing) with REST endpoints and resource transformers.
- [ ] Build asset management (media uploads to S3, responsive image generation, metadata storage).
- [ ] Integrate Meilisearch for product indexing with sync jobs and incremental updates.
- [ ] Develop storefront product listing pages (home featured, category grid, product detail) consuming API.
- [ ] Create back office catalog screens with data grids, filtering, and inline edits.
- [ ] Add PHPUnit/Pest feature tests for catalog flows and Playwright E2E smoke tests.
- [ ] Enforce role-based access in Nuxt (navigation guards, directives) and protect back office routes/actions per permission matrix.

### Sprint 3 – Cart & Checkout MVP
- [ ] Design cart service (session-based & authenticated carts) with merge logic on login.
- [ ] Integrate Stripe for payments (Payment Intents) with server-side confirmation and webhooks.
- [ ] Implement checkout API (shipping options, tax calculation stubs, order placement). Prepare extension points for local gateways.
- [ ] Build Nuxt checkout pages (cart, shipping, payment, confirmation) with form validation via `vee-validate` + `zod`.
- [ ] Back office order management: order list, detail view, status transitions, notes, notifications.
- [ ] Configure transactional email templates (Order confirmation, payment failure) via Laravel notifications.

### Sprint 4 – Content & Marketing
- [ ] Introduce content module with page builder (TipTap) and scheduling.
- [ ] Implement promotions engine (coupon codes, automatic promotions) with eligibility rules.
- [ ] Add wishlist and customer account features (order history, address book).
- [ ] Integrate Algolia or Meilisearch advanced search with facets and autocomplete suggestions.
- [ ] Create marketing landing page templates in Nuxt with static generation and CMS-driven content.

### Ongoing Cross-Cutting Tasks
- [ ] Establish observability stack (Sentry, Telescope, Prometheus metrics).
- [ ] Define logging strategy with structured logs (Monolog + JSON) shipped to Logtail/ELK.
- [ ] Automate DB migrations & seeders across environments with Flyway or Laravel migrations pipeline.
- [ ] Conduct accessibility audits and Lighthouse performance checks per release.
- [ ] Document APIs via Scribe (REST) and GraphQL schema references; publish in internal developer portal.

