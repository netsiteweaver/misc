## WoodMart Mega Electronics – Design Translation

Reference: https://woodmart.xtemos.com/mega-electronics/

### 1. Design Language Summary
- **Palette**: Dark neutrals (`#0f1115`, `#1c1f26`), electric blues (`#2563eb`, `#38bdf8`), accent oranges (`#f97316`) for CTAs, light gray backgrounds for contrast.
- **Typography**: Bold, condensed headlines (similar to `Poppins`/`Montserrat`), medium-weight body copy. All caps for badge labels. Maintain tight letter spacing for tech aesthetic.
- **Visual Motifs**: Card-based layout with subtle shadows, gradient overlays on banners, glowing button hover states, outlined icons and pill badges.
- **Imagery**: High-contrast electronics photography, lifestyle shots with dark backgrounds; maintain consistent aspect ratios (3:2, square for promos).

### 2. Layout & Key Sections
- **Header**: Sticky top bar with promo strip, logo left, mega menu navigation center, utility icons (account, wishlist, cart) right. Search bar prominently positioned beneath or integrated into header.
- **Mega Menu**: Multi-column dropdown with iconography per category, featured banners within menu, callouts for deals.
- **Hero Section**: Full-width slider with text on left/right, product imagery, CTA buttons (primary, ghost). Includes countdown component for flash sale.
- **Featured Icons Row**: 3–4 service cards (Free Delivery, Secure Payment, Support) using icon + short text.
- **Product Grids**: Trending/New Arrivals tabs, 4-column desktop / 2-column tablet / 1-column mobile. Product cards with hover quick view, color swatches, rating stars, compare/wishlist icons.
- **Promo Banners**: Alternating half-width banners with gradient backgrounds and CTA; include layered imagery and geometric shapes.
- **Deal Carousel**: Horizontal slider showing limited-time deals with countdown timer and progress bar.
- **Blog/Content Strip**: Latest articles with image tiles and category badges.
- **Footer**: Multi-column links, newsletter signup, social icons, payment badges, store contact info.

### 3. Component Inventory (Storefront)
- `HeaderBar`: top promo, localization toggles.
- `MainHeader`: logo, navigation, search, utility icons.
- `MegaMenu`: configurable columns, icon support, promotional slot.
- `HeroCarousel`: slide items with image, headline, subtext, CTA, countdown optional.
- `FeatureList`: icon + text cards.
- `TabbedProductGrid`: reactive tabs, grid layout, quick actions.
- `ProductCard`: image gallery hover, price display (normal/sale), rating, action buttons.
- `PromoBanner`: responsive image/text layout with gradient background.
- `DealCarousel`: slider with timer, price comparison badge.
- `CategoryTiles`: grid of category blocks with icon and background image.
- `BlogCard`: image, category badge, title, excerpt.
- `NewsletterSignup`: inline form with background pattern.
- `FooterColumns`: configurable link groups + contact + payments.

### 4. Interaction & Motion Guidelines
- Hover states with subtle scale (1.02), shadow elevation, color transitions (Tailwind `transition-all`, `duration-200`).
- Buttons: gradient primary (`from-blue-500 to-blue-700`), ghost variant with border, disabled opacity 50%.
- Cards: reveal quick action buttons on hover (wishlist/compare), maintain accessible focus outlines.
- Mega menu: open on hover (desktop) and tap (mobile), animate fade/slide.
- Carousels: arrow controls, dot indicators, auto-play optional with pause on hover.

### 5. Responsive Considerations
- Collapsible mobile menu with accordion categories and search prominent at top.
- Hero slider converts to stacked cards with swipe support.
- Product grids adapt to 2 columns at ≥768px, 1 column below 640px.
- Footer reflows to accordion sections on mobile.
- Ensure countdown timers, badges remain legible on small screens.

### 6. Back Office Echoes
- Maintain same design tokens for admin UI but use lighter theme for clarity.
- Reuse components where possible (buttons, form inputs) to ensure consistency.

### 7. Implementation Notes
- Tailwind config: extend colors (`brand-dark`, `brand-blue`, `brand-orange`), gradients, box shadows, font families.
- Use `@headlessui/vue` for dropdowns, dialogs; integrate `Swiper` or `Splide` for carousels.
- Icons via `Heroicons`/`Phosphor` with custom stroke width to match motif.
- Prefetch hero/product images, utilize `nuxt-img` for responsive sources.
- Create CMS-friendly JSON schema for hero slides, mega menu entries, promos to empower non-dev updates.

