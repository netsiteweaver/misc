import { Button } from "@/components/Button";
import { Container } from "@/components/Container";
import { fetchCategories, fetchSiteSettings, Category } from "@/lib/api";

export default async function Home() {
  let categories: Category[] = [];
  let site = {
    name: "Car Parts Shop",
    tagline: "Quality car parts. Fast sourcing. Honest pricing.",
    facebookUrl: "https://www.facebook.com/profile.php?id=100068333531889",
  };

  try {
    [categories, site] = await Promise.all([
      fetchCategories(),
      fetchSiteSettings(),
    ]);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  }

  return (
    <div>
      <section className="relative overflow-hidden">
        <div className="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,rgba(24,24,27,0.08),transparent_55%)]" />
        <Container className="py-14 sm:py-20">
          <div className="max-w-2xl">
            <div className="inline-flex items-center gap-2 rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-700">
              Car parts sourcing · Retail & wholesale
            </div>
            <h1 className="mt-5 text-4xl font-semibold tracking-tight text-zinc-900 sm:text-5xl">
              {site.name}
            </h1>
            <p className="mt-4 text-lg leading-8 text-zinc-600">
              {site.tagline} Tell us your car model + part name (or send a photo),
              and we'll confirm availability and price.
            </p>

            <div className="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
              <Button href="/catalog">Browse categories</Button>
              <Button href="/contact" variant="secondary">
                Request a quote
              </Button>
              <Button href={site.facebookUrl} external variant="secondary">
                Visit Facebook
              </Button>
            </div>

            <div className="mt-10 grid gap-4 sm:grid-cols-3">
              <div className="rounded-2xl border border-zinc-200 bg-white p-4">
                <div className="text-sm font-semibold">Fast sourcing</div>
                <div className="mt-1 text-sm text-zinc-600">
                  OEM and quality aftermarket options.
                </div>
              </div>
              <div className="rounded-2xl border border-zinc-200 bg-white p-4">
                <div className="text-sm font-semibold">Right fit</div>
                <div className="mt-1 text-sm text-zinc-600">
                  We verify compatibility before you buy.
                </div>
              </div>
              <div className="rounded-2xl border border-zinc-200 bg-white p-4">
                <div className="text-sm font-semibold">Support</div>
                <div className="mt-1 text-sm text-zinc-600">
                  Friendly guidance for replacements and upgrades.
                </div>
              </div>
            </div>
          </div>
        </Container>
      </section>

      <section className="border-t border-zinc-200 bg-zinc-50/60">
        <Container className="py-12">
          <div className="flex items-end justify-between gap-6">
            <div>
              <h2 className="text-2xl font-semibold tracking-tight">
                Popular categories
              </h2>
              <p className="mt-2 text-sm text-zinc-600">
                A quick starting point — if you don't see it, just message us.
              </p>
            </div>
            <div className="hidden sm:block">
              <Button href="/catalog" variant="secondary">
                View all
              </Button>
            </div>
          </div>

          <div className="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            {categories.slice(0, 6).map((c) => (
              <div
                key={c.id}
                className="rounded-2xl border border-zinc-200 bg-white p-5"
              >
                <div className="text-base font-semibold">{c.title}</div>
                <div className="mt-2 text-sm text-zinc-600">{c.description}</div>
                <div className="mt-3 flex flex-wrap gap-2">
                  {c.examples.slice(0, 3).map((e) => (
                    <span
                      key={e}
                      className="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-700"
                    >
                      {e}
                    </span>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </Container>
      </section>
    </div>
  );
}
