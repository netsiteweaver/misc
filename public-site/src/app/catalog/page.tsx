import { Button } from "@/components/Button";
import { Container } from "@/components/Container";
import { categories, site } from "@/lib/site";

export const metadata = {
  title: "Catalog",
  description: "Browse car parts categories and request a quote.",
};

export default function CatalogPage() {
  return (
    <Container className="py-10 sm:py-14">
      <div className="max-w-2xl">
        <h1 className="text-3xl font-semibold tracking-tight sm:text-4xl">
          Catalog
        </h1>
        <p className="mt-3 text-zinc-600">
          Use these categories to describe what you need. For the fastest quote,
          send your car model/year and a photo of the old part if possible.
        </p>
        <div className="mt-6 flex flex-col gap-3 sm:flex-row">
          <Button href="/contact">Request a quote</Button>
          <Button href={site.facebookUrl} external variant="secondary">
            Message on Facebook
          </Button>
        </div>
      </div>

      <div className="mt-10 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        {categories.map((c) => (
          <div
            key={c.title}
            className="rounded-2xl border border-zinc-200 bg-white p-5"
          >
            <div className="text-base font-semibold">{c.title}</div>
            <p className="mt-2 text-sm text-zinc-600">{c.description}</p>
            <ul className="mt-4 space-y-1 text-sm text-zinc-700">
              {c.examples.map((e) => (
                <li key={e} className="flex gap-2">
                  <span className="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-zinc-400" />
                  <span>{e}</span>
                </li>
              ))}
            </ul>
          </div>
        ))}
      </div>
    </Container>
  );
}

