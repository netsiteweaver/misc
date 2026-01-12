import { Button } from "@/components/Button";
import { Container } from "@/components/Container";
import { fetchSiteSettings } from "@/lib/api";

export const metadata = {
  title: "About",
  description: "Learn about our car parts shop and how we work.",
};

export default async function AboutPage() {
  let site = {
    name: "Car Parts Shop",
    facebookUrl: "https://www.facebook.com/profile.php?id=100068333531889",
  };

  try {
    site = await fetchSiteSettings();
  } catch (error) {
    console.error("Failed to fetch site settings:", error);
  }

  return (
    <Container className="py-10 sm:py-14">
      <div className="max-w-2xl">
        <h1 className="text-3xl font-semibold tracking-tight sm:text-4xl">
          About {site.name}
        </h1>
        <p className="mt-4 text-zinc-600">
          We help drivers and mechanics find the right parts — quickly and at a
          fair price. Whether you're doing routine maintenance or a full repair,
          we'll guide you to the best option for your budget.
        </p>

        <div className="mt-8 grid gap-4 sm:grid-cols-2">
          <div className="rounded-2xl border border-zinc-200 bg-white p-5">
            <div className="text-sm font-semibold">Compatibility first</div>
            <p className="mt-2 text-sm text-zinc-600">
              We double-check fitment details before confirming a quote.
            </p>
          </div>
          <div className="rounded-2xl border border-zinc-200 bg-white p-5">
            <div className="text-sm font-semibold">OEM & aftermarket</div>
            <p className="mt-2 text-sm text-zinc-600">
              We offer choices, explain trade-offs, and let you decide.
            </p>
          </div>
          <div className="rounded-2xl border border-zinc-200 bg-white p-5">
            <div className="text-sm font-semibold">Clear communication</div>
            <p className="mt-2 text-sm text-zinc-600">
              Pricing, availability, and timelines shared up front.
            </p>
          </div>
          <div className="rounded-2xl border border-zinc-200 bg-white p-5">
            <div className="text-sm font-semibold">We respond on Facebook</div>
            <p className="mt-2 text-sm text-zinc-600">
              Your fastest channel for photos and quick Q&A.
            </p>
          </div>
        </div>

        <div className="mt-8 flex flex-col gap-3 sm:flex-row">
          <Button href="/contact">Request a quote</Button>
          <Button href={site.facebookUrl} external variant="secondary">
            Visit Facebook
          </Button>
        </div>
      </div>
    </Container>
  );
}

